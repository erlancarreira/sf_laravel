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
      <h3 class="box-title">Usuarios cadastrados</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">
    
    
    <!-- /.box-header -->
    <div class="box-body" >
      @if ($users->count() > 0)
      <table id="tableData" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>CELULAR</th>
            <th>EMAIL</th>
            <th>ACOES</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($users as $user) 
          <tr> 
            <th>{{ $user->id }}</th>              
            <td data-name="{{ $user->name }}">{{ $user->name }}</td>
            <td data-phone="{{ $user->phone }}">{{ $user->phone }}</td>   
            <td data-email="{{ $user->email }}">{{ $user->email }}</td>      
            <td id="subActions">
              <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="fa fa-cog client btn-sm btn btn-warning"></a>
              <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="fa fa-trash client btn-sm btn btn-danger"></a>
              </button>
            </td>     
          </tr>
          <input type="hidden" name="name" value="{{ $user->name }}">
          <input type="hidden" name="email" value="{{ $user->email }}"> 
          @endforeach
          </tbody>
          
      </table>
      @else
      <div class="box-title">  
        <h5>Você ainda não tem nenhum cliente cadastrado!</h5>
      </div>
      @endif
    </div>
    <!-- /.box-body -->
   
    
    


    </form>
</div>
@stop
<!-- /.box -->
    
