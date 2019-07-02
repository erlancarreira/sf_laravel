@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
<div class="row" style="display: none;">
  <div class="col-xs-12">
    <div class="alert " role="alert" id="msg">     
        <button type="button" class="fa close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>  
    </div>
  </div>
</div>
<div class="box box-info">
    <div class="box-header">
      <h3 class="box-title">Contas</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">
   
    <!-- /.box-header -->
    <div class="box-body" >
      @forelse ($accounts as $account) 
        <table id="tableData" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>REF</th>
              <th>TIPO</th>
              <th>TITULAR</th>
              <th>CPF</th>
              <th>AGENCIA</th>
              <th>CONTA</th>
              <th>ACOES</th>
            </tr>
            </thead>

            <tbody>
                         
            
            <!-- !! dd($account) !!}  -->
              
            <tr> 
              <td>{{ $account->id }}</td> 
              <td class="ref">{{ $account->ref }}</td>  
              <td class="account_type" data-type="{{ $account->type }}">{{ $account->type }}</td>
              <td data-full_name="{{ $account->full_name }}">{{ $account->full_name }}</td>
              <td class="cpf_number" data-cpf="{{ $account->cpf }}">{{ $account->cpf }}</td>
              <td class="agency">{{ $account->agency }}</td>
              <td class="account_number">{{ $account->account_number }}</td>
             
              <td id="subActions">
                <a href="{{ route('account-bank.edit', ['id' => $account->id]) }}" class="client btn-sm btn btn-warning fa fa-cog"  data-edit="{{ $account->id }}"></a>
                <a href="{{ route('account-bank.delete', ['id' => $account->id]) }}" class="client btn-sm btn btn-danger fa fa-trash" data-delete="{{ $account->id }}"></a>
              </td>     
            </tr>
            
            </tbody>
           
            
        </table>

        @empty
        <div class="box-title">  
          <h5>Nenhum conta cadastrada!</h5>
        </div>
        @endforelse
    </div>
    <!-- /.box-body -->
    </form>
</div>
@stop

@section('js')
 
 
  <script type="text/javascript">
    
    var account_type = document.querySelectorAll('.account_type')
    var ref = document.querySelectorAll('.ref')
    var data = document.querySelectorAll('.cpf_number, .agency, .account_number') 

    function formataCPF(cpf) {
      //retira os caracteres indesejados...
      cpf = cpf.replace(/[^\d]/g, "");
      
      //realizar a formatação...
      return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    }

    function formatNumbers(value) {
      value = value.replace(/[^\d]/g, "")
      
      if (value.length != undefined) { 
        
        if (value.length == 11) {
        
          value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4") //CPF
        
        } else if (value.length == 5) {
        
          value = value.replace(/(\d{4})(\d{1})/, "$1-$2") // AGENCY
       
        } else if (value.length == 6) {
        
          value = value.replace(/(\d{2})(\d{3})(\d{1})/, "$1.$2-$3") // ACCOUNT
        }
      }  
      return value
    }
     
    Array.from(data).forEach( (e) => {
      e.innerHTML = formatNumbers(e.innerHTML)
    })

    function setStatusMethod(value) {
      
      value.forEach( (e) => { 
        //console.log(e)
        switch (e.textContent) {
          case '0':
            e.textContent =  'Conta-Poupanca'  
            break

          case '1':
            e.textContent =  'Conta-Corrente'   
            break       
        }
      })  
    }  

    setStatusMethod(account_type)
    
    $(document).ready( function(){
      
      function setBank(bank) {   
        ref.forEach( (e)=> {
          if (parseInt(bank.value) == $(e).text()) {
            $(e).text(bank.label)
          }
        }) 
      }

      $.get('../listaBancos.json', function (data) {
            
        $(data).each( (i, item) => {
          setBank(item)
        })

      })
             
          
          

    })

    

  </script>
@stop
<!-- /.box -->
    
