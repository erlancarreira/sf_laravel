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
      <h3 class="box-title">Produtos</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">

    @forelse ($products as $product) 
    <!-- /.box-header -->
    <div class="box-body" >
      <table id="tableData" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>CATEGORIA</th>
            <th>MARCA</th>
            <th>QUANTIDADE</th>
            <th>VALOR NORMAL</th>
            <th>VALOR VENDA</th>
            <th>DESCRICAO</th>
            <th>ACOES</th>
          </tr>
        </thead>
        <tbody>
          <tr> 
            <th>{{ $product->id }}</th>              
            <td data-name="{{ $product->name }}">{{ $product->name }}</td>
          @foreach ($product->categories as $category)
            <td data-category-id="{{ $category->id }}">{{ $category->name }}</td>
          @endforeach
          @foreach ($product->brands as $brand)
           
            <td data-brand-id="{{ $brand->id }}">{{ $brand->name }}</td>
           
          @endforeach
            <td data-quantity="{{ $product->stock }}">{{ $product->stock }}</td>
            <td data-price_coast="{{ $product->price_cost }}">{{ $product->price_cost }}</td>
            <td data-price_sale="{{ $product->price_sale }}">{{ $product->price_sale }}</td>
            <td data-price_sale="{{ $product->description }}">{{ $product->description }}</td>

           
            <td id="subActions">
              <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $product->id }}"></a>
              <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="client btn-sm btn btn-danger fa fa-trash" data-delete="{{ $product->id }}"></a>
            </td>     
          </tr>
         
          </tbody>
          
      </table>
    </div>
    <!-- /.box-body -->
   
    @empty
              
    
    <div class="box-title">  
      <h4>Nenhum produto cadastrado!</h4>
    </div>
   
    @endforelse
    


    </form>
</div>
@stop
<!-- /.box -->
    
