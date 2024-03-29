@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Produto</h3>
    	</div>
    	<div class="box-body"> 
    	    <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}">  	
    	        {!! csrf_field() !!}

                <div class="form-group">
                    <label for="name">Nome</label>
                    <select name="name" id="name" class="form-control select2">
                    @foreach ($products as $prod)
                    <option {{ ($prod->id == $product->id) ? 'selected' : '' }} value="{{ $prod->name }}">{{ $product->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div class="row"> 
                    
                    <div class="col-xs-6">    
                        <div class="form-group">
                            <label for="category_id">Categoria</label>
                            <select name="category_id" id="category_id" class="form-control select2">
                                @foreach ($categories as $category)
                                <option {{ ($category->id == $product->categories->first()->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <input type="hidden" name="category_name" id="new_category">
                    </div>
                    <div class="col-xs-6">  
            			<div class="form-group">
        				    <label for="brand_id">Marca</label>
        				    <select name="brand_id" id="brand_id" class="form-control ">
        				        @foreach ($brands as $brand)
                                <option {{ ($brand->id == $product->brands->first()->id) ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
        				    </select>
        				</div>
                        <input type="hidden" name="brand_name" id="new_brand">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="stock">Quantidade</label>
                            <input type="number" class="form-control p-2" id="stock" name="stock" value="{{ $product->stock }}">
                        </div>
                    </div> 

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="price_cost">Valor normal</label>
                            <input type="text" class="form-control p-2"  id="price_cost" name="price_cost" value="{{ $product->price_cost }}">
                        </div>
                    </div> 
                    
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="price_sale">Valor de venda</label>
                            <input type="text" class="form-control p-2"  id="price_sale" name="price_sale" value="{{ $product->price_sale }}">
                        </div>
                    </div>                    
                </div>  

                <div class="form-group">
                    <textarea name="description" id="description" class="form-control select2">{{ $product->description }}</textarea> 
                </div>    

                        

                <button type="submit" class="btn-block btn btn-primary">Atualiza</button>
			</form>
    		
    	</div>
    </div>
@stop

@section('js')
<script type="text/javascript">
    $(document).ready( function() {
        
        targ = ['#name', '#brand_id']

        $("#name").select2({
           // placeholder: 'Escolha um produto',
            tags : true,  
            // matcher: matchCustom
            createTag: function (params, data) {
                var term = $.trim(params.term);

                
                console.log(data)  
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

        // $("#brand_id").select2({
        //    // placeholder: 'Escolha um produto',
        //     tags : true,  
        //     // matcher: matchCustom
        //     createTag: function (params, data) {
        //         var term = $.trim(params.term);

                
        //         console.log(data)  
        //         if (term === '') {
        //             return null
        //         }
                
        //         $('#new_brand').val(params.term)  
                
        //         return {
        //             id: term,
        //             text: term,
        //             newTag: true, // add additional parameters
        //             isNew: true
        //         }
        //     },
        // })
})
</script>    
@stop
