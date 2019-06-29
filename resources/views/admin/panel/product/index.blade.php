@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Produto</h3>
    	</div>
    	<div class="box-body"> 
    	    <form method="POST" action="{{ route('product.store') }}">  	
    	        {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control p-2" id="name" name="name">
                </div>
                <div class="row"> 
                    
                    <div class="col-xs-6">    
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                <option value=""></option>
                                
                                @if ($categories->count() > 0) 
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <input type="hidden" name="category_name" id="new_category">
                    </div>
                    <div class="col-xs-6">  
            			<div class="form-group">
        				    <label for="brand_id">Marca</label>
        				    <select name="brand_id" id="brand_id" class="form-control select2">
        				        <option value=""></option>
                                @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option> 
                                @endforeach
        				    </select>
        				</div>
                        <input type="hidden" name="brand_name" id="new_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="quantity">Quantidade</label>
                            <input type="number" class="form-control p-2" id="quantity" name="quantity" value="1">
                        </div>
                    </div> 

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="price_cost">Valor normal</label>
                            <input type="text" class="form-control p-2"  id="price_cost" name="price_cost">
                        </div>
                    </div> 
                    
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="price_sale">Valor de venda</label>
                            <input type="text" class="form-control p-2"  id="price_sale" name="price_sale">
                        </div>
                    </div>                    
                </div>  

                <div class="form-group">
                    <textarea name="description" id="description" class="form-control select2" placeholder="Descricao"></textarea> 
                </div>    

                        

                <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready( function() {
        
        targ = ['#category_id', '#brand_id']

        $("#category_id").select2({
           // placeholder: 'Escolha um produto',
            tags : true,  
            // matcher: matchCustom
            createTag: function (params, data) {
                var term = $.trim(params.term);

                
                console.log(params.term)  
                if (term === '') {
                    return null
                }
                
                $('#new_category').val(params.term)  
                
                return {
                    id: term,
                    text: term,
                    newTag: true, // add additional parameters
                    isNew: true
                }
            },
        })

        $("#brand_id").select2({
           // placeholder: 'Escolha um produto',
            tags : true,  
            // matcher: matchCustom
            createTag: function (params, data) {
                var term = $.trim(params.term);

                
                console.log(data)  
                if (term === '') {
                    return null
                }
                
                $('#new_brand').val(params.term)  
                
                return {
                    id: term,
                    text: term,
                    newTag: true, // add additional parameters
                    isNew: true
                }
            },
        })
})
</script>    
@stop
