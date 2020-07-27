<?php namespace App\Controllers;

use ShortenedUrl_Model;

class Home extends BaseController
{
    private $secret;
    private $method;
    private $initVector;

    private $shortenedModel;

    public function __construct()
    {
        $this->secret         = 'RandomKeyGeneratedForUrlHashing';
        $this->method         = 'AES-256-CTR';
        $this->initVector     = "0123456789012345";

        $this->shortenedModel = new ShortenedUrl_Model();
    }

    public function index()
	{
        $data = [];

	    if ( $this->request->getMethod() == 'post' )
        {
            $data = $this->request->getPost();

            $url = $this->getLink($data);
            $data['url'] = $url;

        }

		return view('url_view',$data);
	}

	public function landing()
    {
        if( !empty( $this->request->getGet() ) && !empty( $this->request->getVar('code') ) )
        {
            $code = $this->request->getVar('code');

            $data = $this->shortenedModel->where( 'code', $code )->first();

            if( empty( $data ) ){
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }

            $shortenedUrl = $data['original_url'];

            $queryParam = parse_url($shortenedUrl)['query'];

            $token = substr( $queryParam , strpos( $queryParam , 'token' ) + strlen('token') + 1 );

            $data = json_decode($this->getDecryptedData($token));

            echo "The Token Contains Following Data";
            echo "<br>";

            foreach ( $data as $key => $value ) {
                echo "$key: " . "$value";
                echo "<br>";
            }

        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    }

	private function getLink( $data )
    {
        $type = $data['type'];
        unset($data['type']);

        $link = $this->setLink( $type , $data );
        return $this->getSortedUrl($link);

    }

    private function getSortedUrl( $link )
    {
        $shortendUrl = null;
        $urlRefCode = $this->getURLCode($link);

        $now = date('Y-m-d H:i:s');

        if ( !empty($urlRefCode) )
        {
            $this->shortenedModel->insert( [
                'code'          => $urlRefCode,
                'original_url'  => $link,
                'created_at'    => $now,
                'updated_at'    => $now,
            ] );
        }

        $shortendUrl = base_url() . '/shortUrl?code=' . $urlRefCode;

        return $shortendUrl;
    }

    private function getURLCode($link)
    {
        $code = substr(md5($url . mt_rand()), 0, 8);

        if ( !empty( $this->shortenedModel->where( 'code', $code )->first() ) ) {
            return $this->getURLCode($link);
        }
        return $code;
    }

    private function setLink( $type , $data )
    {
        $token = $this->getToken($data);
        $link  = '';
        switch ($type){
            case 'marketing':
                $link = base_url() . '/utm_url?token=' . $token ;
                break;
        }
        return $link;
    }

    private function getToken( $data )
    {
        $token = openssl_encrypt(json_encode($data), $this->method, $this->secret, false, $this->initVector);

        return $token;
    }

    private function getDecryptedData( $token )
    {
        $decrypted = openssl_decrypt($token, $this->method, $this->secret, false, $this->initVector);
        return $decrypted;
    }

}
