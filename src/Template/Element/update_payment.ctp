
<div class="modal fade" id="update_payment" tabindex="-1" role="dialog" aria-labelledby="update_paymentLabel" aria-hidden="true">
    <div class="modal-dialog size-medium" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Atualizar conta a pagar</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_update_payment">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>" id="business_id">
                    <input type='hidden' name="payment_id" value="" id="input_update_payment_id">

                    <div class="row margin-t-0">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                    
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pagamento realizado?</p>
                            <select type="text" class="form-control required" name="payment_status" style="font-size: 14px; background-color: #fff;" id="input_update_payment_status">
                                <option value="0">Pendente</option>
                                <option value="1">Pago</option>
                            </select>   
                        </div>
                    </div>

                    <div class="row margin-t-20">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">T??tulo</p>
                            <input type="text" class="form-control accountant required" name="payment_title" style="font-size: 14px; background-color: #fff;" id="input_update_payment_title">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Valor</p>
                            <input type="text" class="form-control required money2" name="payment_value" style="font-size: 14px; background-color: #fff;" id="input_update_payment_value">
                            
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Juros</p>
                            <input type="text" class="form-control accountant required" name="payment_fees" style="font-size: 14px; background-color: #fff;" id="input_update_payment_fees">

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Multa</p>
                            <input type="text" class="form-control required money2" name="payment_fine" style="font-size: 14px; background-color: #fff;" id="input_update_payment_fine">
                            

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de Pagamento</p>
                            <select type="text" class="form-control required" name="payment_type" style="font-size: 14px; background-color: #fff;" id="input_update_payment_type">
                                <option value="customer">Cliente</option>
                                <option value="provider">Fornecedor</option>
                                <option value="employee">Funcion??rio</option>
                                <option value="partner">S??cio</option>
                            </select>

                            <p class="text margin-t-20" id="text_update_payment_type" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cliente</p>
                    
                            <select type="text" class="form-control required" name="payment_customer" style="font-size: 14px; background-color: #fff;" id="select_update_payment_customer">
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

                            <select type="text" class="form-control required" name="payment_provider" style="font-size: 14px; background-color: #fff; display: none;" id="select_update_payment_provider">
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

                            <select type="text" class="form-control required" name="payment_employee" style="font-size: 14px; background-color: #fff; display: none;" id="select_update_payment_employee">
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

                            <select type="text" class="form-control required" name="payment_partner" style="font-size: 14px; background-color: #fff; display: none;" id="select_update_payment_partner">
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

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta banc??ria</p>
                            
                            <select type="text" class="form-control required" name="payment_account" style="font-size: 14px; background-color: #fff;" id="input_update_payment_account">
                                <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>
                                    <option value="<?php echo $account->id; ?>"><?php echo $account->bank; ?></option>
                                <?php } ?>
                            </select>

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Categoria</p>
                            
                            <select type="text" class="form-control required" name="payment_category_id" style="font-size: 14px; background-color: #fff;" id="input_update_payment_category">
                                <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                                    <?php if($category->type == "payment"){ ?>
                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>

                                <?php } ?>
                            </select>

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data de vencimento</p>

                            <div class="input-date">
                                <div class="icon ion-android-calendar arrow"></div>

                                <input type="text" class="form-control accountant add-date" name="payment_maturity"
                                value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="input_update_payment_maturity">

                                <!-- Datepicker -->
                                <div class="box-datepicker accountant">
                                    <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#input_update_payment_maturity"></div>
                                </div>

                            </div>

                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pagamento recorrente?</p>
                            <select type="text" class="form-control required" name="payment_recurrent" style="font-size: 14px; background-color: #fff;" id="input_update_payment_recurrent">
                                <option value="0" selected>N??o</option>
                                <option value="1">Sim</option>
                            </select>                     
                            
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Parcelar pagamento?</p>
                            <select type="text" class="form-control required" name="payment_division" style="font-size: 14px; background-color: #fff;" id="input_update_payment_division">
                                <option value="1" selected>?? vista</option>
                                <option value="2">2x</option>
                                <option value="3">3x</option>
                                <option value="4">4x</option>
                                <option value="5">5x</option>
                                <option value="6">6x</option>
                                <option value="7">7x</option>
                                <option value="8">8x</option>
                                <option value="9">9x</option>
                                <option value="10">10x</option>
                                <option value="11">11x</option>
                                <option value="12">12x</option>
                            </select>

                            <div class="btn btn-line-gray size-lg margin-t-50 margin-l-10 btn_send_form"
                                data-url="/api/web/custom/payments/update" data-form="#form_update_payment" data-redirect="none">
                                    ATUALIZAR
                            </div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll margin-t-30">

                            <h4 style="font-weight: 500; color: #333;">Arquivos</h4>

                            <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_file">
                                <i class="material-icons-outlined" style="top: 18px; left: 20px;">add</i>
                                <span class="date"></span>
                                <span class="title" style="color: #999;">Adicionar arquivo</span>
                            </div>

                            <div class="clear"></div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll margin-t-30">

                            <h4 style="font-weight: 500; color: #333;">Anota????es</h4>

                            <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_note">
                                <i class="material-icons-outlined" style="top: 18px; left: 20px;">add</i>
                                <span class="date"></span>
                                <span class="title" style="color: #999;">Adicionar anota????o</span>
                            </div>

                            <div class="clear"></div>

                            <br><br>

                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
