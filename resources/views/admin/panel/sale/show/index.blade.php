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
      <h3 class="box-title">#{{ $item->id }} - Item</h3>
    </div>
    <div class="box-body" >
	    <div class="row form-group">
	        <div class="col-xs-6">
	            <div class="input-group">  
	                <span class="input-group-addon">Categoria</span>  
	                <input type="text" class="form-control" disabled="disabled" value="{{ $item->categories->name }}">
	            </div>
	        </div>    
            @forelse ($item->users as $user)
	        <div class="col-xs-6">
				<div class="input-group">  
	                <span class="input-group-addon">Usuario</span>  
				    <input type="text" class="form-control" disabled="disabled" value="{{ $user->name }}">
				</div>
	        </div>    
			@empty

            @endforelse
	            
        </div>

        <div class="row form-group">
            @forelse ($item->products as $product)
            <div class="col-xs-4">
                <div class="input-group">  
                    <span class="input-group-addon">Item</span>  
                    <input type="text" class="form-control" disabled="disabled" value="{{ $product->name }}">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="input-group">  
                    <span class="input-group-addon">Quantidade</span>  
                    <input type="text" class="form-control" disabled="disabled" value="{{ $product->pivot->quantity }}">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="input-group">  
                    <span class="input-group-addon">Valor</span>  
                    <input type="text" class="form-control" disabled="disabled" value="{{ $product->pivot->amount }}">
                </div>
            </div>
            @empty

            @endforelse
        </div>           
        <div class="row form-group"> 
            <div class="col-xs-4">
                <div class="input-group " >
                    <span class="input-group-addon">Data</span>  
                    <input type="text" class="form-control pull-right" id="datepicker" value="{{ date('d/m/Y', strtotime($item->payment_date)) }}" disabled="disabled">
                </div>
            </div> 
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">Forma de pagamento</span>  
                    <input type="text" class="form-control" value="{{ $item->payment_method }}" disabled="disabled">
                </div>
            </div>

            
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">Status</span>  
                    <input type="text" class="form-control pull-right" value="{{ $item->payment_status }}" disabled="disabled">
                </div>
            </div>
        </div>    
         
        
        <div class="row form-group"> 
            <div class="col-xs-4 m-0">   
                <div class="input-group">
                    <span class="input-group-addon">Adicional</span>
                    <input type="text" class="form-control pull-right" value="{{ $item->credit }}" disabled="disabled">
                </div>
            </div>
            
            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">Desconto</span>
                    <input type="text" class="form-control pull-right" value="{{ $item->discount }}" disabled="disabled">
                    
                </div>
            </div> 

            <div class="col-xs-4">
                <div class="input-group">
                    <span class="input-group-addon">Total</span>
                    <input type="text" class="form-control pull-right" value="{{ $item->amount_total }}" disabled="disabled">
                    
                </div>
            </div>
        </div>     
        <div class="row form-group"> 
            <div class="col-xs-12 m-0">    
                <div class="form-group">
                    <textarea name="description" id="description" class="form-control select2" disabled="disabled">{{ $item->description }}</textarea>
                </div>
            </div>
            
        </div>
	</div>        
@stop  
      