<head>
        <title>No Asociado a Curso</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding:0;
                width: 100%;
                color: #000000;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
                
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                
            }

            .content {
                text-align: center;
                display: inline-block;
                
                
            }

            .title {
                font-size: 20px;
                margin-bottom: 40px 20px;
                border-radius: 8px 8px 8px 8px;
                text-align:center; 
                font-family: Georgia, serif;
                line-height: 70%;
                letter-spacing: 4px;
               
             
	}

       </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                   <div class="content">
                       
                       <img src="logo_large.png" border=0>
                       <br><br>
                       
                       <div class="title" ><br><br>Tu correo no está asociado con algún curso en la platafarma.<br><br></div>
                                <br><br>
                           
                <form action="{{url('logout')}}" class="form-horizontal">
                    {!! csrf_field() !!}
                    
                <div class="form-group">
                 </form>  
                <div
                    <b class="col-sm-offset-2 col-sm-10">
                    
                    <button type="submit" class="btn btn-info" href="{{url('logout')}}">Salir</button>
                  </div>
                     </div>
                
                     </div>
        </div>
    </body>
</html>
