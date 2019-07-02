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
    
    

    <!-- /.box-header -->
    <div class="box-body" >
      @forelse ($roles as $role) 
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

            </tbody>
            
        </table>
      @empty
      <div class="box-title">  
        <h5>Nenhum role cadastrado!</h5>
      </div>
      @endforelse
    </div>
    <!-- /.box-body -->
    </form>
    
</div>
@stop
<!-- /.box -->
    
