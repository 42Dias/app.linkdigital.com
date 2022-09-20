
<?php 
    echo $this->element('add_group_task_accountant');
    echo $this->element('add_task_accountant');
    echo $this->element('add_taxe_accountant');
    echo $this->element('add_document_accountant');

    echo $this->element('open_task_fixed_accountant');
    echo $this->element('open_task_accountant');
    echo $this->element('open_taxe_accountant');
    echo $this->element('open_note_accountant');
    echo $this->element('open_extract_accountant');
    echo $this->element('open_document_accountant');
    
    // echo $this->element('open_expenses_receipt_accountant');
?>

<link href='/tools/calendar/packages/core/main.css' rel='stylesheet' />
<link href='/tools/calendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='/tools/calendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='/tools/calendar/packages/list/main.css' rel='stylesheet' />
<script src='/tools/calendar/packages/core/main.js'></script>
<script src='/tools/calendar/packages/interaction/main.js'></script>
<script src='/tools/calendar/packages/daygrid/main.js'></script>
<script src='/tools/calendar/packages/timegrid/main.js'></script>
<script src='/tools/calendar/packages/list/main.js'></script>
<script src='/tools/calendar/packages/core/locales/pt-br.js'></script>

<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      height: 'parent',
      locale: 'pt-br',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      defaultView: 'dayGridMonth',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: false, // allow "more" link when too many events
      events: [

        <?php
            foreach ($all_tasks_fixed as $task) {

                $status_task = 'event-task-default';

                // None
                if($task->type == "none"){

                    if($task->maturity < $date_now && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Diary
                if($task->type == "diary"){
                    if($task->maturity < $date_now && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Week
                if($task->type == "week"){

                    if(date_format($date_now, 'N') < 6 && date_format($date_now, 'N') > $task->week && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Month
                if($task->type == "month"){

                    if(date_format($date_now, 'j') > $task->day && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Yearly
                if($task->type == "yearly"){

                    if(date_format($date_now, 'j') > $task->day && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }

                    if(date_format($date_now, 'n') <= $task->month && $task->status == 1){
                        if(date_format($date_now, 'j') > $task->day){
                            $status_task = 'event-task-pending';
                        }
                    }else{
                        $status_task = 'event-task-pending';
                    }
                }

                // if($task->status == 0){
                //     $status_task = 'event-task-completed';
                // }

                echo "{\n";
                echo "id: '".$task->id."',\n";
                echo "title: '".$task->title."',\n";
                echo "classNames: '".$status_task."',\n";
                echo "start: '".date_format($task->maturity, 'Y-m-d')."',\n";
                echo "},"."\n";
            }
        ?>
      ],

        eventClick: function(info) {

            $('#open_task_accountant').modal('show');
            $('.item-tasks').css("display", "none");

            var item_open = info.event.id;
            $('#item-tasks-' + item_open).css("display", "block");
        }
    });

    calendar.render();
  });

</script>

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

    // TAB 4
    if($month_tab_4 == "01"){ $month_tab_4_text = "Janeiro"; }
    if($month_tab_4 == "02"){ $month_tab_4_text = "Fevereiro"; }
    if($month_tab_4 == "03"){ $month_tab_4_text = "Março"; }
    if($month_tab_4 == "04"){ $month_tab_4_text = "Abril"; }
    if($month_tab_4 == "05"){ $month_tab_4_text = "Maio"; }
    if($month_tab_4 == "06"){ $month_tab_4_text = "Junho"; }
    if($month_tab_4 == "07"){ $month_tab_4_text = "Julho"; }
    if($month_tab_4 == "08"){ $month_tab_4_text = "Agosto"; }
    if($month_tab_4 == "09"){ $month_tab_4_text = "Setembro"; }
    if($month_tab_4 == "10"){ $month_tab_4_text = "Outubro"; }
    if($month_tab_4 == "11"){ $month_tab_4_text = "Novembro"; }
    if($month_tab_4 == "12"){ $month_tab_4_text = "Dezembro"; }

    if($status_tab_4 == "all"){ $status_tab_4_text = "Todos"; }
    if($status_tab_4 == "0"){ $status_tab_4_text = "Atrasados"; }
    if($status_tab_4 == "1"){ $status_tab_4_text = "Em aberto"; }
    if($status_tab_4 == "2"){ $status_tab_4_text = "Pagos"; }

    // TAB 5
    if($month_tab_5 == "01"){ $month_tab_5_text = "Janeiro"; }
    if($month_tab_5 == "02"){ $month_tab_5_text = "Fevereiro"; }
    if($month_tab_5 == "03"){ $month_tab_5_text = "Março"; }
    if($month_tab_5 == "04"){ $month_tab_5_text = "Abril"; }
    if($month_tab_5 == "05"){ $month_tab_5_text = "Maio"; }
    if($month_tab_5 == "06"){ $month_tab_5_text = "Junho"; }
    if($month_tab_5 == "07"){ $month_tab_5_text = "Julho"; }
    if($month_tab_5 == "08"){ $month_tab_5_text = "Agosto"; }
    if($month_tab_5 == "09"){ $month_tab_5_text = "Setembro"; }
    if($month_tab_5 == "10"){ $month_tab_5_text = "Outubro"; }
    if($month_tab_5 == "11"){ $month_tab_5_text = "Novembro"; }
    if($month_tab_5 == "12"){ $month_tab_5_text = "Dezembro"; }

    if($status_tab_5 == "all"){ $status_tab_5_text = "Todos"; }
    if($status_tab_5 == "0"){ $status_tab_5_text = "Atrasados"; }
    if($status_tab_5 == "1"){ $status_tab_5_text = "Em aberto"; }
    if($status_tab_5 == "2"){ $status_tab_5_text = "Pagos"; }

    // TAB 6
    if($month_tab_6 == "01"){ $month_tab_6_text = "Janeiro"; }
    if($month_tab_6 == "02"){ $month_tab_6_text = "Fevereiro"; }
    if($month_tab_6 == "03"){ $month_tab_6_text = "Março"; }
    if($month_tab_6 == "04"){ $month_tab_6_text = "Abril"; }
    if($month_tab_6 == "05"){ $month_tab_6_text = "Maio"; }
    if($month_tab_6 == "06"){ $month_tab_6_text = "Junho"; }
    if($month_tab_6 == "07"){ $month_tab_6_text = "Julho"; }
    if($month_tab_6 == "08"){ $month_tab_6_text = "Agosto"; }
    if($month_tab_6 == "09"){ $month_tab_6_text = "Setembro"; }
    if($month_tab_6 == "10"){ $month_tab_6_text = "Outubro"; }
    if($month_tab_6 == "11"){ $month_tab_6_text = "Novembro"; }
    if($month_tab_6 == "12"){ $month_tab_6_text = "Dezembro"; }

    if($status_tab_6 == "all"){ $status_tab_6_text = "Todos"; }
    if($status_tab_6 == "0"){ $status_tab_6_text = "Atrasados"; }
    if($status_tab_6 == "1"){ $status_tab_6_text = "Em aberto"; }
    if($status_tab_6 == "2"){ $status_tab_6_text = "Pagos"; }

        // TAB 8
        if($month_tab_8 == "01"){ $month_tab_8_text = "Janeiro"; }
        if($month_tab_8 == "02"){ $month_tab_8_text = "Fevereiro"; }
        if($month_tab_8 == "03"){ $month_tab_8_text = "Março"; }
        if($month_tab_8 == "04"){ $month_tab_8_text = "Abril"; }
        if($month_tab_8 == "05"){ $month_tab_8_text = "Maio"; }
        if($month_tab_8 == "06"){ $month_tab_8_text = "Junho"; }
        if($month_tab_8 == "07"){ $month_tab_8_text = "Julho"; }
        if($month_tab_8 == "08"){ $month_tab_8_text = "Agosto"; }
        if($month_tab_8 == "09"){ $month_tab_8_text = "Setembro"; }
        if($month_tab_8 == "10"){ $month_tab_8_text = "Outubro"; }
        if($month_tab_8 == "11"){ $month_tab_8_text = "Novembro"; }
        if($month_tab_8 == "12"){ $month_tab_8_text = "Dezembro"; }
    
        if($status_tab_8 == "all"){ $status_tab_8_text = "Todos"; }
        if($status_tab_8 == "0"){ $status_tab_8_text = "Atrasados"; }
        if($status_tab_8 == "1"){ $status_tab_8_text = "Em aberto"; }
        if($status_tab_8 == "2"){ $status_tab_8_text = "Pagos"; }

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
<div style="background-color: #fff; padding: 40px; padding-right: 330px; min-height: 800px;">

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

                      <?php foreach ($all_users as $user) { ?>
                          <?php if($user->id == $business->accountant_id){ echo $user->name." ".$user->lastname; } ?></a>
                      <?php } ?>

                        <?php if($business->accountant_id == 0){ echo "Nenhum"; } ?>

                      &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">

                          <?php foreach ($all_users as $user) { ?>
                              <a href="#" class="item-filter"><?= $user->name." ".$user->lastname; ?></a>
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
                          <a href="#" data-status="1" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Lead</a>
                          <a href="#" data-status="2" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Em abertura</a>
                          <a href="#" data-status="3" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Em migração</a>
                          <a href="#" data-status="4" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Ativo</a>
                          <a href="#" data-status="5" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Inativo</a>
                          <a href="#" data-status="6" data-id="<?php echo $business->id; ?>" class="update-status-admin item-filter">Cancelado</a>
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
        <a href="?tab_select=1" class="tab-item <?php if($tab_select == "all" || $tab_select == 1){ echo "active"; } ?>" data-open="#tab-content-1">Obrigações</a>
        <a href="?tab_select=2" class="tab-item <?php if($tab_select == 2){ echo "active"; } ?>" data-open="#tab-content-2">Impostos a pagar</a>
        <a href="?tab_select=3" class="tab-item <?php if($tab_select == 3){ echo "active"; } ?>" data-open="#tab-content-3">Notas fiscais</a>
        <a href="?tab_select=4" class="tab-item <?php if($tab_select == 4){ echo "active"; } ?>" data-open="#tab-content-4">Extratos</a>
        <a href="?tab_select=5" class="tab-item <?php if($tab_select == 5){ echo "active"; } ?>" data-open="#tab-content-5">Documentos</a>
        <!-- <a href="?tab_select=8" class="tab-item <?php if($tab_select == 8){ echo "active"; } ?>" data-open="#tab-content-5">Despesas e Receitas</a> -->
        <a href="?tab_select=6" class="tab-item <?php if($tab_select == 6){ echo "active"; } ?>" data-open="#tab-content-6">Faturas</a>
        <a href="?tab_select=7" class="tab-item <?php if($tab_select == 7){ echo "active"; } ?>" data-open="#tab-content-7">Informações</a>
        <div class="clear"></div>
    </div>

    <!-- CONTENTS -->
    <div class="box-tab-content <?php if($tab_select == "all" || $tab_select == 1){ echo "active"; } ?>" id="tab-content-1">

        <!-- CALENDAR -->
        <br>
        <div id='calendar' style='z-index: 0;'></div>

    </div>

    <div class="box-tab-content <?php if($tab_select == 2){ echo "active"; } ?>" id="tab-content-2">

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

    <div class="box-tab-content <?php if($tab_select == 3){ echo "active"; } ?>" id="tab-content-3">

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

    <div class="box-tab-content <?php if($tab_select == 4){ echo "active"; } ?>" id="tab-content-4">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_4_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=4&month_tab_4=01&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=4&month_tab_4=02&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=4&month_tab_4=03&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Março</a>
                <a href="?tab_select=4&month_tab_4=04&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=4&month_tab_4=05&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=4&month_tab_4=06&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=4&month_tab_4=07&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=4&month_tab_4=08&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=4&month_tab_4=09&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=4&month_tab_4=10&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=4&month_tab_4=11&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=4&month_tab_4=12&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_4; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2020&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2020</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2019&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2019</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2018&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2018</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2017&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2017</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2016&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2016</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2015&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2015</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2014&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2014</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2013&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2013</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2012&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2013</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2011&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2011</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=2010&status_tab_4=<?= $status_tab_4; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_4_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=all" class="item-filter">Todos</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=4&month_tab_4=<?= $month_tab_4; ?>&year_tab_4=<?= $year_tab_4; ?>&status_tab_4=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <?php $x=0; foreach ($all_extracts as $extract) { $x++; ?>

            <?php
                if(date_format($extract->date_inicial, 'm') == "01"){ $extract_month = "Janeiro"; }
                if(date_format($extract->date_inicial, 'm') == "02"){ $extract_month = "Fevereiro"; }
                if(date_format($extract->date_inicial, 'm') == "03"){ $extract_month = "Março"; }
                if(date_format($extract->date_inicial, 'm') == "04"){ $extract_month = "Abril"; }
                if(date_format($extract->date_inicial, 'm') == "05"){ $extract_month = "Maio"; }
                if(date_format($extract->date_inicial, 'm') == "06"){ $extract_month = "Junho"; }
                if(date_format($extract->date_inicial, 'm') == "07"){ $extract_month = "Julho"; }
                if(date_format($extract->date_inicial, 'm') == "08"){ $extract_month = "Agosto"; }
                if(date_format($extract->date_inicial, 'm') == "09"){ $extract_month = "Setembro"; }
                if(date_format($extract->date_inicial, 'm') == "10"){ $extract_month = "Outubro"; }
                if(date_format($extract->date_inicial, 'm') == "11"){ $extract_month = "Novembro"; }
                if(date_format($extract->date_inicial, 'm') == "12"){ $extract_month = "Dezembro"; }
            ?>

                <div class="box-file client btn-open-extract" data-id="<?= $extract->id; ?>">
                    <i class="material-icons-outlined">description</i>
                    <span class="date"><?php echo $extract_month; ?></span>
                    <span class="title"><?= date_format($extract->date_inicial, 'd/m/Y'); ?></span>
                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum extrato bancário.</span>
                </div>

            <?php } ?>

            <div class="clear"></div>

        </div>

    </div>

    <div class="box-tab-content <?php if($tab_select == 5){ echo "active"; } ?>" id="tab-content-5">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_5_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=5&month_tab_5=01&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=5&month_tab_5=02&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=5&month_tab_5=03&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Março</a>
                <a href="?tab_select=5&month_tab_5=04&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=5&month_tab_5=05&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=5&month_tab_5=06&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=5&month_tab_5=07&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=5&month_tab_5=08&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=5&month_tab_5=09&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=5&month_tab_5=10&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=5&month_tab_5=11&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=5&month_tab_5=12&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_5; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2020&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2020</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2019&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2019</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2018&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2018</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2017&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2017</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2016&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2016</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2015&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2015</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2014&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2014</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2013&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2013</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2012&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2013</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2011&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2011</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=2010&status_tab_5=<?= $status_tab_5; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_5_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=all" class="item-filter">Todos</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=5&month_tab_5=<?= $month_tab_5; ?>&year_tab_5=<?= $year_tab_5; ?>&status_tab_5=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_document_accountant">
                <i class="material-icons-outlined">add</i>
                <span class="date"></span>
                <span class="title" style="color: #999;">Adicionar <br>novo documento</span>
            </div>

            <?php $x=0; foreach ($all_documents as $document) { $x++; ?>

                <div class="box-file client btn-open-document" data-id="<?= $document->id; ?>">
                    <i class="material-icons-outlined">folder</i>
                    <span class="date"><?= date_format($document->date, 'd/m/Y'); ?></span>
                    <span class="title"><?= $document->title; ?></span>
                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <!-- <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhum documento.</span>
                </div> -->

            <?php } ?>

            <div class="clear"></div>

        </div>

    </div>

    <div class="box-tab-content <?php if($tab_select == 6){ echo "active"; } ?>" id="tab-content-6">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_6_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=6&month_tab_6=01&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=6&month_tab_6=02&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=6&month_tab_6=03&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Março</a>
                <a href="?tab_select=6&month_tab_6=04&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=6&month_tab_6=05&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=6&month_tab_6=06&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=6&month_tab_6=07&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=6&month_tab_6=08&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=6&month_tab_6=09&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=6&month_tab_6=10&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=6&month_tab_6=11&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=6&month_tab_6=12&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_6; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2020&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2020</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2019&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2019</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2018&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2018</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2017&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2017</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2016&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2016</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2015&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2015</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2014&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2014</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2013&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2013</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2012&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2013</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2011&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2011</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=2010&status_tab_6=<?= $status_tab_6; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_6_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=all" class="item-filter">Todos</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=6&month_tab_6=<?= $month_tab_6; ?>&year_tab_6=<?= $year_tab_6; ?>&status_tab_6=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <?php $x=0; foreach ($all_invoices as $invoice) { $x++; ?>

                <div class="box-file client btn-open-note" data-id="<?= $invoice->id; ?>">
                    <i class="material-icons-outlined">description</i>
                    <span class="date"><?= date_format($invoice->maturity, 'd/m/Y'); ?></span>
                    <span class="title">Fatura #<?= $invoice->code; ?></span>
                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                    <i class="material-icons-outlined icon-empty">all_inclusive</i>
                    <span class="title" style="font-size: 12px;">O cliente não possui nenhuma fatura.</span>
                </div>

            <?php } ?>

            <div class="clear"></div>

        </div>

    </div>

    <div class="box-tab-content <?php if($tab_select == 7){ echo "active"; } ?>" id="tab-content-7">

        <form id="form_step_1" method="POST" style="padding: 0; margin-top: 30px;">

            <div class="accordion" id="infosBusiness">

                <!-- CARD 0 -->
                <div class="card">
                    <div class="card-header" id="head-0">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-0" aria-expanded="true" aria-controls="collapse-0">
                            Serviços contratados
                        </div>
                    </div>

                    <div id="collapse-0" class="collapse" aria-labelledby="head-0" data-parent="#infosBusiness">
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

                <!-- CARD 1 -->
                <div class="card">
                    <div class="card-header" id="head-1">
                        <div class="accordion-item" data-toggle="collapse" data-target="#collapse-1" aria-expanded="false" aria-controls="collapse-1">
                            Informações do contrato
                        </div>
                    </div>

                    <div id="collapse-1" class="collapse" aria-labelledby="head-1" data-parent="#infosBusiness">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Mensalidade</p>
                                    <strong style="color: #32dc4f; font-size: 24px;">R$ <?php echo number_format($total_month, 2, ',', '.'); ?></strong>
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
                                    <strong style="color: #666;"><?php if($business->terms_date != ""){ echo date_format($business->sign_date, 'd/m/Y')." às ".date_format($business->sign_date, 'h:i'); } ?></strong>
                                </div>

                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 text-left animate-scroll">
                                    <p class="text margin-t-20" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Termos assinado em</p>
                                    <strong style="color: #666;"><?php if($business->terms_date != ""){ echo date_format($business->terms_date, 'd/m/Y')." às ".date_format($business->terms_date, 'h:i'); } ?></strong>
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

                    <div id="collapse-2" class="collapse" aria-labelledby="head-2" data-parent="#infosBusiness">
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

                    <div id="collapse-3" class="collapse" aria-labelledby="head-3" data-parent="#infosBusiness">
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

                    <div id="collapse-4" class="collapse" aria-labelledby="head-4" data-parent="#infosBusiness">
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

    <div class="box-tab-content <?php if($tab_select == 8){ echo "active"; } ?>" id="tab-content-8">

        <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

        <div class="box-filter">
            <?= $month_tab_8_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=8&month_tab_8=01&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Janeiro</a>
                <a href="?tab_select=8&month_tab_8=02&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Fevereiro</a>
                <a href="?tab_select=8&month_tab_8=03&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Março</a>
                <a href="?tab_select=8&month_tab_8=04&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Abril</a>
                <a href="?tab_select=8&month_tab_8=05&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Maio</a>
                <a href="?tab_select=8&month_tab_8=06&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Junho</a>
                <a href="?tab_select=8&month_tab_8=07&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Julho</a>
                <a href="?tab_select=8&month_tab_8=08&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Agosto</a>
                <a href="?tab_select=8&month_tab_8=09&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Setembro</a>
                <a href="?tab_select=8&month_tab_8=10&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Outubro</a>
                <a href="?tab_select=8&month_tab_8=11&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Novembro</a>
                <a href="?tab_select=8&month_tab_8=12&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">Dezembro</a>
            </div>
        </div>

        <div class="box-filter">
            <?= $year_tab_8; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2019&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2019</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2018&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2018</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2017&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2017</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2016&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2016</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2015&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2015</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2014&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2014</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2013&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2013</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2012&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2013</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2011&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2011</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=2010&status_tab_8=<?= $status_tab_8; ?>" class="item-filter">2010</a>
            </div>
        </div>

        <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

        <div class="box-filter">
            <?= $status_tab_8_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
            <div class="space-itens"></div>

            <div class="itens-filter scroll-active">
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=all" class="item-filter">Todos</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=0" class="item-filter">Atrasados</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=1" class="item-filter">Em aberto</a>
                <a href="?tab_select=8&month_tab_8=<?= $month_tab_8; ?>&year_tab_8=<?= $year_tab_8; ?>&status_tab_8=2" class="item-filter">Pagos</a>
            </div>
        </div>

        <div class="clear"></div>

        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_document_accountant">
                <i class="material-icons-outlined">add</i>
                <span class="date"></span>
                <span class="title" style="color: #999;">Adicionar <br>nova despesa ou receita</span>
            </div>

            <?php $x=0; foreach ($all_expenses_receipt as $expenses_receipt) { $x++; ?>

                <div class="box-file client btn-open-documents-accountant" data-id="<?= $expenses_receipt->id; ?>">
                    <i class="material-icons-outlined">folder</i>
                    <span class="date"><?= date_format($expenses_receipt->date, 'd/m/Y'); ?></span>
                    <span class="title"><?= $expenses_receipt->name; ?></span>
                </div>
    
            <?php } ?>

            <?php if($x == 0){ ?>

            <?php } ?>

            <div class="clear"></div>

        </div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<!-- Sidebar -->
<div class="scroll-active" style="position: fixed; right: 0px; top: 0px; background-color: #f9f9f9; padding: 25px; padding-top: 100px; padding-right: 30px; width: 300px; height: 100%;">

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

        <a href="<?= $activity->link; ?>" class="box-activity client btn-open-note">
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
