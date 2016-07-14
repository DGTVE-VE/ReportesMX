
@extends ('layouts.clean')
@section ('content')
    <div class="container">
        <div class='row'>                
            <div class='col-md-offset-3 col-md-7'>
                <form id="target" class="form-horizontal" role="form" method="POST" action='{{url('mail/unsuscribe')}}'>
                    {{csrf_field ()}}
                    <div class="form-group">
                        <label class="col-sm-8" for="email">Ingresa tu correo para dejar de recibir noticias de México X. </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="asunto" name='email'
                                   placeholder="Ingresa tu correo">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-sm-offset-2 col-sm-2">
                            <button name="submit" value="send" type='submit' class="btn btn-danger" id="btnSubmit">
                                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                Quiero dejar de recibir correos de México X
                            </button>

                          </div>        
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


