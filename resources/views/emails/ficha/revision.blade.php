<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <h2> {{ $ficha->institucion->nombre_institucion }}</h2>
        {{$mensaje}}
        <a href="http://reportes.mexicox.gob.mx/formatos/ficha_tecnica/{{$ficha->id}}">
            <button> Revisar la ficha </button>
        </a>
        <hr>
        <br>        
    </body>
</html>