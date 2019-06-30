@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="row" style="display: none;">
  <div class="col-xs-12">
    <div class="alert " role="alert" id="msg">     
        <button type="button" class="fa close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>  
    </div>
  </div>
</div>
<div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Listar Vendas</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">

    @if ($services->count() > 0)

    <!-- /.box-header -->
    <div class="box-body" >
      <table id="tableData" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>CLIENTE</th>
            <th>PRODUTO</th>
            <th>QUANTIDADE</th>
            <th>VALOR</th>
            <th>DATA</th>
            <th>METODO DE PAG</th>
            <th>STATUS</th>
            <th>DESCRICAO</th>
            <th>ADICIONAL</th>
            <th>DESCONTO</th>
            <th>TOTAL</th>
            <th>ACOES</th>
          </tr>
        </thead>
        <tbody>
                       
          @foreach ($services as $service) 
          <tr> 
            <td>{{ $service->id }}</td> 
             
            @foreach ($service->users as $user)
            <td data-category-id="{{ $user->id }}">{{ $user->name }}</td>
            @endforeach
            @if ($service->attributes->count() > 0) 
            
           
            <td >{{ $service->attributes[0]->name }}</td>
          
            <td >{{ $service->attributes[0]->quantity  }}</td>
            <td> {{ $service->attributes[0]->amount   }}</td>
           
            @else

            @foreach ($service->products as $product)
              @if ($product->pivot->product_id == $product->id)
            <td> {{ $product->name }}</td>
              @endif
            <td> {{ $product->pivot->quantity }}</td>
            <td> {{ $product->pivot->amount }}</td>
            @endforeach
            
            @endif
            
            
            <td class="payment_date" data-quantity="{{ $service->payment_date }}">{{ $service->payment_date }}</td>
            <td class="payment_method" data-payment_method="{{ $service->payment_method }}">{{ $service->payment_method }}</td>
            <td class="payment_status" data-payment_status="{{ $service->payment_status }}">{{ $service->payment_status }}</td>
            <td data-price_sale="{{ $service->description }}">{{ $service->description }}</td>
            <td data-price_sale="{{ $service->credit }}">{{ $service->credit }}</td>
            <td data-price_sale="{{ $service->discount }}">{{ $service->discount }}</td>
            <td data-price_sale="{{ $service->amount_total }}">{{ $service->amount_total }}</td>


           
            <td id="subActions">
              <a href="{{ route('service.show', ['id' => $service->id]) }}" class="client btn-sm btn btn-primary fa fa-eye"></a>
              <a href="{{ route('service.edit', ['id' => $service->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $service->id }}"></a>
              <a href="{{ route('item.deletar', ['id' => $service->id]) }}" class="client btn-sm btn btn-danger fa fa-close" data-delete="{{ $service->id }}"></a>
            </td>     
          </tr>
        @endforeach
        </tbody>
          
      </table>
      <div class="row"> 
        <div class="col-md-5">  
          <div style="margin-top: 30px;">  
            <!-- <p>Pagina  $service->currentPage() .' mostrando de '.  $service->count() .' ate '. $service->total() }} registros</p> -->
          </div>       
        </div> 
        <div class="col-md-7 ">        
          
          <div class="pull-right">
            <!--  $service->links() }} -->
          </div>
        </div>        
      </div>     
    </div>

    <!-- /.box-body -->   
    @else
              
    <div class="box-body">
      <div class="box-title">  
        <h3>Nenhum item cadastrado!</h3>
      </div>
    </div>
    @endif
    


    </form>
</div>
@stop

@section('js')
  <script type="text/javascript">
    var payment_date   = document.getElementById('payment_date')
    var payment_method = document.querySelectorAll('.payment_method')
    var payment_status = document.querySelectorAll('.payment_status')
    console.log(payment_status)   
    function setStatusMethod(value) {
      
      value.forEach( (e) => { 
        console.log(e)
        switch (e.textContent) {
          case '1':
            e.textContent =  (e.className == 'payment_status') ? 'Pago' : 'Cartao'   
            break

          case '2':
            e.textContent =  (e.className == 'payment_status') ? 'Pendente' : 'Dinheiro'    
            break
            
          case '3':
            e.textContent =  (e.className == 'payment_status') ? 'Nao pago' : 'A prazo'  
            break         
        }
      })  
    }  

    setStatusMethod(payment_method)
    setStatusMethod(payment_status)

    

  </script>
@stop
<!-- /.box -->
    
