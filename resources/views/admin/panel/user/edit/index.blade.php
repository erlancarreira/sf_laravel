@extends('adminlte::page')

@section('title', 'Editar Cliente')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Editar Cliente</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('user.store') }}">  	
    	        {!! csrf_field() !!}		
				
				<div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
	            </div>
	            <br>

	            <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	                <input type="email" name="email" class="form-control" value="{{ $user->email }}">           
	            </div>
	            <br>

	            <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
	                <input type="tel" name="phone" class="form-control" value="{{ $user->phone }}">
	            </div>
	            <br>

	            <button type="submit" class="btn-block btn btn-primary">Atualizar</button>
			</form>
    		
    	</div>
    </div>
@stop