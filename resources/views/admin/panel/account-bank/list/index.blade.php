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
      <h3 class="box-title">Clientes Itens</h3>
    </div>
    <form method="POST" class="rtw-form" id="form">
   
    @if ($accounts->count() > 0)
    <!-- /.box-header -->
    <div class="box-body" >
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
                         
            @foreach ($accounts as $value) 
             
              
            <tr> 
              <td>{{ $value->id }}</td> 
              <td class="ref">{{ $value->ref }}</td>  
              <td class="account_type" data-type="{{ $value->type }}">{{ $value->type }}</td>
              <td data-full_name="{{ $value->full_name }}">{{ $value->full_name }}</td>
              <td class="cpf_number" data-cpf="{{ $value->cpf }}">{{ $value->cpf }}</td>
              <td class="agency">{{ $value->agency }}</td>
              <td class="account_number">{{ $value->account_number }}</td>
             
              <td id="subActions">
                <a href="/admin/ver?id={{ $value->id }}" class="client btn-sm btn btn-primary"><i class="fa fa-fw fa-eye "></i></a>
                <!-- <a href=" BASE; " class=" m-2">Ver</a>  -->  
                <button id="input1" value="{{ $value->id }}" type="button" class="client btn-sm btn btn-warning"  data-toggle="modal" data-target="#modal-warning" data-edit="{{ $value->id }}">
                <i class="fa fa-cog "></i>
                </button>
                <button id="input2" value="{{ $value->id }}" type="button" class="client btn-sm btn btn-danger" data-toggle="modal" data-target="#modal-danger" data-delete="{{ $value->id }}">
                <i class="fa fa-close "></i>
                </button>
              </td>     
            </tr>
            @endforeach
            </tbody>
            
        </table>
    </div>
    <!-- /.box-body -->
   
    @else
              
    <div class="box-body">
      <div class="box-title">  
        <h3>Nenhum produto cadastrado!</h3>
      </div>
    </div>
    @endif
    


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
    
