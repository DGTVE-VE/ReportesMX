@extends('app')

@section('content')
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
    <h1>
        Para el correcto funcionamiento de este formato <br>
        por favor utiliza alguno de los siguientes navegadores:
    </h1>
</div>
<div class='row'>
    <div class='col-md-6'>
        <a href='https://www.mozilla.org/es-MX/firefox/new/'>
            <img width='300' class='img img-responsive' src='{{asset ('imagenes/firefox.png')}}'>
        </a>
    </div>
    <div class='col-md-6'>
        <a href='https://www.google.com/chrome/'>
            <img width='300' class='img img-responsive' src='{{asset ('imagenes/chrome.png')}}'>
        </a>
    </div>
</div>
@endsection