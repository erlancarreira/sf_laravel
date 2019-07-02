@extends('adminlte::page')

@section('title', 'Cadastrar Banco')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Conta</h3>
    	</div>
    	<div class="box-body">
    	    
    	    @include('includes.alerts') 
    	    
    	    <form method="POST" action="{{ route('account-bank.store') }}">  	
    	        {!! csrf_field() !!}

    	        <div class="form-group {{($errors->has('user_id')) ? 'has-warning' : '' }}">
				    <select name="user_id" id="user_id" class="form-control">
				        <option value="">{{ ($errors->has('user_id')) ? 'Selecione o usuario' : 'Escolha um cliente' }}</option>
                        @if (count($users) > 0)
                            @foreach ($users as $user)
                            <option class="{{ ($user->id === $id) ? 'alert-success' : '' }}" value="{{ $user->id }}">{{ $user->email }} </option>
                            @endforeach
                        @endif 
				    </select>
				</div>		
				
				<div class="form-group {{($errors->has('ref')) ? 'has-warning' : '' }}">
	                
	                <select id="listaBancos" class="form-control" name="ref">
	                  	<option disabled selected hidden>{{ ($errors->has('ref')) ? 'Selecione o banco' : 'Escolha um banco' }}</option>

	                </select>
                </div>

	            <div class="form-group {{($errors->has('type')) ? 'has-warning' : '' }}"> 
                    <select class="form-control" name="type">
                        <option value="" disabled selected hidden>{{ ($errors->has('type')) ? 'Selecione o tipo de conta' : 'Tipo de conta' }}</option>
                        <option value="0">Conta Poupanca</option>
                        <option value="1">Conta Corrente</option>
                    </select>
                </div>
                
                <div class="form-group {{($errors->has('full_name')) ? 'has-warning' : '' }}">
					<div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-user"></i></span>
		                <input type="text" name="full_name" class="form-control" placeholder="Titular da conta">
		            </div>
	            </div>
	            

                <div class="form-group {{($errors->has('cpf')) ? 'has-warning' : '' }}"> 
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-drivers-license"></i></span>
		                <input id='cpf' type="text" name="cpf" class="cpf format form-control" placeholder="{{($errors->has('cpf')) ? 'Cpf eh obrigatorio' : 'XXX-XXXXXX-XX' }}" >
		            </div>
	            </div>      
	            

                <div class="form-group {{($errors->has('agency')) ? 'has-warning' : '' }}">  
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-home"></i></span>
		                <input type="text" name="agency" class="form-control format" placeholder="{{($errors->has('agency')) ? 'Escolha uma agencia' : 'Agencia' }}" >
		            </div>
		        </div>    
	            
                
                <div class="form-group {{($errors->has('account_number')) ? 'has-warning' : '' }}">    
		            <div class="input-group">
		                <span class="input-group-addon"><i class="fa fa-bank"></i></span>
		                <input type="text" name="account_number" class="format form-control" placeholder="{{($errors->has('account_number')) ? 'Escolha uma conta' : 'Conta' }}">
		            </div>
		        </div>    
	            <br>

	            

	            <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>

@stop

@section('js')

    <script type="text/javascript">
	    var data = document.querySelectorAll('.format')

     //    function formatNumbers(value) {
	    //     value = value.replace(/[^\d]/g, "")
	      
		   //  if (value.length != undefined) { 
		        
		   //      if (value.length == 11) {
		          
		   //        value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4") //CPF
		        
		   //      } else if (value.length == 5) {
		        
		   //        value = value.replace(/(\d{4})(\d{1})/, "$1-$2") // AGENCY
		          
		       
		   //      } else if (value.length == 6) {

		   //        value = value.replace(/(\d{2})(\d{3})(\d{1})/, "$1.$2-$3") // ACCOUNT
		          
		   //      }
		   //  }  

	    //     return value || ''
	    // }
        
     //    Array.from(data).forEach( (e) => {
		   //  e.addEventListener('change', function(e) {
	    //         console.log(e)
			  //   e.target.value = formatNumbers(e.target.value)
			    
		   //  })
     //    }) 
    document.addEventListener("DOMContentLoaded", function(event) {    
        console.log(event)
        function setData(target) {
            var array = []
            // var data = data[0].value
            // for (var i = 0; i < data.length; i++) {
            // 	array[i] = data
            // } 
            
            

            console.log(array, target)

        }



        //Array.from(data).forEach( (e) => {
		data[0].addEventListener('keypress', keyPress)

        //})

        function keyPress(e) {
		    var digs   = []
		    var cpf    = ['000.000.000-00']
		    var cnpj   = ['21.627.883/0001-34']
		    if (e.target.value.length != '' || e.target.value != undefined) {
		        var total   = e.target.value.length 
			
    			digs.push(e.target.value) 
    			
    			//console.log(digs) 
    			
    			if (total == 3) {
			    	e.target.value += '.'    
			    } else if(total == 7) {
			    	e.target.value += '.'
			    } else if (total == 11) {
			    	e.target.value += '-'
			    }
			    setData(e.target.value) 
            }
        } 
	})    
	   

	    $(document).ready( function(){
	        
	        $.get('../listaBancos.json', function (data) {
                
                $(data).each( (i, item) => {
                	//console.log(item.label)
                	$('#listaBancos').append($('<option>', {
                        value: parseInt(item.value),
                        text: item.label  
                    }))
                })

            })
               
          
	        

	    })
    </script> 

@stop
