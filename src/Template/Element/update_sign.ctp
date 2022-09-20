
<?php

if($service_action == "abertura"){ $text_type = "Abertura de empresa"; $value_type = "GRÁTIS *"; $color_menu = "#00c221"; }
if($service_action == "migracao"){ $text_type = "Migração de empresa"; $value_type = ""; $color_menu = "#00c221"; }

// Services
foreach ($all_services as $service) {
    $service_name = $service->name;
    $service_price = $service->price;

    // Taxation
    if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
    if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }
    if($service->taxation == "real"){ $service_taxation = "Lucro Real"; }

    // Cycle
    if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
    if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
}


// Business
$business_socios = 1;
$business_funcionarios = 0;
$business_faturamento = 0;
$business_pessoal = 0;
$business_extra = 0;

foreach ($all_business as $business) {
    $business_socios = $business->socios;
    $business_funcionarios = $business->funcionarios;
    $business_faturamento = $business->faturamento;
}

$total_month = $service_price;
$business_pessoal = $business_socios + $business_funcionarios;

if($business_pessoal > 5){
    $total_month += ($business_pessoal - 5) * 60.00;
    $business_extra = ($business_pessoal - 5);
}

// if($business_socios > 1){
//     $total_month += ($business_socios - 1) * 60.00;
// }

// if($business_funcionarios > 6){
//     $total_month += ($business_funcionarios - 6) * 60.00;
// }

if($business_faturamento > 1){
    $total_month += ($business_faturamento - 1) * 200;
}


?>


<div class="modal fade" id="updateSign" tabindex="-1" role="dialog" aria-labelledby="updateSignLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
            </div>
            <div class="modal-body text-left" style="border-top: none;">

                <h3 style="font-weight: 500; color: #666;">Assinar contrato</h3>
                <br>
                <p class="text" style="font-size: 14px; color: #999;">
                
                    <?php echo $text_type; ?>

                    <!-- <br>-->
                    <!-- <strong style="font-size: 20px;color: #333;"> GRÁTIS</strong> -->
                    <br><br>

                    Mensalidade
                    <br>

                    <strong style="    color: #333;    font-size: 16px;"><?php echo $service_name; ?> - <?php echo $service_taxation; ?></strong>

                    <br>

                    <strong style="    color: #37e04c;    font-size: 24px;">R$ <?php echo number_format($total_month, 2, ',', '.'); ?></strong>

                    <br><br>

                    <?php if($service_action == 'abertura'){ ?>
                        É necessário o pagamento da adesão para iniciar o processo, esta adesão é referente a mensalidade do primeiro 
                        mês que for realizar a contabilidade da nova empresa, que corresponde ao mês de emissão do CNPJ.
                    <?php } ?>

                    <?php if($service_action == 'migracao'){ ?>
                        É necessário o pagamento da adesão para iniciar o processo, esta adesão é referente a mensalidade do primeiro 
                        mês de realização da contabilidade da empresa.
                    <?php } ?>

                    <br><br>
                    Clique no botão abaixo para efetuar o pagamento:

                </p>

                <div class="text-center">
                    <div class="btn btn-green size-lg margin-t-30 btn_send_form"
                        data-url="/api/web/business/update-sign" data-form="#form_step_4" data-redirect="/contratar/etapa-4">
                        ASSINAR CONTRATO</div>
                </div>

            </div>
        </div>
    </div>
</div>
