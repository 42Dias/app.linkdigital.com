<?php
    echo $this->element('agenda');
    echo $this->element('help_package');
    echo $this->element('help_tributacao');

    if($service_action == "abertura"){ $color_menu = "#fff"; }
    if($service_action == "migracao"){ $color_menu = "#fff"; }

    $user_name = "";

    foreach ($all_users as $user) {
        $user_name = $user->name;
        $user_razao = $user_name.' '.$user->lastname;
    }

    foreach ($all_services as $service) {
        $service_id = $service->id;
        $service_name = $service->name;
        $service_price = $service->price;
        $business_plano = $service->plan;

        // Taxation
        if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
        if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }
        if($service->taxation == "real"){ $service_taxation = "Lucro Real"; }

        // Cycle
        if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
        if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
    }

    $business_name = "";
    $business_cnpj = "";
    $business_razao = "";
    $business_fantasia = "";
    $business_faturamento = 0;
    $business_socios = 1;
    $business_funcionarios = 0;
    $business_atividades = "";

    foreach ($all_business as $business) {
        $business_name = $business->fantasia;
        $business_cnpj = $business->cnpj;
        $business_razao = $business->razao;
        $business_fantasia = $business->fantasia;
        $business_faturamento = $business->faturamento;
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;
        $business_atividades = $business->atividades;
    }

?>

<!-- Header -->
<!-- <div style="position: fixed; top: 0px; left: 0px; width: 100%; background-color: <?php echo $color_menu; ?>; z-index: 1;">
    <div class="" style="position: relative; padding: 0px 40px;">

        <a class="animate-scroll" href="/" style="position: absolute; left: 40px; top: 8px;">
            <img src="/img/logo-link-white.png" style="width: 170px;">
        </a>

        <div class="text-right">
            <span style="display: block; color: #fff; padding: 15px 20px; font-size: 18px; font-weight: 700;;">&nbsp;</span>
        </div>

    </div>
</div> -->


<div style="padding-right: 280px; background-color: #fff;">

    <div class="hidden-mobile visible-md visible-lg" style="position: relative; background-color: #efefef; background-image: url(../img/bg-homepage-v6.jpg); background-position: center; background-repeat: no-repeat; background-size: cover; padding: 40px; padding-top: 20px;">

        <a class="animate-scroll" href="/">
            <img src="/img/logo-link-white.png" style="width: 130px;">
        </a>

        <br><br><br>

        <div style="position: absolute; bottom: -12px; left: 220px; width: 20px; height: 20px; background-color: #fff; transform: rotate(45deg);"></div>

        <a href="/contratar/etapa-1" class="link-steps">
            <strong style="font-size: 24px; color: #ffce2c;">1</strong> &nbsp;
            <strong style="font-size: 14px; color: #ffce2c;">Sobre você</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-2" class="link-steps">
            <strong style="font-size: 24px; color: #fff;">2</strong> &nbsp;
            <strong style="font-size: 14px; color: #fff;">Sobre a empresa</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-3" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">3</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Localização</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-4" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">4</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Contrato</strong> &nbsp;&nbsp;&nbsp;
        </a>

        <a href="/contratar/etapa-5" class="link-steps">
            <strong style="font-size: 24px; color: #7d7f8a;">5</strong> &nbsp;
            <strong style="font-size: 14px; color: #7d7f8a;">Pagamento</strong> &nbsp;&nbsp;&nbsp;
        </a>
    </div>

    <!-- Section 1 -->
    <section>

        <div class="" style="padding: 100px 40px; padding-top: 30px; padding-bottom: 40px;">

            <div class="row" style="margin-top: 0px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll" style="padding-top: 50px;">

                    <p style="font-size: 28px; line-height: 38px; color: #666; font-weight: 600;">
                        <span style="font-size: 24px; color: #ffce2c;">Olá <?php echo $user_name; ?>!</span>
                        <br>
                        <?php if($service_name == "Empregado doméstico"){ ?>

                            Fale mais sobre o empregado doméstico

                        <?php }else{ ?>

                            Fale mais sobre a sua empresa

                        <?php } ?>
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 10px;">
                        Preencha os dados abaixo e inicie a contratação da sua contabilidade digital
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 50px;">
                        <strong style="color: #666;">Informações em segurança</strong><br>
                        Suas informações estão 100% seguras, todas as nossas informações são transmitidas por uma conexão segura por senha criptografada.
                    </p>
                </div>
            </div>

            <form id="form_step_2" method="POST" style="padding: 0; margin-top: 30px;">

                <div class="simulation" style="padding: 0; border: none;">
                    <div class="box-simulation" style="padding: 0; border: none;">

                        <div class="row">

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <div class="margin-t-20 margin-b-20">

                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">
                                        Tipo de empresa selecionada
                                    </p>

                                    <br>

                                    <div class="package active" data-type="consultiva" style="color: #333; border: none; background-color: #ffce2c; font-size: 16px;">
                                        <br>
                                        <?php echo $service_name; ?>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <div class="margin-t-20 margin-b-20">

                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;" data-toggle="modal" data-target="#help_package">
                                        Qual plano de serviços você deseja? <span class="icon ion-help-circled" data-toggle="tooltip" data-placement="top" title="Comparação de planos" style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>
                                    </p>

                                    <br>
                                    
                                    <div class="package input-plano <?php if($service_plan == 'consultiva'){ echo "active"; } ?>" data-type="consultiva">
                                        <span class="icon ion-android-star"></span> Contabilidade Consultiva
                                    </div>
                                
                                    <div class="package input-plano <?php if($service_plan == 'digital'){ echo "active"; } ?>" data-type="digital">
                                        <span class="icon ion-android-star-outline"></span> Contabilidade Digital
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    <?php if($service_name == "Empregado doméstico"){

                    
                        if($service_action == "abertura"){ ?>

                            <input type="hidden" class="form-control required" name="name" style="font-size: 14px; background-color: #fff;" value="<?php echo $user_razao; ?>">

                        <?php }else{ ?>
                            
                            <input type="hidden" class="form-control mask-cnpj" name="cnpj" style="font-size: 14px; background-color: #fff;" value="<?php echo $business_cnpj; ?>">
                            <input type="hidden" class="form-control" name="razao" style="font-size: 14px; background-color: #fff;" value="<?php echo $user_name; ?>">
                            <input type="hidden" class="form-control" name="fantasia" style="font-size: 14px; background-color: #fff;" value="<?php echo $business_fantasia; ?>">


                        <?php } ?>

                    <?php }else{

                         if($service_action == "abertura"){ ?>

                            <!-- ABERTURA -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Qual será o nome da sua empresa?</p>
    
                                <input type="text" class="form-control required" name="name" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_name; ?>">
                            </div>
    
                        <?php }else{ ?>
    
                            <!-- MIGRAÇÃO -->
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ da empresa</p>
    
                                <input type="text" class="form-control required mask-cnpj" name="cnpj" style="font-size: 14px; background-color: #fff;" 
                                    id="step-2-cnpj" value="<?php echo $business_cnpj; ?>">
                            </div>
    
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
    
                                <input type="text" class="form-control required" name="razao" style="font-size: 14px; background-color: #fff;"
                                        id="step-2-razao" value="<?php echo $business_razao; ?>">
                            </div>
    
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome fantasia</p>
    
                                <input type="text" class="form-control" name="fantasia" style="font-size: 14px; background-color: #fff;"
                                        id="step-2-fantasia" value="<?php echo $business_fantasia; ?>">
                            </div>
    
                        <?php } ?>
                    <?php } ?>

                </div>

                <?php if($business_cnpj !== "" && $service_action == "migracao"){ echo '<script> searchCnpj(); </script>'; } ?>

                <div class="box-info-cnpj" style="<?php if($business_cnpj == "" || $service_action == "abertura"){ echo 'display: none;'; } ?> padding: 40px; border: 1px solid #ffce2c;border-radius: 10px;background-color: #ffffff;color: #666;margin-top: 50px;">
                    
                    <p style="font-size: 14px; color: #999; font-weight: 400;">
                        <strong style="color: #666;">Atividade principal</strong><br>
                        <span style="margin-bottom: 5px; color: #333; line-height: 26px;" id="step-2-principal"></span>
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 40px;">
                        <strong style="color: #666;">Atividades secundárias</strong><br>
                        <span style="margin-bottom: 5px; color: #333; line-height: 26px;" id="step-2-secundarias"></span>
                    </p>

                    <p style="font-size: 14px; color: #999; font-weight: 400; margin-top: 40px;">
                        <strong style="color: #666;">Sócios</strong><br>
                        <span style="margin-bottom: 5px; color: #333; line-height: 26px;" id="step-2-admin"></span>
                    </p>

                
                </div>

                <div class="row margin-t-50">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Tipo de empresa
                            </strong>
                            <br>
                            <!-- <span style="font-size: 20px; color: #666; font-weight: 600;">
                                <?php //echo $service_name; ?>
                            </span> -->

                            <br>

                            <?php if($service_name !== "Indústria"){ ?>

                                <!-- <strong style="font-size: 14px; color: #00c221; line-height: 24px;">
                                    R$ <?php //echo number_format($service_price, 2, ',', '.'); ?> / <?php echo $service_cycle; ?>
                                </strong>
                                <br> -->
                            
                            <?php } ?> 
                            <!-- <?php if($service_action == "abertura"){ ?>

                                <a href="/abrir-empresa-gratis" class="btn btn-line-gray size-sm margin-t-20">TROCAR</a>
                            <?php }else{ ?>

                                <a href="/ja-tenho-empresa" class="btn btn-line-gray size-sm margin-t-20">TROCAR</a>
                            <?php } ?> -->

                                
                            <select id="input-service-type" class="form-control required margin-t-20" name="service_type" style="font-size: 14px; background-color: #fff;">
                                <option value="s" <?php if($service_name == "Prestação de serviços"){ echo "selected"; } ?>>Prestação de serviços</option>
                                <option value="c" <?php if($service_name == "Comércio"){ echo "selected"; } ?>>Comércio</option>
                                <option value="sc" <?php if($service_name == "Prestação de serviços e Comércio"){ echo "selected"; } ?>>Prestação de serviços e Comércio</option>
                                <option value="mei" <?php if($service_name == "Micro empreendedor individual"){ echo "selected"; } ?>>MEI - Micro empreendedor individual</option>
                                <option value="liberal" <?php if($service_name == "Profissional Liberal ou Autonomo"){ echo "selected"; } ?>>Profissional Liberal, Autonomo</option>
                                <option value="domestico" <?php if($service_name == "Empregado doméstico"){ echo "selected"; } ?>>Empregado Doméstico</option>
                                <option value="inativa" <?php if($service_name == "Empresa inativa"){ echo "selected"; } ?>>Empresa inativa</option>
                                <option value="industria" <?php if($service_name == "Indústria"){ echo "selected"; } ?>>Indústria</option>
                            </select>
                            
                        </div>
                    </div>

                    <?php if($service_name !== "Empregado doméstico"){ ?>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                            <div class="box-selected">
                                <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;" data-toggle="modal" data-target="#help_tributacao">
                                    Tipo de tributação

                                    <span class="icon ion-help-circled"  data-toggle="tooltip" data-placement="top" title="Tipos de tributação"  style="margin-left: 8px; font-size: 18px; color: #929292; cursor: pointer;"></span>

                                </strong>                     
                                

                                <br>
                                <!-- <span style="font-size: 20px; color: #666; font-weight: 600;">
                                    <?php //echo $service_taxation; ?>
                                </span>
                                <br> -->
                                <!-- <strong style="font-size: 12px; color: #00c221; line-height: 24px;">
                                    INCLUSO
                                </strong> -->
                                <br>

                                <select class="form-control required margin-t-20" name="taxation" style="font-size: 14px; background-color: #fff;" id="input-taxation">
                                    
                                    <?php if($service_name == "Micro empreendedor individual"){ ?>

                                        <option value="simei" <?php if($service->taxation == "simei"){ echo "selected"; } ?>>SIMEI</option>

                                    <?php }else{ ?>
                                    
                                        <option value="simples" <?php if($service->taxation == "simples"){ echo "selected"; } ?>>Simples Nacional</option>
                                        <option value="lucro" <?php if($service->taxation == "lucro"){ echo "selected"; } ?>>Lucro Presumido</option>
                                        <option value="real" <?php if($service->taxation == "real"){ echo "selected"; } ?>>Lucro Real</option>
                                    <?php } ?>
                                    
                                </select>

                            </div>
                        </div>

                    <?php }else{ ?>

                        <input name="taxation" type="hidden" value="simples">

                    <?php } ?>

                    <!-- <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Tipo do plano
                            </strong>
                            <br><br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;">
                                <?php if($business_plano == "digital"){ echo "Contabilidade Digital"; } ?>
                                <?php if($business_plano == "consultiva"){ echo "Contabilidade Consultiva"; } ?>
                            </span>
                            <br>
                            <select class="form-control required margin-t-20" name="plano" id="input-plano" style="font-size: 14px; background-color: #fff;">
                                <option value="digital" <?php if($business_plano == "digital"){ echo "selected"; } ?>>Contabilidade Digital</option>
                                <option value="consultiva" <?php if($business_plano == "consultiva"){ echo "selected"; } ?>>Contabilidade Consultiva</option>
                            </select>
                        </div>
                    </div> -->

                    <?php if($service_name !== "Empregado doméstico"){ ?>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                            <div class="box-selected">
                                <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                    Faturamento mensal
                                </strong>
                                <br>
                                <!-- <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-faturamento"> -->

                                    <?php
                                        // if($business_faturamento > 1){

                                        //     $begin = 15000.01;
                                        //     $end = 30000.00;

                                        //     for ($i=2; $i < 50; $i++) {

                                        //         if($business_faturamento == $i){
                                        //             echo 'R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.');
                                        //         }

                                        //         if($i == 1){
                                        //             $begin = $begin + 0.01;
                                        //         }

                                        //         $begin = $end;
                                        //         $end = $begin + 30000;
                                        //         // $begin = $begin + 25000;
                                        //         // $end = $end + 25000;
                                        //     }

                                        // }else{
                                        //     echo "R$ 0,00 a R$ 15.000,00";
                                        // }
                                    ?>
                                <!-- </span> -->
                                
                                <!-- <br> -->
                                <!-- <strong style="font-size: 12px; line-height: 24px; color: <?php if($business_faturamento > 1){ echo '#e70e55'; }else{ echo '#00c221'; } ?>;" id="price-faturamento">

                                    <?php
                                        // $price_faturamento = ($business_faturamento - 1) * 200;

                                        // if($business_faturamento > 1){
                                        //     echo "+ R$ ".number_format($price_faturamento, 2, ',', '.')." / Mensal";
                                        // }else{
                                        //     echo "GRÁTIS";
                                        // }
                                    ?>

                                </strong> -->
                                <br>

                                <select class="form-control required margin-t-20 input-faturamento" name="faturamento" id="input-faturamento" style="font-size: 14px; background-color: #fff;"></select>

                                <!-- <select class="form-control required margin-t-20" name="faturamento" id="input-faturamento"
                                    style="font-size: 14px; background-color: #fff;"> -->

                                    <!-- <option value="1" <?php if($business_faturamento == "1"){ echo "selected"; } ?>>De R$ 0,00 a R$ 15.000,00</option> -->

                                    <?php


                                    //     $begin = 15000.01;
                                    //     $end = 30000.00;

                                    //     for ($i=2; $i < 50; $i++) {

                                    //         if($business_faturamento == $i){
                                    //             echo '<option value="'.$i.'" selected>R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.').'</option>';
                                    //         }else{
                                    //             echo '<option value="'.$i.'">R$ '.number_format($begin, 2, ',', '.').' a R$ '.number_format($end, 2, ',', '.').'</option>';
                                    //         }

                                    //         if($i == 1){
                                    //             $begin = $begin + 0.01;
                                    //         }

                                    //         $begin = $end;
                                    //         $end = $begin + 30000;
                                    //         // $begin = $begin + 25000;
                                    //         // $end = $end + 25000;
                                    //     }
                                    // ?>

                                <!-- </select> -->
                            </div>
                        </div>           

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                            <div class="box-selected">
                                <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                    Quantidade de sócios
                                </strong>
                                <br><br>
                                <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-socios">

                                    <?php
                                        if($business_socios > 1){
                                            echo $business_socios." Sócios";
                                        }else{
                                            echo "1 sócio";
                                        }
                                    ?>

                                </span>
                                <br>
                                <!-- <strong style="font-size: 12px; color: <?php if($business_socios > 1){ echo '#e70e55'; }else{ echo '#00c221'; } ?>; line-height: 24px;" id="price-socios">

                                    <?php
                                        $price_socios = ($business_socios - 1) * 60.00;

                                        if($business_socios > 1){
                                            echo "+ R$ ".number_format($price_socios, 2, ',', '.')." / Mensal";
                                        }else{
                                            echo "GRÁTIS";
                                        }
                                    ?>

                                </strong> -->
                                <br>

                                <?php if($service_name == "Micro empreendedor individual"){ ?>

                                    <input type="number" id="step-2-socios-mei" class="form-control required margin-t-20" name="socios" min="1" max="1" id="input-socios" style="font-size: 18px; background-color: #fff;" value="<?php echo $business_socios; ?>">
                                
                                <?php }else{ ?>
                                    
                                    <input type="number" class="form-control required margin-t-20" name="socios" min="1" id="input-socios" style="font-size: 18px; background-color: #fff;" value="<?php echo $business_socios; ?>">
                                
                                <?php } ?>

                            </div>
                        </div>

                    <?php }else{ ?>
                    
                        <input name="faturamento" type="hidden" value="1">
                        <input name="socios" type="hidden" value="0">

                    <?php } ?>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                        <div class="box-selected">
                            <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                Quantidade de funcionários
                            </strong>
                            <br><br>
                            <span style="font-size: 20px; color: #666; font-weight: 600;" id="text-funcionarios">

                            <?php
                                if($business_funcionarios > 0){
                                    echo $business_funcionarios." Funcionários";
                                }else{
                                    echo "Nenhum funcionário";
                                }
                            ?>

                            </span>
                            <br>
                            <!-- <strong style="font-size: 12px; color: <?php if($business_funcionarios > 6){ echo '#e70e55'; }else{ echo '#00c221'; } ?>; line-height: 24px;" id="price-funcionarios">

                                <?php
                                    $price_funcionarios = ($business_funcionarios - 6) * 60.00;

                                    if($business_funcionarios > 6){
                                        echo "+ R$ ".number_format($price_funcionarios, 2, ',', '.')." / Mensal";
                                    }else{
                                        echo "GRÁTIS";
                                    }
                                ?>

                            </strong> -->
                            <br>

                            <?php if($service_name == "Micro empreendedor individual"){ ?>
                                <input type="number" id="step-2-funcionarios-mei" class="form-control required margin-t-20" name="funcionarios" min="0"  max="1" id="input-funcionarios" style="font-size: 18px; background-color: #fff;" value="<?php echo $business_funcionarios; ?>">
                            
                            <?php }else{ ?>
                                
                                <input type="number" class="form-control required margin-t-20" name="funcionarios" min="0"  id="input-funcionarios" style="font-size: 18px; background-color: #fff;" value="<?php echo $business_funcionarios; ?>">
                        
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if($service_action == "abertura"){ ?>

                    <div class="row">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                            <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Quais serão as atividades da sua empresa?</p>

                            <textarea rows="6" class="form-control required" name="atividades"
                                style="font-size: 14px; background-color: #fff; height: auto !important; padding-top: 20px;"><?php echo $business_atividades; ?></textarea>

                        
                            <p class="text margin-t-40" style="margin-bottom: 10px; font-size: 14px; color: #969696;">
                                O especialista responsável pela abertura de empresas entrará em contato para validar as informações e fazer orientções.
                            </p>

                            <p class="text margin-t-20" style="margin-bottom: 10px; font-size: 14px; color: #969696;">
                                *Condicionado a contratação da getão de sua empresa pela Link por no mínimo 12 meses.
                                <br>
                                Valores aproximados a serem confirmados pela Link no momento da contratação.
                                <br>
                                **Caso a empresa a ser aberta tenha vinculo direto com alguma atividade pertencente a quelquer Associação de Classes, haverá a cobrança de taxas de registro na referida Associação de Classe (p.ex.: CREA, CRM, CRO etc), com valor médio de R$ 1.000,00
                            </p>

                        </div>
                    </div>

                <?php } ?>

            </form>

            <div class="row">

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                    <a href="/contratar/etapa-1" class="btn btn-line-gray size-lg margin-t-50" style="margin-left: 3%">VOLTAR</a>
                    
                    <div class="col-6 margin-t-50">
                        <button data-toggle="modal" data-target="#agenda"class="btn btn-yellow size- margin-t-10" type="button">Agendar atendimento</button>
                        
                    </div>
                    <p class="text margin-t-20" style="margin-bottom: 10px; font-weight: 600; font-size: 11px;">
                        Caso seja necessário agende seu atendimento digital, clicando no botão acima
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-yellow size-lg margin-t-50 btn_send_form" id="btn-step-2"
                        data-url="/api/web/business/add-step-2" data-form="#form_step_2" data-redirect="/contratar/etapa-3">
                        PRÓXIMA ETAPA
                    </div>

                    <!-- <button class="btn btn-yellow size-lg margin-t-50" id="btn-agendamento-step-2">
                        PRÓXIMA ETAPA
                    </button> -->
                </div>
            </div>

            <br><br>

            <?php
                echo $this->element('footer_steps');
            ?>

        </div>

    </section>

</div>

<?php
    echo $this->element('sidebar_steps');
?>
