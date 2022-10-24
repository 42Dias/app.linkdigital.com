
<?php

    echo $this->element('add_payment');
    echo $this->element('update_payment');
    $test = '';
    $month_format_date['01'] = "Janeiro";
    $month_format_date['02'] = "Fevereiro";
    $month_format_date['03'] = "Março";
    $month_format_date['04'] = "Abril";
    $month_format_date['05'] = "Maio";
    $month_format_date['06'] = "Junho";
    $month_format_date['07'] = "Julho";
    $month_format_date['08'] = "Agosto";
    $month_format_date['09'] = "Setembro";
    $month_format_date['10'] = "Outubro";
    $month_format_date['11'] = "Novembro";
    $month_format_date['12'] = "Dezembro";

    $tab_select = "";

    if(isset($_GET["tab_select"])){
        $tab_select = $_GET["tab_select"];
    }

?>

<!-- Menu Page -->
<div class="menu-page">

    <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            <span class="title-page">Pagamentos</span>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="btn btn-line-gray size-sm btn_send_form" style="display: block; float: right; margin-left: 0px; padding: 15px 25px;"
                    data-url="" data-form="" data-redirect="none">
                    FILTRAR
            </div>

            <select type="text" class="form-control margin-r-10" name="report_type"  style=" float: right; font-size: 12px; background-color: #fff; width: auto; display: inline-block; height: 45px !important;">
                <option value="/client/finances/reports/dre-anual-horizontal">Hoje</option>    
                <option value="/client/finances/reports/dre-anual-horizontal">Últimos 3 dias</option>
                <option value="/client/finances/reports/dre-anual-horizontal">Últimos 7 dias</option>
                <option value="/client/finances/reports/dre-anual-horizontal">Últimos 15 dias</option>
                <option value="/client/finances/reports/dre-anual-horizontal">Últimos 30 dias</option>
            </select>

            <?php

                $date = date_format($date_now, 'd/m/Y');
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

            ?>

            <div class="input-date1" style='width: 150px; float: right; margin-right: 10px;'>
                <div class="icon ion-android-calendar arrow"></div>

                <input type="text" class="form-control add-date" name="date_end"
                value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-end">

                <!-- Datepicker -->
                <div class="box-datepicker1 client" style="top: 0px !important; left: -130px !important;">
                    <div class="datepicker1" data-date="<?= h($date_input); ?>" data-id="#date-report-end"></div>
                </div>

            </div>

            <?php

                $date = '01/01/2021';
                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

            ?>

            <div class="input-date" style='width: 150px; float: right; margin-right: 10px;'>
                <div class="icon ion-android-calendar arrow"></div>

                <input type="text" class="form-control add-date" name="date_begin"
                value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-begin">

                <!-- Datepicker -->
                <div class="box-datepicker client" style="top: 0px !important; left: -130px !important;">
                    <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#date-report-begin"></div>
                </div>

            </div>
            

            <div class="clear"></div>

        </div>
    </div>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 13 -->
            <div class="box-tab-content active margin-t-40" >

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <div class="box-tabs" style="margin-top: 0px;">
                                <a href="/client/finances/payments?tab_select=open" class="tab-item <?php if($tab_select == '' || $tab_select == 'open'){ echo 'active'; } ?>" data-open="#tab-content-8">A pagar</a>
                                <a href="/client/finances/payments?tab_select=close" class="tab-item <?php if($tab_select == 'close'){ echo 'active'; } ?>" data-open="#tab-content-9">Realizados</a>
                                <div class="clear"></div>
                            </div>

                            <?php //$count_payments=0; foreach ($query_payments as $payment) { $count_payments++; } ?>

                            <!-- <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                                <?php //echo $count_payments; ?> pagamentos encontradas
                            </p> -->

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                            <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_payment">
                                    NOVO PAGAMENTO
                            </div>
                        </div>
                    </div>

                    <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Categoria</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Vencimento</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Status</p>
                        </div>
                    </div>

                    <?php $x=0; foreach ($query_payments as $payment) { $x++; ?>

                        <?php 

                            if($tab_select == '' || $tab_select == 'open'){ $status_select = 0; } 
                            if($tab_select == 'close'){ $status_select = 1; } 

                            if($status_select == $payment->status){ 

                                $date = date_format($payment->maturity, 'd/m/Y');
                                $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

                        ?>

                            <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;"><?php echo strval($payment->title); ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;">
                                        <?php 
                                        
                                            if($payment->type == "customer"){
                                                foreach ($query_customers as $customer){
                                                    if($customer->id == $payment->type_id){ 
                                                        
                                                        if($customer->type == 'pj'){
                                                            echo $customer->pj_razao;
                                                        }else{
                                                            echo $customer->pf_name;
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            if($payment->type == "provider"){
                                                foreach ($query_providers as $provider){
                                                    if($provider->id == $payment->type_id){
                                                    
                                                        if($provider->type == 'pj'){
                                                            echo $provider->pj_razao;
                                                        }else{
                                                            echo $provider->pf_name;
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            if($payment->type == "employee"){
                                                foreach ($query_employees as $employee){
                                                    if($employee->id == $payment->type_id){
                                                    
                                                        if($employee->type == 'pj'){
                                                            echo $employee->pj_razao;
                                                        }else{
                                                            echo $employee->pf_name;
                                                        }
                                                    }
                                                }
                                            }
                                            
                                            if($payment->type == "partner"){
                                                foreach ($query_partners as $partner){
                                                    if($partner->id == $payment->type_id){
                                                    
                                                        if($partner->type == 'pj'){
                                                            echo $partner->pj_razao;
                                                        }else{
                                                            echo $partner->pf_name;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                    </strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;">
                                        <?php foreach ($query_categories as $category) { ?>
                                            <?php if($category->id == $payment->category_id){ echo $category->name; } ?>
                                        <?php } ?>
                                    </strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;"><?php echo date_format($payment->maturity, 'd/m/Y'); ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($payment->value, 2, ',', '.'); ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                    <?php if($status_select == 0){ ?> 

                                        <div class="badge-status relative default">PENDENTE</div>

                                    <?php }else{ ?>

                                        <div class="badge-status relative positive">PAGO</div>

                                    <?php } ?>

                                    <div style="position: absolute; right: 0px; top: 0px;">

                                        <i class="material-icons-outlined btn-open-payment"
                                            style="cursor: pointer;"
                                            data-tool="tooltip"
                                            data-placement="top"
                                            title="Editar"
                                            data-toggle="modal"
                                            data-target="#update_payment" 
                                            data-id="<?= $payment->id; ?>"
                                            data-title="<?= strval($payment->title); ?>"
                                            data-value="<?= $payment->value; ?>"
                                            data-status="<?= $payment->status; ?>"
                                            data-account="<?= $payment->account_id; ?>"
                                            data-category="<?= $payment->category_id; ?>"
                                            data-type="<?= $payment->type; ?>" 
                                            data-division="<?= $payment->division; ?>"
                                            data-maturity="<?= $date; ?>"
                                            data-recurrent="<?= $payment->recurrent; ?>"
                                            data-type_id="<?= $payment->type_id; ?>"
                                            data-annotation="<?= $payment->annotation; ?>"
                                            data-file_url="<?= $payment->file_url; ?>"
                                            data-fees="<?= $payment->fees; ?>"
                                            data-fine="<?= $payment->fine; ?>"
                                            data-receipt_customer="<?= $payment->receipt_customer; ?>"
                                            
                                        >
                                            create
                                        </i>
                                        
                                        <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                            data-url="/api/web/custom/payments/<?php echo $payment->id; ?>/delete" data-form="#form" data-redirect="none"  data-toggle="tooltip" data-placement="top" title="Remover">delete</i>
                                    </div>
                                </div>
                            </div>

                            <hr>

                        <?php } ?>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                            <span class="title" style="font-size: 12px;">Você não possui nenhuma conta a pagar.</span>
                        </div>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
