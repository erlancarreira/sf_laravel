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
      <h3 class="box-title">Categorias cadastradas</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">
    
    @if (count($categories) > 0)
    <!-- /.box-header -->
    <div class="box-body" >
        <table id="tableData" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>ACOES</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($categories as $value) 
            <tr> 
              <th>{{ $value->id }}</th>              
              <td data-name="{{ $value->name }}">{{ $value->name }}</td>
              
              <input type="hidden" name="name" value="{{ $value->name }}">
              <td id="subActions">
               
                <a href="{{ route('category.edit', ['id' => $value->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $value->id }}"></a>
                <a href="{{ route('category.delete', ['id' => $value->id]) }}" class="client btn-sm btn btn-danger fa fa-trash" data-delete="{{ $value->id }}"></a>
              </td>     
            </tr>
            @endforeach
            </tbody>
            
        </table>
    </div>
    <!-- /.box-body -->
   
    @else
              
    <div class="box-body">
      <div class="box-title">  
        <h3>Você ainda não tem nenhum cliente cadastrado!</h3>
      </div>
    </div>
    @endif
    


    </form>
</div>
@stop
<!-- /.box -->
    
