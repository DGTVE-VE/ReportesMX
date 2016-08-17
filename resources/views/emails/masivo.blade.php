<!DOCTYPE HTML>
<html>
    <head>
        <title> México X</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
        <style media="screen">

                  .relative{
                    position: relative;
                    width: 600px;
                    height: 900px;
                  }
                  .absolute{
                    position: absolute;
                    top: 80px;

                    width: 200px;
                    height: 100px;
                  }
                  .absolute2{
                    position: absolute;
                    top: 25px;
                    width: 200px;
                    height: 100px;
                    left: 400px;
                  }
                  .absolute3{
                    position: absolute;
                    top: 100px;
                    width: 200px;
                    height: 100px;
                  }
                  .right{
                    text-aling: right;
                  }
                  p{
                  font-size: 13px;
                  width: 600px;
                  text-aling: center;
                  }
                  body{
                    background-position: center top;
                    background-repeat: no-repeat;
                  }

                </style>
    </head>
    <body >
<center>

      <div class="relative">
<img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/header.jpg">

        <div class="absolute">

            {!! $mensaje !!}

            <p>
              Inscríbete en los cursos gratuitos de MéxicoX que comienzan en agosto.
            </p>

            <table style="width: 600px;">
              <tr>
                <td style="padding: 10px; text-align: center;">
                  <a href="http://mx.televisioneducativa.gob.mx/courses/IIIDx/IIIDRn103x/2016_s2/about" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/1.png"></a>
                </td>
                <td style="padding: 10px; text-align: center;">
                  <a href="http://mx.televisioneducativa.gob.mx/courses/INEA/LPTMx/2016_S2/about" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/2.png"></a>
                </td>
              </tr>
              <tr>
                <td style="padding: 10px; text-align: center;">
                  <a href="http://mx.televisioneducativa.gob.mx/courses/UPN/VE_UPN001_2/2016_S2/about" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/3.png"></a>
                </td>
                <td style="padding: 10px; text-align: center;">
                  <a href="http://mx.televisioneducativa.gob.mx/courses/FEM-UAE/CBx/2016_T1/about" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/5.png"></a>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding: 10px; text-align: center;">
                  <a href="http://mx.televisioneducativa.gob.mx/courses/INEA/PPEH/2016E1/about" target="_blank"><img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/6.png"></a>
                </td>
              </tr>
            </table>

            <br>
              <p>Refuerza tus competencias laborales y conocimientos en esta comunidad de aprendizaje.</p>
            <br>


        </div>

      </div>

      <div class="relative">

         <img src='https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/linea.jpg' style="width: 600px;">
              <img src="https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/footer.jpg" style="width: 600px; height: 225px;" />

        <div class="absolute2">


<a href='http://www.facebook.com/TvEducativaMx'>
                <img src='https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/fb.png' class='img-rounded'>
                </a>
                <a href='https://twitter.com/tveducativamx'>
                <img src='https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/twitter.png' class='img-rounded'>
              </a><br>

                <a href='http://mx.televisioneducativa.gob.mx/'>
                <img src='https://s3-us-west-2.amazonaws.com/imagenes-mexicox/mail/boton.png' style="width: 125px; height: 25px; border-radius: 30px;">
              </a><br>
</div>
<div class="absolute3">
                <p><a href="http://mexicox.gob.mx/privacy"  target="_blank"> Consulta nuestro aviso de privacidad </a>
</p>

                <p>Si no quieres recibir más correos de MéxicoX da click
<a href="http://www.mexicox.gob.mx:81/reportesmx/public/mail/unsuscribe"> aquí</a>.
</p>

<br>

</div>
</div>
          </center>
    </body>
</html>
