
<?php 
    echo $this->element('add_taxe_accountant');
    echo $this->element('open_taxe_accountant');
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

    // TAB 2
    if($month_tab_2 == "01"){ $month_tab_2_text = "Janeiro"; }
    if($month_tab_2 == "02"){ $month_tab_2_text = "Fevereiro"; }
    if($month_tab_2 == "03"){ $month_tab_2_text = "Março"; }
    if($month_tab_2 == "04"){ $month_tab_2_text = "Abril"; }
    if($month_tab_2 == "05"){ $month_tab_2_text = "Maio"; }
    if($month_tab_2 == "06"){ $month_tab_2_text = "Junho"; }
    if($month_tab_2 == "07"){ $month_tab_2_text = "Julho"; }
    if($month_tab_2 == "08"){ $month_tab_2_text = "Agosto"; }
    if($month_tab_2 == "09"){ $month_tab_2_text = "Setembro"; }
    if($month_tab_2 == "10"){ $month_tab_2_text = "Outubro"; }
    if($month_tab_2 == "11"){ $month_tab_2_text = "Novembro"; }
    if($month_tab_2 == "12"){ $month_tab_2_text = "Dezembro"; }

    if($status_tab_2 == "all"){ $status_tab_2_text = "Todos"; }
    if($status_tab_2 == "0"){ $status_tab_2_text = "Atrasados"; }
    if($status_tab_2 == "1"){ $status_tab_2_text = "Em aberto"; }
    if($status_tab_2 == "2"){ $status_tab_2_text = "Pagos"; }

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

    <div class="box-tab-content active" id="tab-content-2">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_2_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=2&month_tab_2=01&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=2&month_tab_2=02&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=2&month_tab_2=03&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Março</a>
                <a href="?tab_select=2&month_tab_2=04&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=2&month_tab_2=05&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=2&month_tab_2=06&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=2&month_tab_2=07&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=2&month_tab_2=08&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=2&month_tab_2=09&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=2&month_tab_2=10&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=2&month_tab_2=11&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=2&month_tab_2=12&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_2; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2020&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2020</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2019&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2019</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2018&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2018</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2017&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2017</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2016&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2016</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2015&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2015</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2014&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2014</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2013&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2013</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2012&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2012</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2011&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2011</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=2010&status_tab_2=<?= $status_tab_2; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_2_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=all" class="item-filter">Todos</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=2&month_tab_2=<?= $month_tab_2; ?>&year_tab_2=<?= $year_tab_2; ?>&status_tab_2=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <div class="box-file add client btn-add-taxe" data-toggle="modal" data-target="#add_taxe_accountant">
                <i class="material-icons-outlined">add</i>
                <span class="date"></span>
                <span class="title" style="color: #999;">Adicionar <br>imposto a pagar</span>
            </div>

            <?php $x=0; foreach ($all_taxes as $taxe) { $x++; ?>

                <?php
                    if($taxe->maturity < $date_now){
                        $status_active = "atrasado";
                        $status_icon = "error_outline";
                    }else{
                        $status_active = "";
                        $status_icon = "outlined_flag";
                    }

                    if($taxe->status == 2){
                        $status_active = "pago";
                        $status_icon = "check_circle_outline";
                    }
                ?>

                <div class="box-file client <?= $status_active; ?> btn-open-taxe" data-id="<?= $taxe->id; ?>">
                    <i class="material-icons-outlined"><?= $status_icon; ?></i>
                    <span class="date"><?= date_format($taxe->maturity, 'd/m/Y'); ?></span>
                    <span class="title"><?= $taxe->title; ?></span>
                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <!-- <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum imposto a pagar.</span>
                </div> -->

            <?php } ?>

            <div class="clear"></div>

        </div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<?php
    echo $this->element('sidebar_timeline');
?>
