<!DOCTYPE HTML>
<html>
    <head>
        <title> México X</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">        
        <script   src="https://code.jquery.com/jquery-1.12.3.min.js"   integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="   crossorigin="anonymous"></script>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
    </head>
    <body>
        <div style="background-image: url('{{asset('imagenes/email/header.jpg')}}'); 
             background-repeat: no-repeat; 
             width: 600px; 
             margin: auto;">
            <div style='padding-top: 75px'>
                
                {!! $mensaje !!}
                
            </div>            
            <img src='{{asset('imagenes/email/linea.jpg')}}'
        </div>
        
        <div style="background-image: url('{{asset('imagenes/email/footer.jpg')}}'); 
             background-repeat: no-repeat; 
             width: 600px; 
             height: 225px;
             margin: auto;
             padding-top: 25px" 
             align='right'>
            <a href='http://www.facebook.com/TvEducativaMx'>
            <img src='{{asset('imagenes/fb.png')}}' class='img-rounded'>
            </a>
            <a href='https://twitter.com/tveducativamx'>
            <img src='{{asset('imagenes/twitter.png')}}' class='img-rounded'>
            </a>
            
        </div>
    </body>
</html>