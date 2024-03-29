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
      <h3 class="box-title">Contas a pagar listar</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">

    

    <!-- /.box-header -->
    <div class="box-body">
      @if ($bills->count() > 0)
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
                       
          @foreach ($bills as $bill) 
          <tr> 
            <td>{{ $bill->id }}</td> 
             
            @foreach ($bill->users as $user)
            <td data-category-id="{{ $user->id }}">{{ $user->name }}</td>
            @endforeach
            @if ($bill->attributes->count() > 0) 
            
           
            <td >{{ $bill->attributes[0]->name }}</td>
          
            <td >{{ $bill->attributes[0]->quantity  }}</td>
            <td> {{ $bill->attributes[0]->amount   }}</td>
           
            @else

            @foreach ($bill->products as $product)
              @if ($product->pivot->product_id == $product->id)
            <td> {{ $product->name }}</td>
              @endif
            <td> {{ $product->pivot->quantity }}</td>
            <td> {{ $product->pivot->amount }}</td>
            @endforeach
            
            @endif
            
            
            <td class="payment_date" data-quantity="{{ $bill->payment_date }}">{{ $bill->payment_date }}</td>
            <td class="payment_method" data-payment_method="{{ $bill->payment_method }}">{{ $bill->payment_method }}</td>
            <td class="payment_status" data-payment_status="{{ $bill->payment_status }}">{{ $bill->payment_status }}</td>
            <td data-price_bill="{{ $bill->description }}">{{ $bill->description }}</td>
            <td data-price_bill="{{ $bill->credit }}">{{ $bill->credit }}</td>
            <td data-price_bill="{{ $bill->discount }}">{{ $bill->discount }}</td>
            <td data-price_bill="{{ $bill->amount_total }}">{{ $bill->amount_total }}</td>


           
            <td id="subActions">
              <a href="{{ route('item.show', ['id' => $bill->id]) }}" class="client btn-sm btn btn-primary fa fa-eye"></a>
              <a href="{{ route('item.edit', ['id' => $bill->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $bill->id }}"></a>
              <a href="{{ route('item.delete', ['id' => $bill->id]) }}" class="client btn-sm btn btn-danger fa fa-close" data-delete="{{ $bill->id }}"></a>
            </td>     
          </tr>
        @endforeach
        </tbody>
          
      </table>
      <div class="row"> 
        <div class="col-md-5">  
          <div style="margin-top: 30px;">  
            <p>Pagina {{ $bills->currentPage() .' mostrando de '.  $bills->count() .' ate '. $bills->total() }} registros</p>
          </div>       
        </div> 
        <div class="col-md-7 ">        
          
          <div class="pull-right">
            {{ $bills->links() }}
          </div>
        </div>        
      </div>
      @else
            
      <div class="box-title">  
        <h5>Nenhuma fatura cadastrada!</h5>
      </div>
      
      @endif
        
    </div>
    
       

    <!-- /.box-body -->   
   


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
    
