@extends('cursos') @section('contentd')
<center> <h4>Inicio</h4></center>
<div class="container">
    <div class="row">
        <div>
            <br>

            <table class="table table-hover">
               <thead>
                <tr>

                  <td class="danger" aling="right" style="font-size: medium">Nombre</td>
                  <td class="danger" aling="right" style="font-size: medium">ID Curso</td>
                    <td class="danger" style="font-size: medium">Institución</td>
                    <td class="danger" aling="right" style="font-size: medium">Fecha Inicio Curso</td>
                    <td class="danger" aling="right" style="font-size: medium">Fecha Fin Curso</td>
                    <td class="danger" aling="right" style="font-size: medium">Fecha Inicio Inscripción</td>
                    <td class="danger" aling="right" style="font-size: medium">Fecha Fin Inscripción</td>


                </tr>
                </thead>

                <?php $total = 0; ?>
                    @foreach ($activos as $i)
<tbody>
                    <tr>
                      <td aling="right">{{$i->display_name}}</td>
                      <td aling="right">{{$i->id}}</td>
                        <td aling="right">{{$i->display_org_with_default}}</td>
                        <td aling="right">{{substr($i->start, 0, -9)}}</td>
                        <td aling="right">{{substr($i->end, 0, -9)}}</td>
                        <td aling="right">{{substr($i->enrollment_start, 0, -9)}}</td>
                        <td aling="right">{{substr($i->enrollment_end, 0, -9)}}</td>


                    @endforeach
</tr>
                </tbody>
            </table>

        </div>
        <a class="btn btn-default" href="{{url ('/download/cursoa.csv')}}" role="button">Descargar archivo csv</a>
    </div>
</div>

@endsection
