<?php
/**
 * Created by PhpStorm.
 * User: nishant
 * Date: 7/28/20
 * Time: 2:39 AM
 */

class ShortenedUrl_Model extends \CodeIgniter\Model {

    protected $table      = 'shortenedUrl';
    protected $primaryKey = 'id';

    protected $allowedFields = ['code','original_url','created_at','updated_at'];


}