
<div class="modal fade" id="add_task_accountant" tabindex="-1" role="dialog" aria-labelledby="add_task_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Adicionar nova obrigação</h4>
            </div>
            <div class="modal-body">

                <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                ?>

                <form id="form_add_task_accountant">

                    <input type='hidden' name="business_id" value="<?= $business_id; ?>">
                    <input type='hidden' name="group_id" value="<?= $business_id; ?>" id="input-accountant-group-id">
                    <input type='hidden' name="group_type" value="<?= $business_id; ?>" id="input-accountant-group-type">

                    <p class="text" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Título</p>
                    <input type="text" class="form-control accountant required" name="title" style="font-size: 14px; background-color: #fff;">

                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Descrição</p>
                    <input type="text" class="form-control accountant required" name="description" style="font-size: 14px; background-color: #fff;">
                    
                    <!-- TYPE GROUP NONE -->
                    <div id="input-group-type-none" style="display: none;">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data de entrega</p>

                        <div class="input-date" id="input-group-type-none">
                            <div class="icon ion-android-calendar arrow"></div>

                            <input type="text" class="form-control accountant add-date" name="maturity"
                            value="<?= $date; ?>" placeholder="" style="cursor: pointer;" id="task-maturity">

                            <!-- Datepicker -->
                            <div class="box-datepicker accountant">
                                <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#task-maturity"></div>
                            </div>

                        </div>
                    </div>

                    <!-- TYPE GROUP WEEK -->
                    <div id="input-group-type-week" style="display: none;">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Dia da semana</p>
                        <select class="form-control accountant required" name="week" style="font-size: 14px; background-color: #fff;">   
                            <option value="1">Segunda-feira</option>
                            <option value="2">Terça-feira</option>
                            <option value="3">Quarta-feira</option>
                            <option value="4">Quinta-feira</option>
                            <option value="5">Sexta-feira</option>
                        </select>
                    </div>

                    <!-- TYPE GROUP MONTH -->
                    <div id="input-group-type-month" style="display: none;">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Dia</p>
                        <select class="form-control accountant required" name="day" style="font-size: 14px; background-color: #fff;">   
                            
                            <?php 
                                for($options = 1; $options < 32; $options++){
                                    echo '<option value="'.$options.'">Dia '.$options.'</option>';
                                }
                            ?>

                        </select>
                    </div>

                    <!-- TYPE GROUP MONTH -->
                    <div id="input-group-type-yearly" style="display: none;">
                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Mês</p>
                        <select class="form-control accountant required" name="yearly_month" style="font-size: 14px; background-color: #fff;">   
                            
                            <?php 
                                for($options = 1; $options < 13; $options++){

                                    if($options == 1){ $month_text = "Janeiro"; }
                                    if($options == 2){ $month_text = "Fevereiro"; }
                                    if($options == 3){ $month_text = "Março"; }
                                    if($options == 4){ $month_text = "Abril"; }
                                    if($options == 5){ $month_text = "Maio"; }
                                    if($options == 6){ $month_text = "Junho"; }
                                    if($options == 7){ $month_text = "Julho"; }
                                    if($options == 8){ $month_text = "Agosto"; }
                                    if($options == 9){ $month_text = "Setembro"; }
                                    if($options == 10){ $month_text = "Outubro"; }
                                    if($options == 11){ $month_text = "Novembro"; }
                                    if($options == 12){ $month_text = "Dezembro"; }

                                    echo '<option value="'.$options.'">'.$month_text.'</option>';
                                }
                            ?>

                        </select>

                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Dia</p>
                        <select class="form-control accountant required" name="yearly_day" style="font-size: 14px; background-color: #fff;">   
                            
                            <?php 
                                for($options = 1; $options < 32; $options++){
                                    echo '<option value="'.$options.'">Dia '.$options.'</option>';
                                }
                            ?>

                        </select>
                    </div>

                    <div class="text-center">
                        <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                data-url="/api/web/accountant/tasks/add" data-form="#form_add_task_accountant" data-redirect="none">
                                ADICIONAR
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
