<?php
include 'password.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>NoConsoleComposer</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                check();
            });
            function url()
            {
                return 'main.php';
            }
            function call(func)
            {
                var path = $("#path").val();

                $("#output").append("\nplease wait...\n");
                $("#output").append("\n===================================================================\n");
                $("#output").append("Path: " + path + "> composer " + func);
                $("#output").append("\nExecuting Started");
                $("#output").append("\n===================================================================\n");
               
                $.post('main.php',
                        {
                            "path": path,
                            "command":func,
                            "function": "command"
                        },
                function(data)
                {
                    $("#output").append(data);
                    $("#output").append("\n===================================================================\n");
                    $("#output").append("Execution Ended");
                    $("#output").append("\n===================================================================\n");
                }
                );
            }
            function check()
            {
                $("#output").append('\nloading...\n');
                $.post(url(),
                        {
                            "function": "getStatus",
                            "password": $("#password").val()
                        },
                function(data) {
                    if (data.composer_extracted)
                    {
                        $("#output").html("Ready. All commands are available.\n");
                        $("button").removeClass('disabled');
                    }
                    else if(data.composer)
                    {
                        $.post(url(),
                                {
                                    "password": $("#password").val(),
                                    "function": "extractComposer",
                                },
                                function(data) {
                                    $("#output").append(data);
                                    window.location.reload();
                                }, 'text');
                    }
                    else
                    {
                        $("#output").html("Please wait till composer is being installed...\n");
                        $.post(url(),
                                {
                                    "password": $("#password").val(),
                                    "function": "downloadComposer",
                                },
                                function(data) {
                                    $("#output").append(data);
                                    check();
                                }, 'text');
                    }
                });
            }
        </script>
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
                line-height: 16 px;
                width:100%;
                height:300px;
                overflow-y:scroll;
                overflow-x:hidden;
                background: #2B2B2B;
                color: #F1F1F1;
            }
            .buttons { margin: 10px 0 0 0; }
        </style>
    </head>
    <body>
        <div class="row" style="padding: 15px;">
            <div class="col-lg-1"></div>
            <div class="col-lg-12">
                <h3>Commands:</h3>
                <div class="form-inline">
                    <input type="text" id="path" style="width: 100%;" class="form-control disabled" placeholder="absolute path to project directory"/>
                </div>
                <div class="form-inline buttons">
                    <button id="install" onclick="call('install')" class="btn btn-success disabled">install</button>
                    <button id="install" onclick="call('create-project --prefer-dist laravel/laravel')" class="btn btn-success disabled">laravel-install</button>
                    <button id="update" onclick="call('update')" class="btn btn-success disabled">update</button>
                    <button id="update" onclick="call('dump-autoload')" class="btn btn-success disabled">dump-autoload</button>
                </div>
                <h3>Console Output:</h3>
                <pre id="output" class="well"></pre>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </body>
</html>
