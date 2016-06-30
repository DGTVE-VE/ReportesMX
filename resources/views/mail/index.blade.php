
@extends ('app')
@section ('content')
        <div class="container">
            <div class='row'>                
                <div class='col-md-offset-2 col-md-7'>
                    <form id="target" class="form-horizontal" role="form" method="POST" action='{{url('mail/send')}}'>
                        {{csrf_field ()}}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Asunto: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="asunto" name='asunto'
                                       placeholder="Asunto del correo">
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">Correos: </label>
                            <div class="col-sm-10">

                                <select class='form-control'>
                                    <option value='0'> Seleccione un curso </option>

                                </select>

                            </div>
                        </div>-->
                        <textarea name='mensaje' rows="8" placeholder="Escribe aquí tu mensaje..."></textarea>
                        <br>
                         <div class="form-group">
                                    
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-7 col-sm-2">
                                <button name="submit" value="preview" type='submit' class="btn btn-default" id="btnSubmit">
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    Previsualizar
                                </button>
                              </div>
                            <div class="col-sm-offset-1 col-sm-2">
                                <button name="submit" value="send" type='submit' class="btn btn-default" id="btnSubmit">
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                    Enviar
                                </button>

                              </div>        
                        </div>
                    </form>
                    
                    </div>
                
                    
                        
                    @if (isset ($info))
                    <div class="col-md-offset-2 col-md-7 alert alert-success fade in" style="margin-top:18px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                        <span>{{$info}}</span>
                    </div>
                    @endif
                </div>
            </div>
        @endsection


        <!-- Scripts -->
@section ('scripts')
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>
            tinymce.init({ 
                selector:'textarea', 
//                images_upload_credentials: true,
//                plugins:'image',
//                automatic_uploads: true
            });
        </script>
@endsection