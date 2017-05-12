<?php
$app_name = null;
if (isset($_GET['app']))
    $app_name = $_GET['app'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Web Client Composer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">var app_name = "<?php echo $app_name; ?>";</script>
        <script type="text/javascript" src="/js/composer.min.js"></script>
        <style>
            #output
            {
                width:100%;
                height:350px;
                overflow-y:scroll;
                overflow-x:hidden;
                font-family: Consolas, monaco, monospace;
                font-size: 16px;
                font-style: normal;
                font-variant: normal;
                background: #2B2B2B;
                color: #F1F1F1;
            }
            .buttons { margin: 10px 0 0 0; }
        </style>
    </head>
    <body>
        <div style="padding: 15px;">
            <div class="col-lg-1"></div>
            <div class="col-lg-12">
                <h3>Application:</h3>
                <div class="form-inline">
                    <input type="text" id="app" style="width: 100%;" class="form-control" value="/kingpaulo.7/king.com" disabled />
                </div>
                <h3>Commands:</h3>
                <div class="form-inline buttons">
                    <button id="laravel" onclick="call('laravel-install')" class="btn btn-warning disabled">laravel-install</button>
                    <button id="install" onclick="call('install')" class="btn btn-success disabled">install</button>
                    <button id="update" onclick="call('update')" class="btn btn-primary disabled">update</button>
                    <button id="dump" onclick="call('dump-autoload')" class="btn btn-danger disabled">dump-autoload</button>
                </div>
                <h3>Console Output:</h3>
                <pre id="output" class="well"></pre>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </body>
</html>
