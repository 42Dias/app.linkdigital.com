
<?php 

?>

<?php

    foreach ($all_business as $business) {

        if($business->status == 1){ $status_select_text = "lead"; $status_color = "gray"; }
        if($business->status == 2){ $status_select_text = "Em abertura"; $status_color = "yellow"; }
        if($business->status == 3){ $status_select_text = "Em migração"; $status_color = "yellow"; }
        if($business->status == 4){ $status_select_text = "Ativo"; $status_color = "green"; }
        if($business->status == 5){ $status_select_text = "Inativo"; $status_color = "gray"; }
        if($business->status == 6){ $status_select_text = "Cancelado"; $status_color = "gray"; }

        if($business->taxation == "simei"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "simples"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "lucro"){ $taxation_text = "Lucro presumido"; }
        if($business->taxation == "real"){ $taxation_text = "Lucro real"; }

        if($business->type == "s"){ $type_text = "Prestação de serviços"; }
        if($business->type == "c"){ $type_text = "Comércio"; }
        if($business->type == "sc"){ $type_text = "Prestação de serviços e Comércio"; }
        if($business->type == "mei"){ $type_text = "Micro empreendedor individual"; }
        if($business->type == "domestico"){ $type_text = "Empregado doméstico"; }
        if($business->type == "industria"){ $type_text = "Indústria"; }
        if($business->type == "inativa"){ $type_text = "Empresa inativa"; }
        if($business->type == "liberal"){ $type_text = "Profissional Liberal ou Autonomo"; }

        $business_name = $business->fantasia;
        $business_cnpj = $business->cnpj;
        $business_razao = $business->razao;
        $business_fantasia = $business->fantasia;
        $business_taxation = $business->taxation;
        $business_faturamento = $business->faturamento;
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;
        $business_atividades = $business->atividades;
        $business_zipcode = $business->zipcode;
        $business_address = $business->address;
        $business_number = $business->number;
        $business_complement = $business->complement;
        $business_district = $business->district;
        $business_city = $business->city;
        $business_state = $business->state;
        $user_step = $business->steps;
        
        $service_action = $business->action;
        $service_type = $business->type;

        if($service_action == "migracao"){ $service_action_text = "Migração de empresa"; }
        if($service_action == "abertura"){ $service_action_text = "Abertura de empresa"; }

        // Services
        foreach ($all_services as $service) {
            $service_name = $service->name;
            $service_price = $service->price;

            // Taxation
            if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
            if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }

            // Cycle
            if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
            if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
        }

        foreach ($all_business as $business) {
            $business_socios = $business->socios;
            $business_funcionarios = $business->funcionarios;
        }

        $total_month = $service_price;
        $total_month += ($business_socios - 1) * 29.90;
        $total_month += $business_funcionarios * 29.90;
    }

    // USERS
    foreach ($all_users as $user) {
        $user_name = $user->name;
        $user_lastname = $user->lastname;
        $user_username = $user->username;
        $user_cpf = $user->cpf;
        $user_birthday = $user->birthday;
        $user_phone = $user->phone;
        $user_whatsapp = $user->whatsapp;
    }
?>

<!-- Content -->
<div style="background-color: #fff; padding: 40px; min-height: 800px; padding-right: 330px;">

    <!-- Menu Page -->
    <div class="menu-page">

      <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
              <span class="title-page"><?= $business->fantasia; ?></span>

              <span style="display: block; font-size: 14px; color: #999; font-weight: 500; margin-top: 8px;">
                  <?= $type_text; ?> | <?= $taxation_text; ?>
              </span>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

              <!-- BOX 1 -->
              <div style="float: left;">
                  <span style="font-size: 12px; color: #999; font-weight: 500;">Responsável</span>
                  <br>

                  <div class="box-filter gray" style="margin-left: 0px; margin-top: 10px;">

                      <?php foreach ($all_accountants as $accountant) { ?>
                          <?php if($accountant->id == $business->accountant_id){ echo $accountant->name; } ?></a>
                      <?php } ?>

                      <?php if($business->accountant_id == 0){ echo "Nenhum"; } ?>

                      &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">

                          <?php foreach ($all_accountants as $accountant) { ?>
                              <a href="#" class="item-filter"><?php $accountant->name; ?></a>
                          <?php } ?>

                      </div>
                  </div>
                  <div class="clear"></div>
              </div>

              <!-- BOX 2 -->
              <div style="float: left; margin-left: 10px;">
                  <span style="font-size: 12px; color: #999; font-weight: 500;">Status</span>
                  <br>

                  <div class="box-filter <?= $status_color; ?>" style="margin-left: 0px; margin-top: 10px;">
                      <?= $status_select_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="1">Lead</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="2">Em abertura</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="3">Em migração</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="4">Ativo</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="5">Inativo</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="6">Cancelado</a>
                      </div>
                  </div>
                  <div class="clear"></div>
              </div>

              <div class="clear"></div>

          </div>
      </div>

    </div>

    <?php
        echo $this->element('business_menu');
    ?>

    <div class="box-tab-content active" id="tab-content-7">

        <form id="form_step_1" method="POST" style="padding: 0; margin-top: 30px;">

            <div class="accordion" id="infosBusiness">

                <!-- CARD 1 -->
                <div class="card">
                    <div class="card-header" id="head-1">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                            Informações do contrato
                        </div>
                    </div>

                    <div id="collapse-1" class="collapse show" aria-labelledby="head-1" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Mensalidade</p>
                                    <strong style="color: #32dc4f; font-size: 24px;">R$ <?php echo number_format($total_month, 2, ',', '.'); ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Pagamento</p>
                                    <strong style="color: #666;"> <?php echo $status_payment; ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Preenchimento</p>
                                    <strong style="color: #666;">Etapa <?php echo $user_step; ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Criado em</p>
                                    <strong style="color: #666;"><?php echo date_format($business->created, 'd/m/Y')." às ".date_format($business->created, 'h:i'); ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Atualizado em</p>
                                    <strong style="color: #666;"><?php echo date_format($business->updated, 'd/m/Y')." às ".date_format($business->updated, 'h:i'); ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contrato assinado em</p>
                                    <strong style="color: #666;"><?php if($business->sign_date != ""){ echo date_format($business->sign_date, 'd/m/Y')." às ".date_format($business->sign_date, 'h:i'); } ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Termos assinado em</p>
                                    <strong style="color: #666;"><?php if($business->terms_date != ""){ echo date_format($business->terms_date, 'd/m/Y')." às ".date_format($business->terms_date, 'h:i'); } ?></strong>
                                </div>
                            </div>

                            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                    data-url="/api/web/accountant/business/<?php echo $business_id; ?>/force-payment" data-form="" data-redirect="">
                                    PAGAR MANUALMENTE
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 0 -->
                <div class="card">
                    <div class="card-header" id="head-0">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-0" aria-expanded="true" aria-controls="collapse-0">
                            Serviços contratados
                        </div>
                    </div>

                    <div id="collapse-0" class="collapse show" aria-labelledby="head-0" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row margin-t-30" style="background-color: #f9f9f9; padding: 10px; border-radius: 10px;">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #969696; font-weight: 600;">Serviço</p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #969696; font-weight: 600;">Quantidade</p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #969696; font-weight: 600;">Valor</p>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #969696; font-weight: 600;">Sub-total</p>
                                </div>
                            </div>

                            <div class="row margin-t-30" style="padding: 0px 10px;">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text" style=" margin-bottom: 3px; color: #969696; font-weight: 500; font-size: 12px;"><?= $service_action_text; ?></p>
                                    <strong style="color: #666; font-size: 14px;"><?php echo $type_text." - ".$taxation_text; ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">
                                    <strong style="color: #999; font-size: 14px;">1</strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #999; font-size: 14px;">R$ <?php echo number_format($service_price, 2, ',', '.'); ?></strong>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">R$ <?php echo number_format($service_price, 2, ',', '.'); ?></strong>
                                </div>
                            </div>

                            <hr>

                            <div class="row margin-t-20" style="padding: 0px 10px;">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">Faturamento Mensal</strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">
                                    <strong style="color: #999; font-size: 14px;">0</strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #32dc4f; font-size: 14px;">GRÁTIS</strong>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">R$ 0,00</strong>
                                </div>
                            </div>

                            <hr>

                            <div class="row margin-t-20" style="padding: 0px 10px;">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">Sócios adicionais</strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">
                                    <strong style="color: #999; font-size: 14px;"><?= ($business_socios - 1); ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: <?php if($business_socios > 1){ echo '#999'; }else{ echo '#32dc4f'; } ?>; font-size: 14px;">

                                        <?php

                                            if($business_socios > 1){
                                                echo "R$ 29,90";
                                            }else{
                                                echo "GRÁTIS";
                                            }
                                        ?>

                                    </strong>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">

                                        <?php
                                            $price_socios = ($business_socios - 1) * 29.90;

                                            if($business_socios > 1){
                                                echo "R$ ".number_format($price_socios, 2, ',', '.');
                                            }else{
                                                echo "R$ 0,00";
                                            }
                                        ?>

                                    </strong>
                                </div>
                            </div>

                            <hr>

                            <div class="row margin-t-20" style="padding: 0px 10px;">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">Funcionários adicionais</strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">
                                    <strong style="color: #999; font-size: 14px;"><?= $business_funcionarios; ?></strong>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: <?php if($business_funcionarios > 0){ echo '#999'; }else{ echo '#32dc4f'; } ?>; font-size: 14px;">

                                        <?php
                                            if($business_funcionarios > 0){
                                                echo "R$ 29,90";
                                            }else{
                                                echo "GRÁTIS";
                                            }
                                        ?>

                                    </strong>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #666; font-size: 14px;">

                                        <?php
                                            $price_funcionarios = $business_funcionarios * 29.90;

                                            if($business_funcionarios > 0){
                                                echo "R$ ".number_format($price_funcionarios, 2, ',', '.');
                                            }else{
                                                echo "R$ 0,00";
                                            }
                                        ?>

                                    </strong>
                                </div>
                            </div>

                            <hr>

                            <div class="row margin-t-40" style="padding: 0px 10px;">
                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-left animate-scroll">

                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 text-center animate-scroll">

                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #666; font-size: 16px;">TOTAL</strong>
                                </div>

                                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 text-right animate-scroll">
                                    <strong style="color: #32dc4f; font-size: 20px;">R$ <?php echo number_format($total_month, 2, ',', '.'); ?></strong>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 2 -->
                <div class="card">
                    <div class="card-header" id="head-2">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                            Informações pessoais
                        </div>
                    </div>

                    <div id="collapse-2" class="collapse show" aria-labelledby="head-2" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row">

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                    <input type="text" class="form-control accountant required" name="name" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_name; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Sobrenome</p>
                                    <input type="text" class="form-control accountant required" name="lastname" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_lastname; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Data de nascimento</p>
                                    <input type="text" class="form-control accountant mask-date" name="birthday" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_birthday; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                    <input type="text" class="form-control accountant required mask-cpf" name="cpf" id="input-cpf" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_cpf; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                    <input type="text" class="form-control accountant required" name="username" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_username; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone / Celular</p>
                                    <input type="text" class="form-control accountant required mask-phone" name="phone" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_phone; ?>">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Whatsapp</p>
                                    <input type="text" class="form-control accountant mask-phone" name="whatsapp" style="font-size: 14px; background-color: #fff;"
                                        value="<?php echo $user_whatsapp; ?>">
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 3 -->
                <div class="card">
                    <div class="card-header" id="head-3">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                            Informações da empresa
                        </div>
                    </div>

                    <div id="collapse-3" class="collapse show" aria-labelledby="head-3" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row">

                                <!-- MIGRAÇÃO -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ da empresa</p>

                                    <input type="text" class="form-control accountant required mask-cnpj" name="cnpj" style="font-size: 14px; background-color: #fff;"
                                            value="<?php echo $business_cnpj; ?>">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>

                                    <input type="text" class="form-control accountant required" name="razao" style="font-size: 14px; background-color: #fff;"
                                            value="<?php echo $business_razao; ?>">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome fantasia</p>

                                    <input type="text" class="form-control accountant required" name="fantasia" style="font-size: 14px; background-color: #fff;"
                                            value="<?php echo $business_fantasia; ?>">
                                </div>
                            </div>

                            <div class="row margin-t-20">

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
                                    <div class="box-selected">
                                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                            Tipo de empresa
                                        </strong>
                                        <br><br>
                                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                                            <?php echo $service_name; ?>
                                        </span>
                                        <br>
                                        <strong style="font-size: 14px; color: #ff3576; line-height: 24px;">
                                            R$ <?php echo number_format($service_price, 2, ',', '.'); ?> / <?php echo $service_cycle; ?>
                                        </strong>
                                        <br>

                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
                                    <div class="box-selected">
                                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                            Tipo de tributação
                                        </strong>
                                        <br><br>
                                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                                            <?php echo $service_taxation; ?>
                                        </span>
                                        <br>
                                        <strong style="font-size: 12px; color: #32dc4f; line-height: 24px;">
                                            INCLUSO
                                        </strong>
                                        <br>

                                        <select class="form-control accountant required margin-t-20" name="taxation"
                                            style="font-size: 14px; background-color: #fff;">

                                            <option value="simples" <?php if($business_taxation == "simples"){ echo "selected"; } ?>>Simples Nacional</option>
                                        </select>

                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
                                    <div class="box-selected">
                                        <strong style="font-size: 12px; color: #9c9c9c; line-height: 24px;">
                                            Faturamento mensal
                                        </strong>
                                        <br><br>
                                        <span style="font-size: 20px; color: #666; font-weight: 600;">
                                            Até R$ 15.000,00
                                        </span>
                                        <br>
                                        <strong style="font-size: 12px; color: #32dc4f; line-height: 24px;">
                                            INCLUSO
                                        </strong>
                                        <br>

                                        <select class="form-control accountant required margin-t-20" name="faturamento"
                                            style="font-size: 14px; background-color: #fff;">

                                            <option value="1" <?php if($business_faturamento == "1"){ echo "selected"; } ?>>De R$ 0,00 a R$ 15.000,00</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
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
                                        <strong style="font-size: 12px; color: <?php if($business_socios > 1){ echo '#ff3576'; }else{ echo '#32dc4f'; } ?>; line-height: 24px;" id="price-socios">

                                            <?php
                                                $price_socios = ($business_socios - 1) * 29.90;

                                                if($business_socios > 1){
                                                    echo "+ R$ ".number_format($price_socios, 2, ',', '.')." / Mensal";
                                                }else{
                                                    echo "GRÁTIS";
                                                }
                                            ?>

                                        </strong>
                                        <br>

                                        <input type="number" class="form-control accountant required margin-t-20" name="socios" min="1" id="input-socios"
                                            style="font-size: 18px; background-color: #fff;" value="<?php echo $business_socios; ?>">
                                    </div>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll margin-t-30">
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
                                        <strong style="font-size: 12px; color: <?php if($business_funcionarios > 0){ echo '#ff3576'; }else{ echo '#32dc4f'; } ?>; line-height: 24px;" id="price-funcionarios">

                                            <?php
                                                $price_funcionarios = $business_funcionarios * 29.90;

                                                if($business_funcionarios > 0){
                                                    echo "+ R$ ".number_format($price_funcionarios, 2, ',', '.')." / Mensal";
                                                }else{
                                                    echo "GRÁTIS";
                                                }
                                            ?>

                                        </strong>
                                        <br>

                                        <input type="number" class="form-control accountant required margin-t-20" name="funcionarios" min="0"  id="input-funcionarios"
                                            style="font-size: 18px; background-color: #fff;" value="<?php echo $business_funcionarios; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row margin-t-50">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Atividades da empresa</p>

                                    <textarea rows="14" class="form-control accountant required" name="atividades"
                                        style="font-size: 12px; font-weight: 400; background-color: #fff; height: auto !important; padding-top: 20px;"><?php echo $business_atividades; ?></textarea>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- CARD 4 -->
                <div class="card">
                    <div class="card-header" id="head-4">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                            Localização
                        </div>
                    </div>

                    <div id="collapse-4" class="collapse show" aria-labelledby="head-4" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">

                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>

                                    <input type="text" class="form-control accountant required mask-cep" name="zipcode" id="input-cep" value="<?php echo $business_zipcode; ?>"
                                        style="font-size: 14px; background-color: #fff;">

                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>

                                    <input type="text" class="form-control accountant required" name="address" id="input-address"  value="<?php echo $business_address; ?>"
                                        style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>

                                    <input type="text" class="form-control accountant required" name="number"   value="<?php echo $business_number; ?>"
                                        style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>

                                    <input type="text" class="form-control accountant" name="complement"  value="<?php echo $business_complement; ?>"
                                        style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>

                                    <input type="text" class="form-control accountant required" name="district" id="input-district"  value="<?php echo $business_district; ?>"
                                        style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>

                                    <input type="text" class="form-control accountant required" name="city" id="input-city"  value="<?php echo $business_city; ?>"
                                        style="font-size: 14px; background-color: #fff;">
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>

                                    <select class="form-control accountant required" name="state" id="input-state" style="font-size: 14px; background-color: #fff;">
                                        <option value="">Selecione</option>
                                        <option value="AC" <?php if($business_state == "AC"){ echo "selected"; } ?>>AC - Acre</option>
                                        <option value="AL" <?php if($business_state == "AL"){ echo "selected"; } ?>>AL - Alagoas</option>
                                        <option value="AP" <?php if($business_state == "AP"){ echo "selected"; } ?>>AP - Amapá</option>
                                        <option value="AM" <?php if($business_state == "AM"){ echo "selected"; } ?>>AM - Amazonas</option>
                                        <option value="BA" <?php if($business_state == "BA"){ echo "selected"; } ?>>BA - Bahia</option>
                                        <option value="CE" <?php if($business_state == "CE"){ echo "selected"; } ?>>CE - Ceará</option>
                                        <option value="DF" <?php if($business_state == "DF"){ echo "selected"; } ?>>DF - Distrito Federal</option>
                                        <option value="ES" <?php if($business_state == "ES"){ echo "selected"; } ?>>ES - Espírito Santo</option>
                                        <option value="GO" <?php if($business_state == "GO"){ echo "selected"; } ?>>GO - Goiás</option>
                                        <option value="MA" <?php if($business_state == "MA"){ echo "selected"; } ?>>MA - Maranhão</option>
                                        <option value="MT" <?php if($business_state == "MT"){ echo "selected"; } ?>>MT - Mato Grosso</option>
                                        <option value="MS" <?php if($business_state == "MS"){ echo "selected"; } ?>>MS - Mato Grosso do Sul</option>
                                        <option value="MG" <?php if($business_state == "MG"){ echo "selected"; } ?>>MG - Minas Gerais</option>
                                        <option value="PA" <?php if($business_state == "PA"){ echo "selected"; } ?>>PA - Pará</option>
                                        <option value="PB" <?php if($business_state == "PB"){ echo "selected"; } ?>>PB - Paraíba</option>
                                        <option value="PR" <?php if($business_state == "PR"){ echo "selected"; } ?>>PR - Paraná</option>
                                        <option value="PE" <?php if($business_state == "PE"){ echo "selected"; } ?>>PE - Pernambuco</option>
                                        <option value="PI" <?php if($business_state == "PI"){ echo "selected"; } ?>>PI - Piauí</option>
                                        <option value="RJ" <?php if($business_state == "RJ"){ echo "selected"; } ?>>RJ - Rio de Janeiro</option>
                                        <option value="RN" <?php if($business_state == "RN"){ echo "selected"; } ?>>RN - Rio Grande do Norte</option>
                                        <option value="RS" <?php if($business_state == "RS"){ echo "selected"; } ?>>RS - Rio Grande do Sul</option>
                                        <option value="RO" <?php if($business_state == "RO"){ echo "selected"; } ?>>RO - Rondônia</option>
                                        <option value="RR" <?php if($business_state == "RR"){ echo "selected"; } ?>>RR - Roraima</option>
                                        <option value="SC" <?php if($business_state == "SC"){ echo "selected"; } ?>>SC - Santa Catarina</option>
                                        <option value="SP" <?php if($business_state == "SP"){ echo "selected"; } ?>>SP - São Paulo</option>
                                        <option value="SE" <?php if($business_state == "SE"){ echo "selected"; } ?>>SE - Sergipe</option>
                                        <option value="TO" <?php if($business_state == "TO"){ echo "selected"; } ?>>TO - Tocantins</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </form>

        <div class="text-right">

            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                    data-url="/api/web/business/add-step-1" data-form="#form_step_1" data-redirect="/contratar/etapa-2">
                    ATUALIZAR
            </div>
        </div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<?php
    echo $this->element('sidebar_timeline');
?>
