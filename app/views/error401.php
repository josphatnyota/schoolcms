<?php

/**
 * Description of error401
 * Created on : Jun 24, 2018, 4:53:35 PM
 * @author afrikannerd <https://github.com/afrikannerd>
 * @version "0.1"
 */
?>
<!DOCTYPE html>

    <html>
        <head>
            <meta charset="UTF-8">
            <title>401</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
                <h1 class="h1">That's a 401</h1>
                <p class="message">Restricted Access.here be dragons</p>
                <span class="fallback">Navigate safely back </span><a href="/home">home</a>
                </div>
            </div>
            
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        </body>
    </html>
