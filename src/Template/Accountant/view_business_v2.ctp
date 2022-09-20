
<?php 

    echo $this->element('add_customer');
    echo $this->element('add_provider');
    echo $this->element('add_partner');
    echo $this->element('add_employee');
    echo $this->element('add_account');
    echo $this->element('add_payment');
    echo $this->element('add_receipt');
    echo $this->element('add_category');

    echo $this->element('open_customer');
    echo $this->element('import_releases');
?>

<?php

    foreach ($all_business as $business) {

        if($business->status == 1){ $status_select_text = "lead"; $status_color = "gray"; }
        if($business->status == 2){ $status_select_text = "Em abertura"; $status_color = "yellow"; }
        if($business->status == 3){ $status_select_text = "Em migração"; $status_color = "yellow"; }
        if($business->status == 4){ $status_select_text = "Ativo"; $status_color = "green"; }
        if($business->status == 5){ $status_select_text = "Inativo"; $status_color = "green"; }
        if($business->status == 6){ $status_select_text = "Cancelado"; $status_color = "green"; }

        if($business->taxation == "simples"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "lucro"){ $taxation_text = "Lucro presumido"; }
        if($business->taxation == "real"){ $taxation_text = "Lucro real"; }

        if($business->type == "s"){ $type_text = "Prestação de serviços"; }
        if($business->type == "c"){ $type_text = "Comércio"; }
        if($business->type == "sc"){ $type_text = "Prestação de serviços e Comércio"; }
        if($business->type == "mei"){ $type_text = "Micro empreendedor individual"; }
        if($business->type == "domestico"){ $type_text = "Empregado doméstico"; }
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
<div style="background-color: #fff; padding: 40px; padding-right: 330px; min-height: 800px; padding-right: 30px;">

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

              <!-- BOX 2 -->
              <div style="float: left; margin-left: 10px;">
                  <span style="font-size: 12px; color: #999; font-weight: 500;">Status</span>
                  <br>

                  <div class="box-filter <?= $status_color; ?>" style="margin-left: 0px; margin-top: 10px;">
                      <?= $status_select_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">
                          <a href="#" class="item-filter">Lead</a>
                          <a href="#" class="item-filter">Em abertura</a>
                          <a href="#" class="item-filter">Em migração</a>
                          <a href="#" class="item-filter">Ativo</a>
                          <a href="#" class="item-filter">Inativo</a>
                          <a href="#" class="item-filter">Cancelado</a>
                      </div>
                  </div>
                  <div class="clear"></div>
              </div>

              <div class="clear"></div>

          </div>
      </div>

    </div>

    <!-- TABS -->
    <div class="box-tabs">
        <a href="?tab_select=8" class="tab-item <?php if($tab_select == 8){ echo "active"; } ?>" data-open="#tab-content-8">Clientes</a>
        <a href="?tab_select=9" class="tab-item <?php if($tab_select == 9){ echo "active"; } ?>" data-open="#tab-content-9">Fornecedores</a>
        <a href="?tab_select=10" class="tab-item <?php if($tab_select == 10){ echo "active"; } ?>" data-open="#tab-content-10">Funcionários</a>
        <a href="?tab_select=11" class="tab-item <?php if($tab_select == 11){ echo "active"; } ?>" data-open="#tab-content-11">Sócios</a>
        <a href="?tab_select=12" class="tab-item <?php if($tab_select == 12){ echo "active"; } ?>" data-open="#tab-content-12">Contas</a>
        <a href="?tab_select=13" class="tab-item <?php if($tab_select == 13){ echo "active"; } ?>" data-open="#tab-content-13">Pagamentos</a>
        <a href="?tab_select=14" class="tab-item <?php if($tab_select == 14){ echo "active"; } ?>" data-open="#tab-content-14">Recebimentos</a>
        <a href="?tab_select=15" class="tab-item <?php if($tab_select == 15){ echo "active"; } ?>" data-open="#tab-content-15">Fluxo de caixa</a>
        <a href="?tab_select=16" class="tab-item <?php if($tab_select == 16){ echo "active"; } ?>" data-open="#tab-content-16">Categorias</a>
        <div class="clear"></div>
    </div>

    <!-- TAB 8 -->
    <div class="box-tab-content <?php if($tab_select == 8){ echo "active"; } ?>" id="tab-content-8">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_customers=0; foreach ($query_customers as $customer) { $count_customers++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_customers; ?> clientes encontrados
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_customer">
                        NOVO CLIENTE
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">E-mail</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Telefone</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">CPF/CNPJ</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_customers as $customer) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php
                            
                                if($customer->type == 'pj'){
                                    echo $customer->pj_razao;
                                }else{
                                    echo $customer->pf_name;
                                }
                            
                            ?>

                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $customer->email; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $customer->phone; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($customer->type == 'pj'){
                                echo $customer->pj_document;
                            }else{
                                echo $customer->pf_document;
                            }
                        
                        ?>
                        
                        </strong>

                        <div style="position: absolute; right: 0px; top: 0px;">

                            <i class="material-icons-outlined" style="cursor: pointer;"
                                data-toggle="modal" data-target="#open_customer">create</i>

                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/customers/<?php echo $customer->id; ?>/delete" data-form="#form" data-redirect="none" >delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum cliente.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 9 -->
    <div class="box-tab-content <?php if($tab_select == 9){ echo "active"; } ?>" id="tab-content-9">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_providers=0; foreach ($query_providers as $provider) { $count_providers++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_providers; ?> fornecedores encontrados
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_provider">
                            NOVO FORNECEDOR
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">E-mail</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Telefone</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">CPF/CNPJ</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_providers as $provider) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($provider->type == 'pj'){
                                echo $provider->pj_razao;
                            }else{
                                echo $provider->pf_name;
                            }
                        
                        ?>
                        
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $provider->email; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $provider->phone; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($provider->type == 'pj'){
                                echo $provider->pj_document;
                            }else{
                                echo $provider->pf_document;
                            }
                        
                        ?>
                        
                        </strong>

                        <div style="position: absolute; right: 0px; top: 0px;">

                            <i class="material-icons-outlined" style="cursor: pointer;"
                                data-toggle="modal" data-target="#open_customer">create</i>

                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/providers/<?php echo $provider->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum fornecedor.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 10 -->
    <div class="box-tab-content <?php if($tab_select == 10){ echo "active"; } ?>" id="tab-content-10">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_employees=0; foreach ($query_employees as $employee) { $count_employees++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_employees; ?> funcionários encontrados
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_employee">
                            NOVO FUNCIONÁRIO
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">E-mail</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Telefone</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">CPF/CNPJ</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_employees as $employee) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($employee->type == 'pj'){
                                echo $employee->pj_razao;
                            }else{
                                echo $employee->pf_name;
                            }
                        
                        ?>
                        
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $employee->email; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $employee->phone; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($employee->type == 'pj'){
                                echo $employee->pj_document;
                            }else{
                                echo $employee->pf_document;
                            }
                        
                        ?>
                        
                        </strong>

                        <div style="position: absolute; right: 0px; top: 0px;">

                            <i class="material-icons-outlined" style="cursor: pointer;"
                                data-toggle="modal" data-target="#open_customer">create</i>

                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/employees/<?php echo $employee->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum funcionário.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 11 -->
    <div class="box-tab-content <?php if($tab_select == 11){ echo "active"; } ?>" id="tab-content-11">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_partners=0; foreach ($query_partners as $partner) { $count_partners++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_partners; ?> sócios encontrados
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_partner">
                            NOVO SÓCIO
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">E-mail</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Telefone</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">CPF/CNPJ</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_partners as $partner) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($partner->type == 'pj'){
                                echo $partner->pj_razao;
                            }else{
                                echo $partner->pf_name;
                            }
                        
                        ?>
                        
                        </strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $partner->email; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $partner->phone; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                        <?php
                            
                            if($partner->type == 'pj'){
                                echo $partner->pj_document;
                            }else{
                                echo $partner->pf_document;
                            }
                        
                        ?>
                        
                        </strong>

                        <div style="position: absolute; right: 0px; top: 0px;">
                            
                            <i class="material-icons-outlined" style="cursor: pointer;"
                                data-toggle="modal" data-target="#open_customer">create</i>

                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/partners/<?php echo $partner->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum sócio.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 12 -->
    <div class="box-tab-content <?php if($tab_select == 12){ echo "active"; } ?>" id="tab-content-12">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_accounts=0; foreach ($query_accounts as $account) { $count_accounts++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_accounts; ?> contas encontradas
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_account">
                            NOVA CONTA
                    </div>
                </div>
            </div>

            <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">

                <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12" style="background-color: #fff; padding: 30px; box-shadow: 0px 3px 5px rgba(0,0,0,.2); margin: 10px; border-radius: 10px;">

                        <strong style="color: #333; font-size: 18px;"><?php echo $account->bank; ?></strong>
                        <br>
                        <strong style="color: #868686; font-size: 12px;"><?php echo $account->agency; ?></strong> | 
                        <strong style="color: #868686; font-size: 12px;"><?php echo $account->account; ?></strong>
                        <br>
                        <strong style="color: #868686; font-size: 12px;"><?php echo $account->account_type; ?></strong>
                        

                        <div style="position: absolute; right: 30px; bottom: 30px;">
                            <strong style="color: #28bd56; font-size: 14px;">R$ <?php echo number_format($account->total, 2, ',', '.'); ?></strong>
                        </div>

                        <div style="position: absolute; right: 20px; top: 20px;">
                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer; color: #868686;"
                                data-url="/api/web/custom/accounts/<?php echo $account->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>

                    </div>

                <?php } ?>

            </div>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhuma conta bancária.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 13 -->
    <div class="box-tab-content <?php if($tab_select == 13){ echo "active"; } ?>" id="tab-content-13">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_payments=0; foreach ($query_payments as $payment) { $count_payments++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_payments; ?> pagamentos encontradas
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_payment">
                            NOVO PAGAMENTO
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Vencimento</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Status</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_payments as $payment) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $payment->title; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo date_format($payment->maturity, 'd/m/Y'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($payment->value, 2, ',', '.'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">

                        <div class="badge-status relative default">PENDENTE</div>

                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">create</i>
                            
                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/payments/<?php echo $payment->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhuma conta a pagar.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 14 -->
    <div class="box-tab-content <?php if($tab_select == 14){ echo "active"; } ?>" id="tab-content-14">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <?php $count_receipts=0; foreach ($query_receipts as $receipt) { $count_receipts++; } ?>

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        <?php echo $count_receipts; ?> recebimentos encontradas
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-line-gray size-sm btn_send_form">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_receipt">
                            NOVO RECEBIMENTO
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Vencimento</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Status</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_receipts as $receipt) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $receipt->title; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo date_format($receipt->maturity, 'd/m/Y'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($receipt->value, 2, ',', '.'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">

                        <div class="badge-status relative default">PENDENTE</div>

                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">create</i>
                            
                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                data-url="/api/web/custom/receipts/<?php echo $receipt->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhuma conta a receber.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 15 -->
    <div class="box-tab-content <?php if($tab_select == 15){ echo "active"; } ?>" id="tab-content-15">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        Fluxo de caixa
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    
                    <div class="btn btn-line-gray size-sm">
                            EXPORTAR
                    </div>

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#import_releases">
                            IMPORTAR
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Data</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Status</p>
                </div>
            </div>

            <?php $x=0; foreach ($query_releases as $release) { $x++; ?>

                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo date_format($release->created, 'd/m/Y')." às ".date_format($release->created, 'h:i'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $release->title; ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($release->value, 2, ',', '.'); ?></strong>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">

                        <div class="badge-status relative default">PENDENTE</div>
                    </div>
                </div>

                <hr>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum lançamento.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <!-- TAB 16 -->
    <div class="box-tab-content <?php if($tab_select == 16){ echo "active"; } ?>" id="tab-content-16">

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

            <div class="row margin-t-20">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                        Categorias
                    </p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                    <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_category">
                            NOVA CATEGORIA
                    </div>
                </div>
            </div>

            <div class="row margin-t-40" style="background-color: #666; padding: 10px; border-radius: 10px;">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #fff; font-weight: 600;">Nome</p>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                    <p class="text" style="margin-bottom: 0px; color: #fff; font-weight: 600;">Tipo de categoria</p>
                </div> 
            </div>

            <div class="row margin-t-20" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                    <strong style="color: #333; font-size: 12px;">Receitas operacionais</strong>
                </div>
            </div>

            <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                <?php 
                    if($category->group_categories == "receitas_operacionais"){ 
                ?>

                <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                    
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php 
                                if($category->type == "receipt"){
                                    echo "Receita";
                                }else{
                                    echo "Despesa";
                                }
                             ?>
                        </strong>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

                <?php } ?>

            <?php } ?>

            <div class="row" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                    <strong style="color: #333; font-size: 12px;">Custos operacionais</strong>
                </div>
            </div>

            <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                <?php 
                    if($category->group_categories == "custos_operacionais"){ 
                ?>

                <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                    
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php 
                                if($category->type == "receipt"){
                                    echo "Receita";
                                }else{
                                    echo "Despesa";
                                }
                             ?>
                        </strong>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

                <?php } ?>

            <?php } ?>

            <div class="row" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                    <strong style="color: #333; font-size: 12px;">Despesas opercionais e outras receitas</strong>
                </div>
            </div>

            <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                <?php 
                    if($category->group_categories == "despesas_opercionais_e_outras_receitas"){ 
                ?>

                <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                    
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php 
                                if($category->type == "receipt"){
                                    echo "Receita";
                                }else{
                                    echo "Despesa";
                                }
                             ?>
                        </strong>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

                <?php } ?>

            <?php } ?>

            <div class="row" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                    <strong style="color: #333; font-size: 12px;">Atividade de investimento</strong>
                </div>
            </div>

            <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                <?php 
                    if($category->group_categories == "atividade_de_investimento"){ 
                ?>

                <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                    
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php 
                                if($category->type == "receipt"){
                                    echo "Receita";
                                }else{
                                    echo "Despesa";
                                }
                             ?>
                        </strong>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

                <?php } ?>

            <?php } ?>

            <div class="row" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                    <strong style="color: #333; font-size: 12px;">Atividade de financiamento</strong>
                </div>
            </div>

            <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                <?php 
                    if($category->group_categories == "atividade_de_financiamento"){ 
                ?>

                <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                    
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                        <strong style="color: #333; font-size: 12px;">
                        
                            <?php 
                                if($category->type == "receipt"){
                                    echo "Receita";
                                }else{
                                    echo "Despesa";
                                }
                             ?>
                        </strong>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <div style="position: absolute; right: 0px; top: 0px;">
                            <i class="material-icons-outlined">delete</i>
                        </div>
                    </div>
                </div>

                <hr>

                <?php } ?>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum lançamento.</span>
                </div>

            <?php } ?>

        </div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<!-- Sidebar -->
<div class="scroll-active" style="display: none; position: fixed; right: 0px; top: 0px; background-color: #f9f9f9; padding: 25px; padding-top: 100px; padding-right: 30px; width: 300px; height: 100%;">

    <div class="btn-add-comment">
        <i class="material-icons-outlined">chat</i>
    </div>

    <span style="display: block; font-size: 14px; color: #666; font-weight: 500; margin-top: 8px; margin-bottom: 30px;">
        Histórico de atividades
    </span>

    <?php $x=0; foreach ($all_activities as $activity) { $x++; ?>

        <?php 
            if($infos_user_activity[$activity->id]["permission"] == '1'){ $color_user = "#34a6ef"; }
            if($infos_user_activity[$activity->id]["permission"] == '2'){ $color_user = "#ff3576"; }
            if($infos_user_activity[$activity->id]["permission"] !== '1' && $infos_user_activity[$activity->id]["permission"] !== '2' ){ $color_user = "#a31ae2"; }
        ?>

        <a href="<?= $activity->link; ?>" class="box-activity client">
            <div class="arrow-top"></div>

            <!-- <i class="material-icons-outlined">folder</i> -->


            <span class="date"><?php echo '<strong style="color: '.$color_user.';">'.$infos_user_activity[$activity->id]["name"].'</strong> - '.date_format($activity->created, 'd/m/Y'); ?></span>
            <span class="title"><?= $activity->type; ?></span>
            <span class="title"><?= $activity->title; ?></span>
        </a>

    <?php } ?>

    <?php if($x == 0){ ?>

        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
            <i class="material-icons-outlined icon-empty">all_inclusive</i>
            <span class="title" style="font-size: 12px;">O cliente não possui nenhuma atividade.</span>
        </div>

    <?php } ?>

    <div class="clear"></div>

</div>
