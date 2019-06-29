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
      <h3 class="box-title">Permissoes cadastradas</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">
    
    @if ($roles->count() > 0)

    <!-- /.box-header -->
    <div class="box-body" >
        <table id="tableData" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>NOME</th>
              <th>LABEL</th>
              <th>ACOES</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($roles as $role) 
            <tr> 
              <th>{{ $role->id }}</th>              
              <td data-name="{{ $role->name }}">{{ $role->name }}</td>
              <td data-name="{{ $role->label }}">{{ $role->label }}</td>
              
              <input type="hidden" name="name" value="{{ $role->name }}">
              <td id="subActions">
                <a href="{{ route('role.edit', ['id' => $role->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $role->id }}"></a>
                <a href="{{ route('role.delete', ['id' => $role->id]) }}" class="client btn-sm btn btn-danger fa fa-close" data-delete="{{ $role->id }}"></a>
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
    
