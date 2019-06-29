@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    
    <div id="item" class="box ">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Item</h3>
    	</div>
    	<div class="box-body">
        @foreach ($itens as $item)  
    	    <form method="POST" action="{{ route('item.update', ['id' => $item->id]) }}">  	
    	    {!! csrf_field() !!}
            
            <div class="form-group"> 
                <div class="input-group"> 
                    <span class="input-group-addon">Categoria: </span>  
                    <select name="category_id" id="category_id" class="form-control select">
                        @foreach ($categories as $category)
                        <option {{ $category->id == $item->categories->id ? 'selected="selected"' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>    
            <div class="form-group"> 
    			<div class="input-group"> 
                    <span class="input-group-addon">Cliente: </span>  
				    <select name="user_id" id="user_id" class="form-control">
                        @foreach ($item->users as $user) 
				        <option selected="selected" value="{{ $user->id }}" disabled="disabled">{{ $user->name }} - {{ $user->email }}</option>
                        @endforeach
                            
				    </select>
				</div>
            </div>  
            @forelse ($item->products as $product) 
            <div class="form-group ">
                
                <div class="row"> 
                    <div class="col-xs-4">
                        <div class="product_row input-group" id="product_row">  
                            <span class="input-group-addon">Item: </span>  
                            <select name="product_id" id="product_id" class="form-control">
                            
                                
                                <option selected="selected" value="{{ $product->id }}" >{{ $product->name }} </option>
                                
                            </select>
                        </div>

                    </div> 
                    <div class="col-xs-4">
                        <div class="input-group">  
                            <span class="input-group-addon">Quantidade: </span>  
                            <input class="form-control" type="number" name="quantity" value="{{ $product->pivot->quantity }}">
                        </div>    
                    </div>
                    <div class="col-xs-4">
                        <div class="input-group">  
                            <span class="input-group-addon">Valor: </span>  
                            <input class="form-control" type="text" name="amount" value="{{ $product->pivot->amount }}">
                        </div> 
                    </div>
                </div> 

            </div>
            @empty

            @endforelse   
			<div class="form-group ">
                <div class="row"> 
                    <div class="col-xs-4">
                        <!-- Date -->
                        <div class="form-group">
                            <div class="input-group date" >
                                <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                <input type="text" class="form-control pull-right" id="datepicker" value="{{ date('d/m/Y', strtotime($item->payment_date)) }}">
                                
                                <input data-datepicker type="hidden" name="payment_date" id="payment_date" value="{{ date('Ymd', strtotime($item->payment_date)) }}">
                                
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div> 

                    <div class="col-xs-4">
                        <div class="input-group">
                            <span class="input-group-addon">Metodo: </span>  
                            <select class="form-control select2" name="payment_method" id="pag_method">      
                                <option {{ $item->payment_method == 1 ? 'selected="selected"' : '' }} value="1">Cartao</option>
                                <option {{ $item->payment_method == 2 ? 'selected="selected"' : '' }} value="2">Dinheiro</option>
                                <option {{ $item->payment_method == 3 ? 'selected="selected"' : '' }} value="3">A prazo</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-xs-4">
                        <div class="input-group">
                            <span class="input-group-addon">Status: </span>  
                            <select class="form-control select2" name="payment_status" id="status">
                                <option {{ $item->payment_status == 1 ? 'selected="selected"' : '' }}  value="1">Pago</option>
                                <option {{ $item->payment_status == 3 ? 'selected="selected"' : '' }}  value="3">Não pago</option>
                                <option {{ $item->payment_status == 2 ? 'selected="selected"' : '' }}  value="2">Pendente</option>
                            </select>
                        </div>
                    </div>
                </div>    
            </div>
            
            <div class="form-group">    
                <div class="row row_atributes">
                    <div class="col-xs-12 m-0">    
                        <textarea name="description" id="description" class="form-control select2" placeholder="Descricao">{{ $item->description }}</textarea>
                    </div>
                </div>

            </div>  
                
            <div class="row"> 
                <div class="col-xs-4 m-0">
                    <div class="form-group">
                        <label for="value">Adicional</label>
                        <div class="input-group">
                            
                            <span class="input-group-addon">R$</span>
                            <input class="form-control item" id="amount_add" type="text" name="credit" value="{{ $item->credit }}">
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="discount">Desconto</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input id="amount_discount" class="form-control item p-2" name="discount" value="{{ $item->discount }}">
                        </div>
                    </div>
                </div> 

                <div class="col-xs-4">
                    <div class="form-group">
                        <label for="total">Total</label>
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            <input class="form-control p-2 "  id="total" name="amount_total" disabled value="{{ $item->total }}">
                        </div>
                    </div>
                </div> 
                
            </div>
            
                <button type="submit" class="btn-block btn btn-primary">Atualizar</button>
			</form>
    	@endforeach	
    	</div>
    </div>
@stop

@section('css')
    <!-- Include base CSS (optional) -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css"> -->
    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <style type="text/css">
        .choices__list {
            z-index: 5;
        } 
    </style>
@stop
@section('js')
    
    <script src="../plugins/datepicker/datepicker.min.js"></script>
    <!-- Include Choices JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready( function() {
           
            // $('#payment_date').datepicker({
            //     dateFormat: 'yyyy-mm-dd',
            //     altFormat: 'yyyy-mm-dd'
            // })

            $('#datepicker').datepicker({
                format: 'dd/mm/yyyy',
                //autoclose: true,
                
            })
            $('#datepicker').change( function () {
                
                var dataPicker = $(this).datepicker('getDate').toISOString().slice(0,10)
                
                $('#payment_date').val(dataPicker)
         
            })

            
        //     // function rowAddOrRemve(button) {
        //     //     console.log($(this)) 
        //     // } 
            
        //     // $('.row_copy, .row_atributes').on("change click", function() {
        //     //     console.log($(this)) 
        //     // })

        //    // $('.addRow').trigger('click')
        })
        
        




    </script> 



    <!-- <script type="text/javascript">
        

        $( function () {
            var $originalSelects = []
            var $countRows = 0
            
            var $document = $(document) 
            


            function getProducts(form = null, id = null) {
                
                $.get(`/api/products/${id}`, function (data) {      
                    data.map( (elem, index) => {
                        $(form).find('.calcular').val(parseFloat(elem.price_sale))
                        sum()
                            
                    })
                })

            } 
            
            

            function setInput(term) {       
                $('.inputs').append($('<input>', {
                    type: 'hidden',
                    value: term,
                    name: 'new_product[]',
                    class:'new_product'
                }))
            } 

            function countRows() {
                var count = $('.row_copy').length - 1
     
                $('.row_copy').each( (i, item)=> {
                    if (i == count) {
                        if (!$(item).hasClass('add_'+ count)) {
                            $(item).removeClass().addClass('row row_copy add_'+ count)
                            
                            //setAmountTotal($(item).find('.amount_value input').val())
                        }   


                    }



                })

          
                return count
            }
             
            $('#item').on('change', '.select', function (e)  {
                var targetSelect = $(e.target).closest('.row_copy')
                getProducts($(e.target).closest('div.row_copy'), $(e.target).val())
                
            })    

            $('#item').on("select2:select", '.product_id', function(e) { 
                var id = parseInt(e.params.data.id)
                
                setInput(e.params.data.text)

                if (!typeof id == 'number' && !Number.isInteger(id)) {
                    return   
                }
          
                sum()
                
            })      
            
            // function setClass(value) {
                
            //     $(value).find('.row_copy').each( (i, item)=> {
                    
            //         if(i != 0) {
            //             $(item).find('button').addClass('removeRow').removeClass('addRow') 
            //             $(item).find('.removeRow .fa').removeClass('fa-plus')
            //             $(item).find('.removeRow .fa').addClass('fa-minus')
                        
            //             //if ($('.product_row div').hasClass('add_'+ rowCount)) {
            //             //console.log(count)       
            //             countRows()
                        
            //         }                    

            //         $('.select').select2({placeholder: 'Escolha um produto', tags : true })
            //     })
            // }

            $document.on('click', '.addRow', (e, item) => {
                var $original  = $('.row_copy:last') 
                

                $originalSelects = $original.find('.select')
                // console.log($originalSelects)
                $(this).find('.select').select2('destroy')
                
                //console.log($('.row_copy').length)
                for (var i = 0; i <= $('.row_copy').length; i++) {
                    
                   // console.log(i)
                
                }
                $original.clone().appendTo('.product_row').find('.row_copy').addClass()

                //setClass(this)
                 
                sum()
                                
            })

            $('button').click( function () {
                console.log($('add_0').eq(0))  
            })

            $('#item').on('click', '.removeRow', function() {
             
                if($(this).parents('.row_copy').remove()) {
                    
                    $countRows -= 1
                    //console.log($countRows, 'MENOS')
                } 
                sum()
            })   

            $('#item .select').select2({
                placeholder: 'Escolha um produto',
                tags: true                        
            })
            
            $('#pag_method').change( function() {
                
                if ($(this).val() == 2) {
                   $('#status').val(1)
                } else if ($(this).val() == 0) {
                   $('#status').val(0)
                }
            })

            var amount_discount = 0
            var amount_add = 0
            var quantity = 0

            $('#amount_discount').change( function() {
                amount_discount = (parseInt($(this).val(), 10) || 0)
                sum()
            })

            $('#amount_add').change( function() {     
                amount_add = (parseInt($(this).val(), 10) || 0)
                sum()
            })

            $(document).on('change', '.quantity', function() {     
                quantity = ($(this).val() || 0)
                //console.log(quantity)
                sum()
                
            })

            function sum() {
                var sum = $('.calcular').get().reduce( function(sum, el) {
                    console.log(el.value)
                    var value = (quantity.length > 0) ? quantity * parseInt(el.value, 10) : parseInt(el.value, 10) 
                    return (value + sum || 0)  
                }, 0)
                 
                document.getElementById('total').value = sum - amount_discount + amount_add
            }


        })



        function monitorEvents(element) {
          var log = function(e) { console.log(e);};
          var events = [];
          
          for(var i in element) {
            if(i.startsWith("on")) events.push(i.substr(2));
          }
          events.forEach(function(eventName) { 
            element.addEventListener(eventName, log); 
          }); 
        }

        monitorEvents(document.querySelector('.row_copy'))
    </script> -->
@stop