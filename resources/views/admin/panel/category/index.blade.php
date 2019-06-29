@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Categoria</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('category.store') }}">  	
    	        {!! csrf_field() !!}		
				
				<div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                <input type="text" name="name" class="form-control" placeholder="Nome da categoria">
	            </div>
	            <br>
                
                <div class="form-group">
	                <select id="category_id" name="category_id" class="form-control">
	                	<option value="" disabled selected hidden>Categoria Pai</option>
	                	@if (count($category) > 0)
	                  	    @foreach ($category as $value) 
	                  	    <option value="{{ $value['id'] }}">{{ $value['name'] }}</option> 
	                  	    @endforeach
	                  	@endif
	                </select>
                </div>
	            <!-- <div class="input-group">
	                <span class="input-group-addon"><i class="fa fa-user"></i></span>
	                <input type="text" name="subcategoria" class="form-control" placeholder="Subcategoria">
	            </div> -->
	            <br>

	            

	            <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>
@stop