
<?php 
    echo $this->element('open_note_accountant');
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

    // TAB 3
    if($month_tab_3 == "01"){ $month_tab_3_text = "Janeiro"; }
    if($month_tab_3 == "02"){ $month_tab_3_text = "Fevereiro"; }
    if($month_tab_3 == "03"){ $month_tab_3_text = "Março"; }
    if($month_tab_3 == "04"){ $month_tab_3_text = "Abril"; }
    if($month_tab_3 == "05"){ $month_tab_3_text = "Maio"; }
    if($month_tab_3 == "06"){ $month_tab_3_text = "Junho"; }
    if($month_tab_3 == "07"){ $month_tab_3_text = "Julho"; }
    if($month_tab_3 == "08"){ $month_tab_3_text = "Agosto"; }
    if($month_tab_3 == "09"){ $month_tab_3_text = "Setembro"; }
    if($month_tab_3 == "10"){ $month_tab_3_text = "Outubro"; }
    if($month_tab_3 == "11"){ $month_tab_3_text = "Novembro"; }
    if($month_tab_3 == "12"){ $month_tab_3_text = "Dezembro"; }

    if($status_tab_3 == "all"){ $status_tab_3_text = "Todos"; }
    if($status_tab_3 == "0"){ $status_tab_3_text = "Atrasados"; }
    if($status_tab_3 == "1"){ $status_tab_3_text = "Em aberto"; }
    if($status_tab_3 == "2"){ $status_tab_3_text = "Pagos"; }

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

    <div class="box-tab-content active" id="tab-content-3">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_3_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=3&month_tab_3=01&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=3&month_tab_3=02&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=3&month_tab_3=03&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Março</a>
                <a href="?tab_select=3&month_tab_3=04&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=3&month_tab_3=05&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=3&month_tab_3=06&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=3&month_tab_3=07&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=3&month_tab_3=08&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=3&month_tab_3=09&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=3&month_tab_3=10&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=3&month_tab_3=11&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=3&month_tab_3=12&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_3; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2020&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2020</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2019&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2019</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2018&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2018</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2017&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2017</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2016&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2016</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2015&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2015</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2014&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2014</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2013&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2013</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2012&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2013</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2011&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2011</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=2010&status_tab_3=<?= $status_tab_3; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_3_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=all" class="item-filter">Todos</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=3&month_tab_3=<?= $month_tab_3; ?>&year_tab_3=<?= $year_tab_3; ?>&status_tab_3=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <?php $x=0; foreach ($all_notes as $note) { $x++; ?>

                <div class="box-file client btn-open-note" data-id="<?= $note->id; ?>">
                    <i class="material-icons-outlined">book</i>
                    <span class="date"><?= date_format($note->date, 'd/m/Y'); ?></span>
                    <span class="title"><?= $note->title; ?></span>
                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhuma nota fiscal.</span>
                </div>

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
