@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    
    <div id="item" class="box ">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Item</h3>
    	</div>
    	<div class="box-body"> 
    	    <form method="POST" action="{{ route('item.store') }}">  	
    	        {!! csrf_field() !!}
                @include('includes.alerts') 
                <div class="inputs">
                </div>
                
    			<div class="form-group {{($errors->has('user_id')) ? 'has-warning' : '' }}">
				    
				    <select name="user_id" id="user_id" class="form-control">
				        <option selected="selected" value="">{{($errors->has('user_id')) ? 'Selecione um cliente' : 'Escolha um cliente' }}</option>
                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                            <option class="{{ ($user->id === $id) ? 'alert-success' : '' }}" value="{{ $user->id }}">{{ $user->email }} </option>
                            @endforeach
                        @endif 
				    </select>
				</div>
                <div class="form-group {{($errors->has('type')) ? 'has-warning' : '' }}">
                    
                    <select name="type" id="type" class="form-control">
                        <option selected="selected" value="">{{($errors->has('type')) ? 'Selecione um tipo' : 'Escolha um tipo' }}</option>
                        <option value="sale">Venda</option>
                        <option value="service">Servico</option>
                        <option value="bill">Contas a pagar</option>
                            
                    </select>
                </div>

                <div class="product_row" id="product_row">  
                    <div class="row row_copy" > 

                        <div class="col-md-7">
                            <div class="form-group {{($errors->has('product_id')) ? 'has-warning' : '' }}">
                                <div class="input-group ">
                                    <input list="option_0" id="list_0" data-current name="product_name[]" class="form-control product_id item" placeholder="{{($errors->has('product_id')) ? 'Essa opcao eh requerida' : 'Escolha ou crie...' }}">
                                    <input type="hidden" name="product_id[]" class="product_idList">  
                                    <datalist id="option_0">
                                        <select>
                                        @if ($products->count() > 0)
                                            @foreach ($products as $product)

                                        <option data-id="{{ $product->id }}" value="{{ $product->name }}"></option>
                                            @endforeach
                                        @endif 
                                        </select>
                                    </datalist>
                                    <span class="input-group-addon btn btnClear" style="padding: 0px 0px; ">
                                        <button type="button" class="fa fa-close fa-lg" style="background: transparent; border: none; outline: none; padding: 8px 8px;">
                                           
                                        </button>
                                    </span> 
                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Qt</span>
                                    <input type="number" min="1" class="form-control item quantity" name="quantity[]" value="1">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group amount_value {{($errors->has('amount')) ? 'has-warning' : '' }}">
                                
                                <div class="input-group">    
                                    <span class="input-group-addon">R$</span>
                                    <input type="number" step="any" name="amount[]" class="form-control item calcular" placeholder="{{($errors->has('amount')) ? 'Coloque o valor total' : '' }}">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-md-auto">
                            <button type="button" class="btnAction btn addRow fa fa-plus"></button>       
                        </div>
                    </div>
                </div>
                <div class="new_row">
                </div> 

				<div class="row">
                    <div class="col-xs-4">
                        <!-- Date -->
                        <div class="form-group {{($errors->has('payment_date')) ? 'has-warning' : '' }}">
                            <label>Data:</label>

                            <div class="input-group date" >
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" id="datepicker" placeholder="{{ ($errors->has('payment_date')) ? 'Selecione uma data' : '' }}">
                              <input data-datepicker type="hidden" name="payment_date" id="payment_date" >
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div> 

                    <div class="col-xs-4">
                        <div class="form-group {{($errors->has('payment_method')) ? 'has-warning' : '' }}">
                            <label for="pag_method">Forma de pagamento</label>
                            <select class="form-control select2" name="payment_method" id="pag_method" @if ($errors->has('payment_method')) {{ 'value="Selecione um metodo"' }} @endif>
                                <option value="">Escolha...</option>
                                <option value="1">Cartao</option>
                                <option value="2">Dinheiro</option>
                                <option value="3">A prazo</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-xs-4">
                        <div class="form-group {{($errors->has('payment_status')) ? 'has-warning' : '' }}">
                            <label for="status">Status</label>
                            <select class="form-control select2" name="payment_status" id="status" @if ($errors->has('payment_status')) {{ 'value="Selecione um status"' }} @endif>
                                <option value="">Escolha...</option>
                                <option value="1">Pago</option>
                                <option value="3">Não pago</option>
                                <option value="2">Pendente</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row row_atributes">
                    <div class="col-xs-12 m-0">    
                        <div class="form-group">
                            
                            <textarea name="description" id="description" class="form-control select2" placeholder="Descricao"></textarea>
                               
                        </div>
                    </div>

                </div>  
                
                <div class="row"> 
                    <div class="col-xs-4 m-0">
                        <div class="form-group">
                            <label for="value">Adicional</label>
                            <div class="input-group">
                                
                                <span class="input-group-addon">R$</span>
                                <input class="form-control item" id="amount_add" type="text" name="credit">
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="discount">Desconto</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input id="amount_discount" class="form-control item p-2" name="discount">
                            </div>
                        </div>
                    </div> 

                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                <input class="form-control p-2 "  id="total" name="total" disabled>
                            </div>
                        </div>
                    </div> 
                    
                </div>

                <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
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
        
        class Item {
            construtor () {
                this._quantity   = 1
                this._amount     = 0
                this._amount_row = 0
            }                    
        }
        var itens = document.querySelectorAll('.item')
        
       

        Array.from(itens).forEach(el => {
            el.addEventListener('change', function(e) { console.log(e) }, false) 
        })                
           
        var btnActions, 
            original,
            copy,
            allRows,
            btnRemove,
            count,
            product_row, 
            product_id = document.querySelector('.product_id'),
            res = [] 

            //console.log(btnId.length)
        
        // const choices = new Choices(product_id, {
        //     items: [],
        //     removeButton: true,
        //     choices: [{
        //         value: '',
        //         label: 'Escolha um produto',
        //         selected: true,
        //         disabled: false
        //     }],
        //     classNames: {
        //         inputCloned: 'choices__input--cloned',
        //         listSingle: 'choices__list--single',

        //     },
        //     addItems: true,
        //     callbackOnCreateTemplates: function (template) {
        //         return {
        //           item: (classNames, data) => {
        //             return template(`
        //               <div class="${classNames.item} ${data.highlighted ? classNames.highlightedState : classNames.itemSelectable}" data-item data-id="${data.id}" data-value="${data.value}" ${data.active ? 'aria-selected="true"' : ''} ${data.disabled ? 'aria-disabled="true"' : ''}>
        //                 <span>&bigstar;</span> ${data.label}
        //               </div>
        //             `);
        //           },
        //           choice: (classNames, data) => {
        //             return template(`
        //               <div class="${classNames.item} ${classNames.itemChoice} ${data.disabled ? classNames.itemDisabled : classNames.itemSelectable}" data-select-text="${this.config.itemSelectText}" data-choice ${data.disabled ? 'data-choice-disabled aria-disabled="true"' : 'data-choice-selectable'} data-id="${data.id}" data-value="${data.value}" ${data.groupId > 0 ? 'role="treeitem"' : 'role="option"'}>
        //                 <span>&bigstar;</span> ${data.label}
        //               </div>
        //             `);
        //           },
        //         };
        //       }    
        // })


        // const element = document.getElementsByClassName('select');
        // const example = new Choices(element);


        
        product_id = document.querySelector('datalist')
        

        function onChange() { 
            Array.from(document.getElementsByClassName('row_copy')).map( (el) => {
                el.addEventListener('changed', (e) => {
                    console.log('Aconteceu uma mudanca')
                })
            })
        }

        function setHandle(event, handler, selector) {
            if (event.target.matches(selector +', '+ selector + ' *')) {   
                handler.apply(event.target.closest(selector), arguments)  
            } 
        }

        function addEvent(parent, evt, selector, handler) {
            var timeout

            for (var i = 0; i < evt.length; i++) {

                parent.addEventListener(evt[i], function(event) {
                    
                    clearTimeout(timeout)
                    
                    timeout = setTimeout(function() {
                    
                        setHandle(event, handler, selector)
                    
                    }, 200)
                    
                   
                }, false)

            }
        }
    
          
        

        // // Find all inputs on the DOM which are bound to a datalist via their list attribute.
        // var inputs = document.querySelectorAll('input[list]');
        // for (var i = 0; i < inputs.length; i++) {
        //   // When the value of the input changes...
        //   inputs[i].addEventListener('change', function(e) {
        //     var optionFound = false,
        //       datalist = this.list;

        //       console.log(datalist)
            
        //     // Determine whether an option exists with the current value of the input.
        //     for (var j = 0; j < datalist.options.length; j++) {
        //         if (this.value == datalist.options[j].value) {
        //             optionFound = true;
        //             break;
        //         }
        //     }
        //     // use the setCustomValidity function of the Validation API
        //     // to provide an user feedback if the value does not exist in the datalist
        //     if (optionFound) {
        //       this.setCustomValidity('');
        //     } else {
        //       this.setCustomValidity('Please select a valid value.');
        //     }

        //     e.stopPropagation()
        //   });
        // }
    

        
        function httpGetAsync(theUrl, callback)
        {
            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() { 
                if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                    callback(xmlHttp.responseText);
            }
            xmlHttp.open("GET", theUrl, true); // true for asynchronous 
            xmlHttp.send(null);
        }


       
        function matchOption(list, opt) 
        { 
          
            for (var i = 0; i < list.options.length; i++) {
                if (list.options[i].value === opt.value) {
                   
                    httpGetAsync(`/api/products/${list.options[i].dataset.id}`, function(res) {
                        var result = JSON.parse(res)
                            opt
                            .parentNode
                            .parentNode
                            .parentNode
                            .parentNode
                            .querySelector('.calcular').value  = result[0].price_sale
                    })
                    
                    console.log(list.options[i].dataset.id )
                    opt.parentNode.querySelector('.product_idList').value = list.options[i].dataset.id 
                    
                    return opt.dataset.current = list.options[i].dataset.id || true
                }
            }
            return null
        }
        
        
       
        var quantity,
            amount,
            total, 
            id

        addEvent(document, ['change'], 'input', (e) => {
            var target = e.target
            

            
            
            if (target.matches('.quantity')) {
                quantity = target.value
            } 
            if (target.matches('.calcular')) {
                amount = parseInt(target.value, 10)
            }

            if (target.matches('.product_id')) {
                
                id = matchOption(product_id, target)
                
                //if (id != undefined && id.length > 0) {
                

               // }
                
            } 


            if (quantity != undefined && amount != undefined) {
                total = quantity * amount
            }  
            
            //console.log(total, value, option)

            e.stopPropagation()
        })

        function getProducts(form = null, id = null) {
                
            $.get(`/api/products/${id}`, function (data) {      
                data.map( (elem, index) => {
                    $(form).find('.calcular').val(parseFloat(elem.price_sale))
                    sum()
                        
                })
            })

        } 


         
        
        

        addEvent(document, ['keyup', 'change'], 'input', function (e) {
            product_row = document.getElementById('product_row')
            original = document.getElementsByClassName('row_copy')
              
            //matchOption(product_id, e.target)
            //console.log(e.target.path.closest('button'))
            //console.log(e.target.parentNode.lastElementChild.children.matches('button'))
            
            //matchOption(product_id, e.target) //.target.offsetParent.matches('.btnClear')) -- e.target.list.options
            if (e.target.matches('.btnClear')) {
                //e.target.parentNode.parentNode.querySelector('.product_id')
                //e.target.parentNode.parentNode.querySelector('.product_id '))
                //e.target.parentNode.parentNode.querySelector('.product_id').value = ''
            }
            
            if (e.target.matches('.addRow')) {
                
                copy = original[0].cloneNode(true)
                copy.querySelector('.btn').classList.replace('addRow', 'removeRow')
                copy.querySelector('.btn i').classList.replace('fa-plus', 'fa-minus')
                product_row.appendChild(copy)
            }

            if (e.target.matches('.removeRow')) {   
                
                original[1].parentNode.removeChild(original[1])
                    
            }   
            
            e.stopPropagation()
        })

        

        original = document.getElementsByClassName('row_copy')

        addEvent(document, ['click'], 'span.btnClear', function (e) {
            e.target.parentNode.parentNode.parentNode.querySelector('.product_id').value = ''
            e.target.parentNode.parentNode.parentNode.querySelector('.product_id').dataset.current = ''
            e.target.parentNode.parentNode.parentNode.querySelector('.product_idList').value = ''
            //e.target.parentNode.parentNode.querySelector('.calcular').value = ''
            console.log(e)
            console.log(e.path[5].querySelector('.calcular').value = '') //.target.parentNode.offsetParent.offsetParent.querySelector('.calcular'))
        })  


        addEvent(document, ['click'], 'button.addRow', function (e) {
            product_row = document.getElementById('product_row')
            copy = original[0].cloneNode(true)
            console.log(copy)
            copy.querySelector('button.btn').classList.replace('addRow', 'removeRow')
            copy.querySelector('button.btn').classList.replace('fa-plus', 'fa-minus')
            product_row.appendChild(copy)
        }) 

        addEvent(document, ['click'], 'button.removeRow', function (e) {
            original[1].parentNode.removeChild(original[1])
        })    

        // addEvent(document, ['click'], 'button', function (e) {
        //     product_row = document.getElementById('product_row')
        //     original = document.getElementsByClassName('row_copy')
            
            
        //     //matchOption(product_id, e.target)
        //     //console.log(e.target.path.closest('button'))
        //     //console.log(e.target.parentNode.lastElementChild.children.matches('button'))
        //     console.log(e)
        //     //matchOption(product_id, e.target) //.target.offsetParent.matches('.btnClear')) -- e.target.list.options
        //     if (e.target.closest('.btnClear') && e.target.value != null) {
        //         //e.target.parentNode.parentNode.querySelector('.product_id')
        //         //e.target.parentNode.parentNode.querySelector('.product_id '))
        //         e.target.parentNode.parentNode.querySelector('.product_id').value = ''
        //     }
            
        //     if (e.target.matches('.addRow')) {
                
        //         copy = original[0].cloneNode(true)
        //         copy.querySelector('.btn').classList.replace('addRow', 'removeRow')
        //         copy.querySelector('.btn i').classList.replace('fa-plus', 'fa-minus')
        //         product_row.appendChild(copy)
        //     }

        //     if (e.target.matches('.removeRow')) {   
                
        //         original[1].parentNode.removeChild(original[1])
                    
        //     }

            
            
        //     e.stopPropagation()
        // })

        
        
        // $('.select').select2({
        //     //placeholder: 'Escolha um produto',
        //     tags: true                        
        // })


        // Array.from(document.querySelectorAll('.addRow, .removeRow')).map( (element) =>  {
        //         //console.log(element)
        //     element.addEventListener('click', (rowUpdate, runBtn))
        //     // runBtn()   
        //     //     onChange()         
        //     //     e.stopPropagation()
            
        // }) 

        // [].forEach.call( document.querySelectorAll( '.btnAction' ), function ( a ) {
        //     a.addEventListener( 'click', function ( e ) {
        //         rowUpdate()
        //         alert( 'LINK was clicked' )
        //         e.preventDefault()
        //     }, false )
        // }) 

        
        
        //console.log(btnId)

        // if (btnRemove != undefined) {
        //     btnRemove.addEventListener('click', (e) => {
                
        //         console.log('removido')

        //         runBtn()

        //     }) 

        // }

         // function addEventListenerAll(element, events, fn) {

        //     events.split(' ').forEach(event => {

        //         element.addEventListener(event, fn, false)

        //     })

        // }
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