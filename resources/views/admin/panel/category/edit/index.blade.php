@extends('adminlte::page')

@section('title', 'Cadastrar Categoria')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Editar Categoria</h3>
    	</div>
    	<div class="box-body"> 
    	    <form method="POST" action="{{ route('category.update', ['id' => $category->id]) }}">  	
    	        {!! csrf_field() !!}		
				@include('includes.alerts') 
				<div class="form-group">
					<label for="name">Categoria</label>
	                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
	            </div>
	            
                <div class="form-group">
                	<label for="category_id">Categoria Pai</label>
	                <select id="category_id" name="category_id" class="form-control">
	                	
	                	<option></option>
                  	    @foreach ($categories as $value) 
                  	    <option {{ ($value->id == $category->category_id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                  	    @endforeach
	                  
	                </select>
                </div>
	            
	            <button type="submit" class="btn-block btn btn-primary">Atualizar</button>
			</form>	
    	</div>
    </div>
@stop