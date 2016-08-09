<!DOCTYPE HTML>
<html>
    <head>
        <title> México X</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    </head>
    <body>
        <div style="background-image: url('http://mexicox.gob.mx:81/reportesmx/public/imagenes/email/header.jpg');
             background-repeat: no-repeat;
             width: 600px;
             margin: auto;">
            <div style='padding-top: 75px'>

                {!! $mensaje !!}

            </div>
            <img src='http://mexicox.gob.mx:81/reportesmx/public/imagenes/email/linea.jpg'>
        </div>

        <div style="background-image: url('http://mexicox.gob.mx:81/reportesmx/public/imagenes/email/footer.jpg');
             background-repeat: no-repeat;
             width: 600px;
             height: 225px;
             margin: auto;
             padding-top: 25px"
             align='right'>

            <a href='http://www.facebook.com/TvEducativaMx'>
            <img src='http://mexicox.gob.mx:81/reportesmx/public/imagenes/fb.png' class='img-rounded'>
            </a>
            <a href='https://twitter.com/tveducativamx'>
            <img src='http://mexicox.gob.mx:81/reportesmx/public/imagenes/twitter.png' class='img-rounded'>
            </a><br>

            <a href='http://mx.televisioneducativa.gob.mx/'>
            <img src='http://mexicox.gob.mx:81/reportesmx/public/imagenes/boton.png' style="width: 135px; height: 30px; border-radius: 30px;">
            </a><br>

            <a href="http://mexicox.gob.mx/privacy"> Consulta nuestro aviso de privacidad </a><br>
            Si no quieres recibir más correos de México X da click
            <a href="http://www.mexicox.gob.mx:81/reportesmx/public/mail/unsuscribe"> aquí </a>.<br>
        </div>
    </body>
</html>
