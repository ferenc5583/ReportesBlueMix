@extends("theme.$theme.layout")
@section('titulo')
Compra Productos
@endsection
@section('styles')

<link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">


@endsection

@section('contenido')

    <div class="container-fluid">
        <h3 class="display-3">Costos</h3>
        <div class="row">
          <div class="col-md-12">
            {{-- BUSCADOR --}}
            <hr>

                 <form action="{{route('costosfiltro')}}" method="post"  id="desvForm" class="form-inline">
                         @csrf
                               
                               <div class="form-group mx-sm-3 mb-2">
                                @if (empty($anio))
                                   <label for="inputPassword2" class="sr-only"></label>
                                   <input type="number" name="anio" class="form-control" placeholder="Año..." >
                                   @else
                                   <input type="number" name="anio" class="form-control" placeholder="Año..." value="{{$anio}}" >
                                   @endif
                                 </div>

                                       

                                <div class="col-md-2 ">
                                        
                                  <button type="submit" class="btn btn-primary mb-2">Filtrar</button>
                             
                          </div>
                          <div class="col-md-2 col-md offset-">
                                        
                            <a href="" data-toggle="modal" data-target="#mimodalejemplo" class="btn btn-info">Info.</a>
                       
                    </div>
                          
                             
                 </form>
              
                       {{-- FIN BUSCADOR--}}
              <table id="productos" class="table table-bordered table-hover dataTable table-sm">
                  <thead>
                    <tr>
                      <th scope="col" style="text-align:left">Marca</th>
                      <th scope="col" style="text-align:left">Cod. producto</th>
                      <th scope="col" style="text-align:left">Descripción</th>
                     
                    </tr>
                  </thead>
              
                  <tbody>
                        @if (empty($productos))
                    
                        @else
                        
                    @foreach($productos as $item)
                      <tr>
                        <td style="text-align:right">{{number_format($item->Cantidad,0,',','.')}}</td>
                        <td style="text-align:right">{{number_format($item->Costo_Unitario_actual,0,',','.')}}</td>
                        <td style="text-align:right">{{number_format($item->Costo_Total,0,',','.')}}</td>
                       
                      </tr>
                      @endforeach
                      @endif
                    </tbody>  
          
                </table>
                {{-- {{$productos->links()}} --}}
          </div>
        </div>
       
</div>
<!-- Modal -->
<div class="modal fade" id="mimodalejemplo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Información de la Consulta</h4>
      </div>
      <div class="modal-body">
         <div class="card-body">Consulta Orientada Para conocer la Compra de los productos, filtrando por la marca de estos y en un rango de fecha a definir por el usuario 
          y así conocer la cantidad de productos Comprados, con su respectivo costo total.</div>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cerrar</button>
     </div>
    </div>
  </div>
</div>
 <!-- FIN Modal -->
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#productos').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
            
        ],
          "language":{
        "info": "_TOTAL_ registros",
        "search":  "Buscar",
        "paginate":{
          "next": "Siguiente",
          "previous": "Anterior",
        
      },
      "loadingRecords": "cargando",
      "processing": "procesando",
      "emptyTable": "no hay resultados",
      "zeroRecords": "no hay coincidencias",
      "infoEmpty": "",
      "infoFiltered": ""
      }
    } );
  } );
  </script>
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/buttons.dataTables.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/$theme/plugins/datatables-bs4/css/jquery.dataTables.min.css")}}">
  <script src="{{asset("js/jquery-3.3.1.js")}}"></script>
  <script src="{{asset("js/jquery.dataTables.min.js")}}"></script>
  <script src="{{asset("js/dataTables.buttons.min.js")}}"></script>
  <script src="{{asset("js/buttons.flash.min.js")}}"></script>
  <script src="{{asset("js/jszip.min.js")}}"></script>
  <script src="{{asset("js/pdfmake.min.js")}}"></script>
  <script src="{{asset("js/vfs_fonts.js")}}"></script>
  <script src="{{asset("js/buttons.html5.min.js")}}"></script>
  <script src="{{asset("js/buttons.print.min.js")}}"></script>



<script src="{{asset("js/ajaxproductospormarca.js")}}"></script>

@endsection
