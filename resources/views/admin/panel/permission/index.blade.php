@extends('adminlte::page')

@section('title', 'Cadastrar Role')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar role</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('role.store') }}">  	
    	        {!! csrf_field() !!}		
				
				<div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
        	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
        	                <input type="text" name="name" class="form-control" placeholder="Sigla ou nome curto para o usuario">
        	            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="label" class="form-control" placeholder="Descricao">
                        </div>
                    </div>
                </div>
	            <br>

	            <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>
@stop