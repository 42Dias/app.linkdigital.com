
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

<div class="box-right-steps">

    <input type="hidden" id="service-price" value="<?php echo $service_price; ?>">
    <input type="hidden" id="total-month" value="<?php echo $total_month; ?>">

    <span style="font-size: 18px; color: #9c9c9c; ">
        Detalhes do pedido
    </span>

    <div style="margin-top: 40px;">
        <span style="font-size: 14px; color: #666; font-weight: 600;">
            <?php echo $text_type; ?>
        </span>
    </div>

    <div style="margin-top: 0px;">
        <strong style="font-size: 12px; color: #00c221; line-height: 24px;">
            <?php 
                echo $value_type; 
                if($value_type !== ""){
            ?>
                    <!-- <br> -->
                    Pague somente as taxas do Governo.
                    
            <?php } ?>
        </strong>
    </div>

    <!-- Linha -->
    <hr>

    <div style="margin-top: 20px;">
        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
            <?php echo $service_taxation; ?>
        </strong>
    </div>

    <?php if($service_taxation == "Lucro Real"){ ?>

        <div style="margin-top: 0px;">
            <span style="font-size: 14px; color: #666; font-weight: 600;">
                Consultar o valor
            </span>
        </div>

    <?php }else{ ?>

        <div style="margin-top: 0px;">
            <span style="font-size: 14px; color: #666; font-weight: 600;">
                <?php echo $service_name; ?>
            </span>
        </div>

        <!-- <div style="margin-top: 0px;">
            <strong style="font-size: 12px; color: <?php echo $color_menu; ?>; line-height: 24px;">
                R$ <?php echo number_format($service_price, 2, ',', '.'); ?> / <?php echo $service_cycle; ?>
            </strong>
        </div> -->

    <?php } ?>
    <!-- Linha -->

    <?php
        if($business_pessoal > 1){
            $visible_box_extra = 'block';
        }else{
            $visible_box_extra = 'none';
        }
    ?>

    <div id="box-extra" style="display: <?php echo $visible_box_extra; ?>;">
        <hr>

        <div style="margin-top: 20px;">
            <span style="font-size: 14px; color: #666; font-weight: 600;" id="sidebar-text-extra">

                <?php
                    if($business_extra > 1){
                        echo $business_extra." Adicionais";
                    }else{
                        echo "1 adicional";
                    }
                ?>

            </span>
        </div>

        <div style="margin-top: 0px;">
            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" id="sidebar-price-extra">

                <?php
                    $price_extra = ($business_pessoal - 5) * 60.00;

                    if($business_pessoal > 1){
                        echo "+ R$ ".number_format($price_extra, 2, ',', '.')." / Mensal";
                    }else{
                        echo "GRÁTIS";
                    }
                ?>

            </strong>
        </div>
    </div>

    <!-- <?php
        if($business_socios > 1){
            $visible_box_socios = 'block';
        }else{
            $visible_box_socios = 'none';
        }
    ?>

    <div id="box-socios" style="display: <?php echo $visible_box_socios; ?>;">
        <hr>

        <div style="margin-top: 20px;">
            <span style="font-size: 14px; color: #666; font-weight: 600;" id="sidebar-text-socios">

                <?php
                    if($business_socios > 1){
                        echo $business_socios." Sócios";
                    }else{
                        echo "1 sócio";
                    }
                ?>

            </span>
        </div>

        <div style="margin-top: 0px;">
            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" id="sidebar-price-socios">

                <?php
                    $price_socios = ($business_socios - 1) * 60.00;

                    if($business_socios > 1){
                        echo "+ R$ ".number_format($price_socios, 2, ',', '.')." / Mensal";
                    }else{
                        echo "GRÁTIS";
                    }
                ?>

            </strong>
        </div>
    </div> -->


    <!-- Linha -->
    <?php
        if($business_funcionarios > 6){
            $visible_box_funcionarios = 'block';
        }else{
            $visible_box_funcionarios = 'none';
        }
    ?>

    <!-- <div id="box-funcionarios" style="display: <?php echo $visible_box_funcionarios; ?>;">
        <hr>

        <div style="margin-top: 20px;">
            <span style="font-size: 14px; color: #666; font-weight: 600;" id="sidebar-text-funcionarios">

                <?php
                    if($business_funcionarios > 0){
                        echo $business_funcionarios." Funcionários";
                    }else{
                        echo "Nenhum funcionário";
                    }
                ?>

            </span>
        </div>

        <div style="margin-top: 0px;">
            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" id="sidebar-price-funcionarios">

                <?php
                    $price_funcionarios = ($business_funcionarios - 6) * 60.00;

                    if($business_funcionarios > 6){
                        echo "+ R$ ".number_format($price_funcionarios, 2, ',', '.')." / Mensal";
                    }else{
                        echo "GRÁTIS";
                    }
                ?>

            </strong>
        </div>
    </div> -->

    <?php
        if($business_faturamento > 1){
            $visible_box_faturamento = 'block';
        }else{
            $visible_box_faturamento = 'none';
        }
    ?>

    <div id="box-faturamento" style="display: <?php echo $visible_box_faturamento; ?>;">
        <hr>

        <div style="margin-top: 20px;">

            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" id="sidebar-text-faturamento-title"></strong>
            <br>
            <span style="font-size: 14px; color: #666; font-weight: 600;" id="sidebar-text-faturamento">
                <?php
                    if($business_faturamento > 1){

                        $begin = 15000.01;
                        $end = 30000.00;

                        for ($i=2; $i < 50; $i++) {

                            if($business_faturamento == $i){
                                echo 'R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.');
                            }

                            if($i == 1){
                                $begin = $begin + 0.01;
                            }

                            $begin = $end;
                            $end = $begin + 30000;
                            // $begin = $begin + 25000;
                            // $end = $end + 25000;
                        }

                    }else{
                        echo "R$ 0,00 a R$ 15.000,00";
                    }
                ?>

            </span>
        </div>

        <!-- <div style="margin-top: 0px;">
            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" id="sidebar-price-faturamento">

                <?php
                    $price_faturamento = ($business_faturamento - 1) * 200;

                    if($business_faturamento > 0){
                        echo "+ R$ ".number_format($price_faturamento, 2, ',', '.')." / Mensal";
                    }else{
                        echo "GRÁTIS";
                    }
                ?>

            </strong>
        </div> -->
    </div>

    <!-- Linha -->
    <hr>

    <div style="margin-top: 20px;">
        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
            VALOR DA MENSALIDADE
        </strong>
    </div>

    <?php if($service_taxation == "Lucro Real"){ ?>

        <div style="margin-top: 0px;">
            <span style="font-size: 22px; color: #333; font-weight: 600;">
                Consultar o valor
            </span>
        </div>
      
    <?php }else{ ?> 
        
        <div style="margin-top: 0px;">
            <span style="font-size: 22px; color: #333; font-weight: 600;" id="sidebar-total-month">
                R$ <?php echo number_format($total_month, 2, ',', '.'); ?>
            </span>
        </div>

    <?php } ?> 

</div>
