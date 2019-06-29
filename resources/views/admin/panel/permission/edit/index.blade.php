@extends('adminlte::page')

@section('title', 'Editar Role')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Editar Role</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('role.store') }}">  	
    	        {!! csrf_field() !!}		
				
				<div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                <input type="text" name="name" class="form-control" placeholder="Tipos de usuario">
	            </div>
	            <br>

	            <button type="submit" class="btn-block btn btn-primary">Atualizar</button>
			</form>
    		
    	</div>
    </div>
@stop