@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content')
    <div class="box">
    	<div class="box-header">
    		<h3 class="box-title">Cadastrar Débito</h3>
    	</div>
    	<div class="box-body"> 
    	    <form method="POST" action="{{ route('debit.store') }}">  	
    	        {!! csrf_field() !!}					
    			<div class="form-group">
				    <label for="clientId">Cliente</label>
				    <select name="clientId" id="clientId" class="form-control select2">
				        <option value="1">Fulano - fulano@hotmail.com</option>
				    </select>
				</div>

				<div class="form-group">
				    <label for="description">Descricao</label>
				    <input name="description" id="description" class="form-control select2" placeholder="Nome do Debito">
				       
				</div>

				<div class="row">
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="pag_method">Forma de pagamento</label>
                            <select class="form-control select2" name="pag_method" id="pag_method">
                                <option value="0">Escolha...</option>
                                <option value="1">Cartao</option>
                                <option value="2">À vista</option>
                                <option value="3">A prazo</option>
                            </select>
                        </div>
                    </div> 
                    <div class="col-xs-4">
                        <!-- Date -->
                        <div class="form-group">
                            <label>Data:</label>

                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="date" name="date" class="form-control pull-right" id="datepicker">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div> 
                    <div class="col-xs-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control select2" name="status" id="status">
                                <option value="0">Escolha...</option>
                                <option value="1">Pago</option>
                                <option value="3">Não pago</option>
                                <option value="2">Pendente</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                
                <div class="col-xs-6 m-0">
                    <div class="form-group">
                        <label for="value">Valor</label>
                        <div class="input-group">
                            
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" name="value" class="form-control">
                            <span class="input-group-addon">,00</span>
                        </div>
                    </div>
                </div>
                <?php if(!empty($total)): ?>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label for="total">Total de debitos</label>
                        <input value="<?=  number_format($total['value'], 2, ',', '.'); ?>" class="form-control p-2"  id="total"  disabled>
                    </div>
                </div> 
                <?php endif; ?>
                </div>      

                        

                <button type="submit" class="btn-block btn btn-primary">Cadastrar</button>
			</form>
    		
    	</div>
    </div>
@stop


