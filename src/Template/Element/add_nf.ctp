
<div class="modal fade" id="add_nf" tabindex="-1" role="dialog" aria-labelledby="add_nfLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar Nota fiscal</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_nf">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">

                    <div class="row margin-t-20">
                        
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de Nota</p>
                            <select type="text" class="form-control required" name="nf_type" style="font-size: 14px; background-color: #fff;" id="input_nf_type">
                                <option value="nfs-e">NFS-e</option>
                                <option value="nf-e">NF-e</option>
                                <option value="nfc-e">NFC-e</option>
                            </select>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll" id="area-nf-servicos">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Serviço</p>
                            <select type="text" class="form-control" name="nf_service" style="font-size: 14px; background-color: #fff;" id="input_nf_service">
                                <option value="nfs-e">1702 - DATILOGRAFIA, DIGITAÇÃO, ESTENOGRAFIA, EXPEDIENTE, SECRETARIA EM GERAL, RESPOSTA AUDIVEL</option>
                            </select>
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll" id="area-nf-produtos" style="display: none;">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Produtos</p>
                            
                            <div class="row margin-t-20">
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 animate-scroll">
                                    <select type="text" class="form-control" name="nf_service" style="font-size: 14px; background-color: #fff;" id="input_nf_produto">
                                        <option value="1">Camiseta Azul</option>
                                        <option value="2">Camiseta Verde</option>
                                        <option value="3">Camiseta Branca</option>
                                    </select>
                                </div>
                                
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                                    <input type="number" class="form-control" name="nf_" style="font-size: 14px; background-color: #fff;">   
                                </div>
                            </div>
                            
                            <div class="row margin-t-20">
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 animate-scroll">
                                    <select type="text" class="form-control" name="nf_service" style="font-size: 14px; background-color: #fff;" id="input_nf_produto">
                                        <option value="1">Camiseta Azul</option>
                                        <option value="2">Camiseta Verde</option>
                                        <option value="3">Camiseta Branca</option>
                                    </select>
                                </div>
                                
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                                    <input type="number" class="form-control" name="nf_" style="font-size: 14px; background-color: #fff;">   
                                </div>
                            </div>
                            
                            <div class="row margin-t-20">
                                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 animate-scroll">
                                    <select type="text" class="form-control" name="nf_service" style="font-size: 14px; background-color: #fff;" id="input_nf_produto">
                                        <option value="1">Camiseta Azul</option>
                                        <option value="2">Camiseta Verde</option>
                                        <option value="3">Camiseta Branca</option>
                                    </select>
                                </div>
                                
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                                    <input type="number" class="form-control" name="nf_" style="font-size: 14px; background-color: #fff;">   
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                        </div>
                        
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                            <textarea class="form-control accountant required" name="nf_description" rows="5" style="font-size: 14px; background-color: #fff; min-height: 100px;"></textarea>
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Dedução</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descontos</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">PIS</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">INSS</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cofins</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CSLL</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">IRPJ</p>
                            <input type="text" class="form-control required money2" name="nf_" style="font-size: 14px; background-color: #fff;">  
                            
                        </div>
                        
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">


                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Prestador</p>
                            <select type="text" class="form-control required" name="nf_client_type" style="font-size: 14px; background-color: #fff;" id="input_nf_client_type">
                                <option value="customer">Cliente</option>
                                <option value="provider">Fornecedor</option>
                                <option value="employee">Funcionário</option>
                                <option value="partner">Sócio</option>
                                <option value="none">Outro</option>
                            </select>

                            <p class="text margin-t-20" id="text_nf_type" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                    
                            <select type="text" class="form-control required" name="nf_customer" style="font-size: 14px; background-color: #fff;" id="select_nf_customer">
                                <?php $x=0; foreach ($query_customers as $customer) { $x++; ?>
                                    <option value="<?php echo $customer->id; ?>">
                                    
                                    <?php
                                    
                                        if($customer->type == 'pj'){
                                            echo $customer->pj_razao;
                                        }else{
                                            echo $customer->pf_name;
                                        }
                                    
                                    ?>

                                    </option>
                                <?php } ?>
                            </select>

                            <select type="text" class="form-control required" name="nf_provider" style="font-size: 14px; background-color: #fff; display: none;" id="select_nf_provider">
                                <?php $x=0; foreach ($query_providers as $provider) { $x++; ?>
                                    <option value="<?php echo $provider->id; ?>">
                                    
                                    <?php
                                    
                                        if($provider->type == 'pj'){
                                            echo $provider->pj_razao;
                                        }else{
                                            echo $provider->pf_name;
                                        }
                                    
                                    ?>
                                    
                                    </option>
                                <?php } ?>
                            </select>

                            <select type="text" class="form-control required" name="nf_employee" style="font-size: 14px; background-color: #fff; display: none;" id="select_nf_employee">
                                <?php $x=0; foreach ($query_employees as $employee) { $x++; ?>
                                    <option value="<?php echo $employee->id; ?>">
                                    
                                    <?php
                                    
                                        if($employee->type == 'pj'){
                                            echo $employee->pj_razao;
                                        }else{
                                            echo $employee->pf_name;
                                        }
                                    
                                    ?>
                                    
                                    </option>
                                <?php } ?>
                            </select>

                            <select type="text" class="form-control required" name="nf_partner" style="font-size: 14px; background-color: #fff; display: none;" id="select_nf_partner">
                                <?php $x=0; foreach ($query_partners as $partner) { $x++; ?>
                                    <option value="<?php echo $partner->id; ?>">
                                    
                                    <?php
                                    
                                        if($partner->type == 'pj'){
                                            echo $partner->pj_razao;
                                        }else{
                                            echo $partner->pf_name;
                                        }
                                    
                                    ?>
                                    
                                    </option>
                                <?php } ?>
                            </select>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor</p>
                            <input type="text" class="form-control required money2" name="nf_value" style="font-size: 14px; background-color: #fff;">                            

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data de vencimento</p>

                            <div class="input-date">
                                <div class="icon ion-android-calendar arrow"></div>

                                <input type="text" class="form-control accountant add-date" name="nf_maturity"
                                value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="input_nf_maturity">

                                <!-- Datepicker -->
                                <div class="box-datepicker accountant">
                                    <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#input_nf_maturity"></div>
                                </div>

                            </div>
                            
                            <div class="text-right">
                                <div class="btn btn-yellow size-lg margin-t-30 margin-b-10 btn_send_form"
                                    data-url="/api/web/custom/nf/add" data-form="#form_add_nf" data-redirect="none">
                                        EMITIR NOTA FISCAL
                                </div>
                            </div>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
