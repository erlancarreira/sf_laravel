@extends('adminlte::page')

@section('title', 'Cadastrar Cliente')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Cliente</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('user.store') }}">  	
    	        {!! csrf_field() !!}		
				
				<div class="input-group {{($errors->has('name')) ? 'has-warning' : '' }}">
	                
	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                <input type="text" name="name" class="form-control" placeholder="{{($errors->has('name')) ? $errors->first('name') : 'Nome do cliente' }}">
	                

	            </div>
	            <br>

	            <div class="input-group {{($errors->has('email')) ? 'has-warning' : '' }}">
	                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
	                <input type="email" name="email" class="form-control" placeholder="{{($errors->has('email')) ? $errors->first('email') : 'Email' }}">
	                     
	            </div>
	            <br>

	            <div class="input-group {{($errors->has('email')) ? 'has-warning' : '' }}">
	                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
	                <input type="tel" name="phone" class="form-control" placeholder="{{($errors->has('email')) ? $errors->first('phone') : 'Celular' }}">
	            </div>
	            <br>

	            <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>
@stop