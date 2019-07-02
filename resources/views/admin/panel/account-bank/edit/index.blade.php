@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    
    <div id="item" class="box ">
    	<div class="box-header">
    		<h3 class="box-title">Editar Conta</h3>
    	</div>
    	<div class="box-body">
    	    <form method="POST" action="{{ route('account-bank.update', ['id' => $bank_id]) }}">  	
    	        {!! csrf_field() !!}
                <div class="form-group ">
                    <select name="user_id" id="user_id" class="form-control">
                        <option value=""></option>
                        
                            <option class="" value=""></option>
                         
                    </select>
                </div>      
                    
                <div class="form-group ">
                    
                    <select id="listaBancos" class="form-control" name="ref">
                        <option disabled selected hidden></option>

                    </select>
                </div>

                <div class="form-group {{($errors->has('type')) ? 'has-warning' : '' }}"> 
                    <select class="form-control" name="type">
                        <option value="" disabled selected hidden></option>
                        <option value="0">Conta Poupanca</option>
                        <option value="1">Conta Corrente</option>
                    </select>
                </div>
                
                <div class="form-group ">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="full_name" class="form-control" placeholder="Titular da conta">
                    </div>
                </div>
                

                <div class="form-group "> 
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-drivers-license"></i></span>
                        <input id='cpf' type="text" name="cpf" class="cpf format form-control" placeholder="" >
                    </div>
                </div>      
                

                <div class="form-group ">  
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                        <input type="text" name="agency" class="form-control format" placeholder="" >
                    </div>
                </div>    
                
                
                <div class="form-group ">    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                        <input type="text" name="account_number" class="format form-control" placeholder="">
                    </div>
                </div>    
                

                <button type="submit" class="btn-block btn btn-primary">Atualizar</button> 
            
			</form>	
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