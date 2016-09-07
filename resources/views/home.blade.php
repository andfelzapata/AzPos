<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>azPos</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,600" rel="stylesheet" type="text/css">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Lato';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .title-box-1 {
                height: 1em;
                width: 6.5em;
                display: inline-block;
            }

            .title-box-2 {
                height: 1em;
                width: 15.5em;
                display: inline-block;
            }

            .blueSpan {
                background-color:#35495e;
                animation-duration: 2s;
                animation-delay: 0s;

            }

            .greenSpan {
                background-color:#41b883;
                animation-duration: 2s;
                animation-delay: 0s;
            }

            .site__title {
                color: #41b883;
                background-image: -webkit-linear-gradient(92deg,#41b883,#35495e);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                -webkit-animation: hue 60s infinite linear;
                }

            .title-az {
                color:#41b883
            }

            .title-POS {
                color:#35495e;
                font-weight:300
            }

            .title {
                font-size: 8rem;
            }

            .container-flex {
                display: flex;
                align-items: center;
                justify-content: center;

            }

            .container-full-height {
                height: 100vh;
            }

            .row-eq-height {
                display: -webkit-box;
                display: -webkit-flex;
                display: -ms-flexbox;
                display: flex;
            }

            .col-lg-6 {
                height: 240px;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 50%;
            }

            #loginForm {
                position: relative;
                top: 2em;
                width: 100%;
            }

            .LoginError {
                position: absolute;
                right: 0;
                left: 0;
                text-align: center;
                z-index: -10;
            }

        </style>
    </head>
    <body>

        <div class="container-fluid">

            <div class="container">

                <div class="row">

                    <div class="col-lg-6">

                        <div class="site__title title animated bounce">
                            <span class="title-az">az</span><span class="title-POS">POS</span>
                        </div>

                        <div>
                            <span class="blueSpan title-box-1 animated fadeInLeft"></span> <span class="greenSpan title-box-2 animated fadeInRight"></span>
                        </div>

                        <div>
                            <span class="greenSpan title-box-1 animated fadeInRight"></span>  <span class="blueSpan title-box-2 animated fadeInLeft"></span>
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div id="loginForm"></div>

                    </div>


                </div>
            </div>

        </div>

        <div id="app"></div>

        <script src="js/home.js"></script>


    </body>
</html>
