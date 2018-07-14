<!DOCTYPE html>
<!--

* Description of error404
* Created on : Jun 24, 2018, 12:57:36 PM
* @author afrikannerd <https://github.com/afrikannerd>
* @version "0.1"


-->
    <html>
        <head>
            <meta charset="UTF-8">
            <title>404</title>
            <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
            <style>
                .error404{
                    width: 100%;
                    height: 100%;
                    margin: 0;
                    
                    background: #31363C;
                    text-align: center;
                    
                }
                .message{
                    color: #444D57;
                }
                .h1{
                    color:#ffffff;
                    font-size: 2em;
                }
                .fallback{
                    color: #DCCEC6;
                }
                
                .wrapper{
                    margin: 21% auto;
                }
            </style>
            
        </head>
        <body>
            <div class="container error404">
                <div class="wrapper">
                <h1 class="h1">That's a 404</h1>
                <p class="message"><?= $_SERVER['REQUEST_URI'];?> not found</p>
                <span class="fallback">Navigate safely back </span><a href="/home">home</a>
                </div>
            </div>
            
            
        </body>
    </html>
