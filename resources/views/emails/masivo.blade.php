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

                <p class="h5">
                  Inscríbete en los cursos gratuitos de MéxicoX que comienzan en agosto.
                </p>

                <div class="col-md-12">
                  <div class="col-md-4 centered">
                    <br>
                    <a href="http://mx.televisioneducativa.gob.mx/courses/IIIDx/IIIDRn103x/2016_s2/about" target="_blank"><img src="{{asset('/cursos_mensuales/1.png')}}"></a>
                    <br>
                  </div>
                  <div class="col-md-4 centered">
                    <br>
                    <a href="http://mx.televisioneducativa.gob.mx/courses/INEA/LPTMx/2016_S2/about" target="_blank"><img src="{{asset('/cursos_mensuales/2.png')}}"></a>
                    <br>
                  </div>
                  <div class="col-md-4 centered">
                    <br>
                    <a href="http://mx.televisioneducativa.gob.mx/courses/UPN/VE_UPN001_2/2016_S2/about" target="_blank"><img src="{{asset('/cursos_mensuales/3.png')}}"></a>
                    <br>
                  </div>
                  <div class="col-md-12">
                    <br>
                  </div>
                  <div class="col-md-4 centered">
                    <br>
                    <a href="http://mx.televisioneducativa.gob.mx/courses/FEM-UAE/CBx/2016_T1/about" target="_blank"><img src="{{asset('/cursos_mensuales/4.png')}}"></a>
                    <br>
                  </div>
                  <div class="col-md-4 centered">
                    <br>
                    <a href="http://mx.televisioneducativa.gob.mx/courses/INEA/PPEH/2016E1/about" target="_blank"><img src="{{asset('/cursos_mensuales/5.png')}}"></a>
                    <br>
                  </div>
                  <div class="col-md-4 centered">
                    <br>
                  </div>
                </div>

                <br>
                <p class="h5">
                  <br>
                  Refuerza tus competencias laborales y conocimientos en esta comunidad de aprendizaje.
                </p>

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
          </a><br><br>

            <a href='http://mx.televisioneducativa.gob.mx/'>
            <img src='http://mexicox.gob.mx:81/reportesmx/public/imagenes/boton.png' style="width: 125px; height: 25px; border-radius: 30px; paddin">
          </a><br><br>

            <a href="http://mexicox.gob.mx/privacy"  target="_blank"> Consulta nuestro aviso de privacidad </a><br>
            Si no quieres recibir más correos de MéxicoX da click
            <a href="http://www.mexicox.gob.mx:81/reportesmx/public/mail/unsuscribe"> aquí </a>.<br><br>
        </div>
    </body>
</html>
