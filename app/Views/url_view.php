<html>
    <head>
        <title>Url Shortner</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>

    <body>

    <div class="container">
        <div class="row" style="margin: 0 auto;width: 300px">
            <h3>Generate URL Hash</h3>
            <form action="/" method="post">
                <div class="form-group">
                    <label for="utm_source">UTM Source</label>
                    <input type="text" class="form-control" placeholder="ex: Facebook" id="utm_source" name="utm_source">
                </div>
                <div class="form-group">
                    <label for="utm_medium">UTM Source</label>
                    <input type="text" class="form-control" placeholder="ex: howToCreateAUrlHash" id="utm_medium" name="utm_medium">
                </div>
                <div class="form-group">
                    <label for="utm_campaign">UTM Source</label>
                    <input type="text" class="form-control" placeholder="ex: contentPromotion" id="utm_campaign" name="utm_campaign">
                </div>
                <div class="form-group">
                    <label for="sel1">Select UTM Type:</label>
                    <select class="form-control" name="type" id="sel1">
                        <option value="marketing">Marketing</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php if (!empty($url) ) { ?>
                <label>Shortened Url</label>
                <input class="form-control" value="<?= $url; ?>" disabled />
            <?php } ?>
        </div>
    </div>
    </body>
</html>