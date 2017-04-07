@extends('cursos') @section('contentd')
<center> <h4>Inscripción</h4></center>

<div class="container">
    <div class="row">
        
        <div>
                    <br>
                    
            <table class="table table-hover">
               <thead>
                <tr>
                    
                    <td class="warning" aling="right" style="font-size: medium">#</td>
                    <td class="warning" aling="right" style="font-size: medium">Nombre</td>
                    <td class="warning" aling="right" style="font-size: medium">ID Curso</td>
                    <td class="warning" style="font-size: medium">Institución</td>
                    <td class="warning" aling="right" style="font-size: medium">Inicio Curso</td>
                    <td class="warning" aling="right" style="font-size: medium">Fin del Curso</td>
                    <td class="warning" aling="right" style="font-size: medium">Inicio Inscripción</td>
                    <td class="warning" aling="right" style="font-size: medium">Fin Inscripción</td>
                    
                    
                </tr>
                
                </thead>

                <?php $total = 0; $j=$no_activos->currentPage()*10;?>
                    @foreach ($no_activos as $i)
                        <tbody>
                        <tr> 
                        <td aling="right">{{$j-9}}</td>
                        <td aling="right">{{$i->display_name}}</td>
                        <td aling="right">{{$i->id}}</td>
                        <td aling="right">{{$i->display_org_with_default}}</td>
                        <td aling="right">{{substr($i->start, 0, -9)}}</td>
                        <td aling="right">{{substr($i->end, 0, -9)}}</td>
                        <td aling="right">{{substr($i->enrollment_start, 0, -9)}}</td>
                        <td aling="right">{{substr($i->enrollment_end, 0, -9)}}</td>
                        
                            <?php $j++; ?>
                        @endforeach
                        
                        </tr>
            </tbody>
            
            </table>
                    

        </div>
        
        <a class="btn btn-default" href="{{url ('/download/no_activos.csv')}}" role="button">Descargar archivo csv</a>
        
    </div>
    
        <div class="pagination-wrapper"> {!! $no_activos->render() !!} </div>
</div>
@endsection
