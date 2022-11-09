
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        
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

<?php 
    echo $this->element('open_task_accountant');
?>


<!-- 
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
        height: 'parent',
        locale: 'pt-br',
        header: {
            // left: 'prev,next today',
            // center: 'title',
            right: 'prev,next,dayGridMonth,timeGridWeek,timeGridDay',
            left: 'title',
            center: ''
            // right: 'prev,next today'
        },
        defaultView: 'dayGridMonth',
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: false, // allow "more" link when too many events
        events: [
        ],

        eventClick: function(info) {

            
        }
        });

        calendar.render();
    });

</script> -->


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      height: 'parent',
      locale: 'pt-br',
      header: {
        // left: 'prev,next today',
        // center: 'title',
        right: 'prev,next,dayGridMonth,timeGridWeek,timeGridDay',
        left: 'title',
        center: ''
        // right: 'prev,next today'
      },
      defaultView: 'dayGridMonth',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: false, // allow "more" link when too many events
      events: [

        <?php
            
            foreach ($all_business as $business) {

                if($business->razao != ''){
                    $document_business = $business->razao;
                }else{
                    $document_business = $business->fantasia;
                }
                
                $service_business = $business->type;
                $taxation_business = $business->taxation;
                $action_business = $business->action;
                    
                $day_now = date_format($date_now, 'j');
                $week_now = date_format($date_now, 'N');
                $month_now = date_format($date_now, 'n');
                $year_now = date_format($date_now, 'Y');

                foreach ($all_tasks_fixed as $task) {

                    if($task->service == $service_business && $task->taxation == $taxation_business){

                        $day_maturity = $day_now;
                        $month_maturity = $month_now;
                        $year_maturity = $year_now;
                        
                        $one_view = false;
                        $status_task = 'event-task-default';

                        // Anual
                        if($task->type == "yearly"){

                            // Mês atual
                            if( $task->month == $month_now ){
                                $day_maturity = $task->day;
                                $month_maturity = $task->month;
                                $year_maturity = $year_now;
                                $one_view = true;
                            }
                            
                        }

                        // Trimestral
                        if($task->type == "quarterly"){


                            // Mês atual
                            if( $month_now == 3 || $month_now == 6 || $month_now == 9 || $month_now == 12 ){
                                $day_maturity = $task->day;
                                $month_maturity = $month_now;
                                $year_maturity = $year_now;
                                $one_view = true;
                            }

                        }

                        // Mensal
                        if($task->type == "monthly"){

                            // :::::::::::::::::::::::::
                            // Mês atual
                            $day_maturity = $task->day;
                            $month_maturity = $month_now;
                            $year_maturity = $year_now;
                            
                            if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                            if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }

                            // Verifica Sabado e Domingo
                            $verify_date = date('Y-m-d', strtotime($year_maturity."-".$month_maturity."-".$day_maturity. ' + 0 days'));
                            $verify_week = date('N', strtotime($verify_date));

                            // Sabado
                            if($verify_week == 6){
                                $verify_date = date('Y-m-d', strtotime($verify_date. ' - 1 days'));
                                $day_maturity = date('j', strtotime($verify_date));
                                $month_maturity = date('n', strtotime($verify_date));

                                // Exibição
                                if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                                if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }
                            }

                            // Domingo
                            if($verify_week == 7){
                                $verify_date = date('Y-m-d', strtotime($verify_date. ' - 2 days'));
                                $day_maturity = date('j', strtotime($verify_date));
                                $month_maturity = date('n', strtotime($verify_date));

                                // Exibição
                                if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                                if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }
                            }

                            // Verifica status
                            $status_task = 'event-task-default';

                            if(isset($list_date_tasks[$task->id][$year_maturity.$month_maturity.$day_maturity])){
                                if($list_status_tasks[$task->id] == 1 && $list_date_tasks[$task->id][$year_maturity.$month_maturity.$day_maturity] == 'ok'){
                                    $status_task = 'event-task-completed';
                                }
                            }

                            echo "{\n";
                            echo "id: '".$task->id."',\n";
                            echo "title: '".$document_business." - ".strval($task->title)."',\n";
                            echo "classNames: '".$status_task."',\n";
                            echo "start: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                            echo "extendedProps: {\n";
                                echo "date: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                            echo "}\n";
                            echo "},"."\n";

                            $one_view = false;

                        }

                        // Semanal
                        if($task->type == "weekly"){

                            $finish_weekly = false;
                            $month_begin = ($month_now - 1);
                            $month_end = ($month_now + 2);

                            if($month_begin < 10){ $month_begin = "0".$month_begin; }
                            if($month_end < 10){ $month_end = "0".$month_end; }

                            $date_begin = $year_now."-".$month_begin."-01";                   
                            $date_end = $year_now."-".$month_end."-01";

                            $date_active = date('Y-m-d', strtotime($date_begin. ' + 0 days'));

                            while($finish_weekly == false){

                                if($date_active >= $date_end){
                                    $finish_weekly = true;

                                }else{

                                    $day_active = date('j', strtotime($date_active));
                                    $week_active = date('N', strtotime($date_active));
                                    $month_active = date('n', strtotime($date_active));
                                    $year_active = date('Y', strtotime($date_active));
                                
                                    if($day_active < 10){ $day_active = "0".$day_active; }
                                    if($month_active < 10){ $month_active = "0".$month_active; }

                                    if($week_active == $task->week){

                                        // Verifica status
                                        $status_task = 'event-task-default';

                                        if(isset($list_date_tasks[$task->id][$year_active.$month_active.$day_active])){
                                            if($list_status_tasks[$task->id] == 1 && $list_date_tasks[$task->id][$year_active.$month_active.$day_active] == 'ok'){
                                                $status_task = 'event-task-completed';
                                            }
                                        }

                                        echo "{\n";
                                        echo "id: '".$task->id."',\n";
                                        echo "title: '".$document_business." - ".strval($task->title)."',\n";
                                        echo "classNames: '".$status_task."',\n";
                                        echo "start: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "extendedProps: {\n";
                                            echo "date: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "}\n";
                                        echo "},"."\n";
                                    }

                                    $date_active = date('Y-m-d', strtotime($date_active. ' + 1 days'));
                                }
                            }

                            $one_view = false;

                        }

                        // Diario
                        if($task->type == "diary"){

                            $finish_diary = false;
                            $month_begin = ($month_now - 1);
                            $month_end = ($month_now + 2);

                            if($month_begin < 10){ $month_begin = "0".$month_begin; }
                            if($month_end < 10){ $month_end = "0".$month_end; }

                            $date_begin = $year_now."-".$month_begin."-01";                   
                            $date_end = $year_now."-".$month_end."-01";

                            $date_active = date('Y-m-d', strtotime($date_begin. ' + 0 days'));

                            while($finish_diary == false){

                                if($date_active >= $date_end){
                                    $finish_diary = true;

                                }else{

                                    $day_active = date('j', strtotime($date_active));
                                    $week_active = date('N', strtotime($date_active));
                                    $month_active = date('n', strtotime($date_active));
                                    $year_active = date('Y', strtotime($date_active));
                                
                                    // Verifica data
                                    $verify_date = date('Y-m-d', strtotime($year_active."-".$month_active."-".$day_active. ' + 0 days'));
                                    $verify_week = date('N', strtotime($verify_date));

                                    // Verifica semana
                                    if($verify_week != 6 && $verify_week != 7){
                                        
                                        if($day_active < 10){ $day_active = "0".$day_active; }
                                        if($month_active < 10){ $month_active = "0".$month_active; }

                                        // Verifica status
                                        $status_task = 'event-task-default';

                                        if(isset($list_date_tasks[$task->id][$year_active.$month_active.$day_active])){
                                            if($list_status_tasks[$task->id] == 1 && $list_date_tasks[$task->id][$year_active.$month_active.$day_active] == 'ok'){
                                                $status_task = 'event-task-completed';
                                            }
                                        }

                                        echo "{\n";
                                        echo "id: '".$task->id."',\n";
                                        echo "title: '".$document_business." - ".strval($task->title)."',\n";
                                        echo "classNames: '".$status_task."',\n";
                                        echo "start: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "extendedProps: {\n";
                                            echo "date: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "}\n";
                                        echo "},"."\n";
                                    }

                                    $date_active = date('Y-m-d', strtotime($date_active. ' + 1 days'));
                                }
                            }

                            $one_view = false;

                        }

                        // Data fixa
                        if($task->type == "fixed"){

                            $finish_fixed = false;
                            $month_begin = ($month_now - 1);
                            $month_end = ($month_now + 2);

                            if($month_begin < 10){ $month_begin = "0".$month_begin; }
                            if($month_end < 10){ $month_end = "0".$month_end; }

                            $date_begin = $year_now."-".$month_begin."-01";                   
                            $date_end = $year_now."-".$month_end."-01";

                            $date_active = date('Y-m-d', strtotime($date_begin. ' + 0 days'));

                            while($finish_fixed == false){

                                if($date_active >= $date_end){
                                    $finish_fixed = true;

                                }else{

                                    $day_active = date('j', strtotime($date_active));
                                    $week_active = date('N', strtotime($date_active));
                                    $month_active = date('n', strtotime($date_active));
                                    $year_active = date('Y', strtotime($date_active));
                                
                                    // Verifica data
                                    if($date_active == date_format($task->maturity, 'Y-m-d')){

                                        // Verifica Sabado e Domingo
                                        $verify_date = date('Y-m-d', strtotime($year_active."-".$month_active."-".$day_active. ' + 0 days'));
                                        $verify_week = date('N', strtotime($verify_date));

                                        // Sabado
                                        if($verify_week == 6){
                                            $verify_date = date('Y-m-d', strtotime($verify_date. ' - 1 days'));
                                            $day_active = date('j', strtotime($verify_date));
                                            $month_active = date('n', strtotime($verify_date));

                                            // Exibição
                                            if($day_active < 10){ $day_active = "0".$day_active; }
                                            if($month_active < 10){ $month_active = "0".$month_active; }
                                        }

                                        // Domingo
                                        if($verify_week == 7){
                                            $verify_date = date('Y-m-d', strtotime($verify_date. ' - 2 days'));
                                            $day_active = date('j', strtotime($verify_date));
                                            $month_active = date('n', strtotime($verify_date));

                                            // Exibição
                                            if($day_active < 10){ $day_active = "0".$day_active; }
                                            if($month_active < 10){ $month_active = "0".$month_active; }
                                        }

                                        // Verifica status
                                        $status_task = 'event-task-default';
                                        
                                        if(isset($list_date_tasks[$task->id][$year_active.$month_active.$day_active])){
                                            if($list_status_tasks[$task->id] == 1 && $list_date_tasks[$task->id][$year_active.$month_active.$day_active] == 'ok'){
                                                $status_task = 'event-task-completed';
                                            }
                                        }

                                        echo "{\n";
                                        echo "id: '".$task->id."',\n";
                                        echo "title: '".$document_business." - ".strval($task->title)."',\n";
                                        echo "classNames: '".$status_task."',\n";
                                        echo "start: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "extendedProps: {\n";
                                            echo "date: '".$year_active."-".$month_active."-".$day_active."',\n";
                                        echo "}\n";
                                        echo "},"."\n";
                                    }

                                    $date_active = date('Y-m-d', strtotime($date_active. ' + 1 days'));
                                }
                            }

                            $one_view = false;

                        }
                        
                        // Visualização unica
                        if($one_view == true){

                            // Exibição
                            if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                            if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }

                            // Verifica Sabado e Domingo
                            $verify_date = date('Y-m-d', strtotime($year_maturity."-".$month_maturity."-".$day_maturity. ' + 0 days'));
                            $verify_week = date('N', strtotime($verify_date));

                            // Sabado
                            if($verify_week == 6){
                                $verify_date = date('Y-m-d', strtotime($verify_date. ' - 1 days'));
                                $day_maturity = date('j', strtotime($verify_date));
                                $month_maturity = date('n', strtotime($verify_date));

                                // Exibição
                                if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                                if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }
                            }

                            // Domingo
                            if($verify_week == 7){
                                $verify_date = date('Y-m-d', strtotime($verify_date. ' - 2 days'));
                                $day_maturity = date('j', strtotime($verify_date));
                                $month_maturity = date('n', strtotime($verify_date));

                                // Exibição
                                if($day_maturity < 10){ $day_maturity = "0".$day_maturity; }
                                if($month_maturity < 10){ $month_maturity = "0".$month_maturity; }
                            }

                            // Verifica status
                            $status_task = 'event-task-default';

                            if(isset($list_date_tasks[$task->id][$year_maturity.$month_maturity.$day_maturity])){
                                if($list_status_tasks[$task->id] == 1 && $list_date_tasks[$task->id][$year_maturity.$month_maturity.$day_maturity] == 'ok'){
                                    $status_task = 'event-task-completed';
                                }
                            }

                            echo "{\n";
                            echo "id: '".$task->id."',\n";
                            echo "title: '".$document_business." - ".strval($task->title)."',\n";
                            echo "classNames: '".$status_task."',\n";
                            echo "start: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                            echo "extendedProps: {\n";
                                echo "date: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                            echo "}\n";
                            echo "},"."\n";
                        }
                    }
                }
            }

        ?>
      ],

        eventClick: function(info) {

            $('#open_task_accountant').modal('show');

            var task_business_id = 1;
            var task_fixed_id = info.event.id;
            var task_date = info.event.extendedProps.date;

            var task_year = task_date.substr(0, 4);
            var task_month = task_date.substr(5, 2);
            var task_day = task_date.substr(8, 2);

            task_date = task_year + task_month + task_day;

            // Open Task
            $.ajax({
                'url': "/api/web/accountant/tasks/" + task_fixed_id + "/view",
                'type': 'POST',
                'dataType': 'json',
                beforeSend: function () {
                    $('.box-loading').show();
                    $('#task_title').html('');
                    $('#task_description').html('');
                    $('#task_maturity').html('');
                },
                complete: function () {
                },
                success: function (data) {
                    

                    if (data.result.status == "ok"){

                        var date_now = new Date();
                        var status_task = data.result.status_task;
                        var id_task = data.result.id_task;
                        var title = data.result.title;
                        var description = data.result.description;
                        var maturity = new Date(data.result.maturity);
                        var type = data.result.type;
                        var week = data.result.week;
                        var month = data.result.month;
                        var day = data.result.day;
                        var month_text = '';

                        if(status_task == 0){
                            $('#task_button_close').css('display', 'inline-block');
                            $('#task_button_open').css('display', 'none');

                            $('#task_button_close').data('url', '/api/web/accountant/tasks/' + task_business_id + '/' + task_fixed_id + '/' + task_date + '/close');

                        }else{
                            $('#task_button_open').css('display', 'inline-block');
                            $('#task_button_close').css('display', 'none');

                            $('#task_button_open').data('url', '/api/web/accountant/tasks/' + task_business_id + '/' + id_task + '/' + task_date + '/open');
                        }

                        $('#task_title').html(title);
                        $('#task_description').html(description);

                        if(type == "fixed"){

                            if(maturity < date_now){
                                $('#task_badge').html('<div class="badge-status relative">ATRASADA</div><br><br>');
                            }else{
                                $('#task_badge').html('');
                            }

                            $('#task_badge').html('');
                            $('#task_maturity').html(maturity.getDate() + '/' + (maturity.getMonth() + 1) + '/' + maturity.getFullYear());
                        }

                        if(type == "diary"){

                            $('#task_badge').html('');
                            $('#task_maturity').html('Todo dia');
                        }

                        if(type == "weekly"){
                            
                            if(date_now.getDay() < 6 && date_now.getDay() > week){
                                $('#task_badge').html('<div class="badge-status relative">ATRASADA</div><br><br>');
                            }else{
                                $('#task_badge').html('');
                            }

                            if(week == 1){ $('#task_maturity').html("Segunda-feira"); }
                            if(week == 2){ $('#task_maturity').html("Terça-feira"); }
                            if(week == 3){ $('#task_maturity').html("Quarta-feira"); }
                            if(week == 4){ $('#task_maturity').html("Quinta-feira"); }
                            if(week == 5){ $('#task_maturity').html("Sexta-feira"); }
                        }

                        if(type == "monthly"){

                            if(date_now.getDate() > day){
                                $('#task_badge').html('<div class="badge-status relative">ATRASADA</div><br><br>');
                            }else{
                                $('#task_badge').html('');
                            }

                            $('#task_maturity').html("Dia " + day);
                        }

                        if(type == "yearly"){

                            if((date_now.getMonth() + 1) <= month){
                                if(date_now.getDate() > day){
                                    $('#task_badge').html('<div class="badge-status relative">ATRASADA</div><br><br>');
                                }else{
                                    $('#task_badge').html('');
                                }
                            }else{
                                $('#task_badge').html('<div class="badge-status relative">ATRASADA</div><br><br>');
                            }

                            if(month == 1){ month_text = "Janeiro"; }
                            if(month == 2){ month_text = "Fevereiro"; }
                            if(month == 3){ month_text = "Março"; }
                            if(month == 4){ month_text = "Abril"; }
                            if(month == 5){ month_text = "Maio"; }
                            if(month == 6){ month_text = "Junho"; }
                            if(month == 7){ month_text = "Julho"; }
                            if(month == 8){ month_text = "Agosto"; }
                            if(month == 9){ month_text = "Setembro"; }
                            if(month == 10){ month_text = "Outubro"; }
                            if(month == 11){ month_text = "Novembro"; }
                            if(month == 12){ month_text = "Dezembro"; }

                            $('#task_maturity').html(month_text + " - Dia " + day);
                        }

                        $(".box-loading").hide();

                    }else{
                        alert(data.result.status);
                    }
                }
            });

        }
    });

    calendar.render();
  });

</script>

<!-- Menu Page -->
<div class="menu-page">

    <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            <span class="title-page">Visão geral</span>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <form id="form-filter-dashboard" action="/client" method="POST">

                <input type="submit" class="btn btn-line-gray size-sm" style="display: block; float: right; margin-left: 10px; padding: 15px 25px;" value="FILTRAR">                        

                <?php

                    if($date_end_input == ""){
                        $date = date_format($date_now, 'd/m/Y');
                        $date_end = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);
                    }else{
                        $date = $date_end_input;
                        $date_end = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);
                    }

                ?>

                <div class="input-date1" style='width: 150px; float: right;'>
                    <div class="icon ion-android-calendar arrow"></div>

                    <input type="text" class="form-control add-date" name="date_end"
                    value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-end">

                    <!-- Datepicker -->
                    <div class="box-datepicker1 client" style="top: 0px !important; left: -130px !important;">
                        <div class="datepicker1" data-date="<?= h($date_end); ?>" data-id="#date-report-end"></div>
                    </div>

                </div>

                <?php

                    if($date_begin_input == ""){
                        $date = '01'.date_format($date_now, '/m/Y');
                        $date_begin = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);
                    }else{
                        $date = $date_begin_input;
                        $date_begin = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);
                    }

                ?>

                <div class="input-date" style='width: 150px; float: right; margin-right: 10px;'>
                    <div class="icon ion-android-calendar arrow"></div>

                    <input type="text" class="form-control add-date" name="date_begin"
                    value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-begin">

                    <!-- Datepicker -->
                    <div class="box-datepicker client" style="top: 0px !important; left: -130px !important;">
                        <div class="datepicker" data-date="<?= h($date_begin); ?>" data-id="#date-report-begin"></div>
                    </div>

                </div>

                <div class="clear"></div>

            </form>

        </div>
    </div>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- EMITIR NF -->
    <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            
            <div class="box-white size-xs" style="background-color: #ffcc00; border: 1px solid #ffcc00;">

                <span class="title" style="font-size: 16px; font-weight: 600; color: #000;">
                    Agora você pode emitir suas notas fiscais!
                </span>
                <span class="title" style="color: #000; ">
                    Emita suas notas fiscais diretamente pela plataforma com muito mais agilidade.
                </span>

                <a href='/client/nf' class="btn btn-dark size-sm margin-t-20">
                    EMITIR NOTAS FISCAIS
                </a>

            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            
            <div class="box-white size-xs" style="background-color: #4c4c4c; border: 1px solid #4c4c4c;">

                <span class="title" style="font-size: 16px; font-weight: 600; color: #fff;">
                    Gerencie seu estoque de produtos!
                </span>
                <span class="title" style="color: #ababab; ">
                    Agora você consegue organizar e otimizar o controle do seu estoque.
                </span>

                <a href='/client/stock' class="btn btn-white size-sm margin-t-20">
                    GERENCIAR ESTOQUE
                </a>

            </div>
        </div>
    </div>
    
    <?php if($status_business == 2 || $status_business == 3){ ?>
    
        <!-- QUADROS -->
        <div class="row">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
                
                <div class="box-white size-xs" style="background-color: #fcf8e3; border: 1px solid #ffcc00;">
                    
                    <!-- Em abertura -->
                    <?php if($status_business == 2){ ?> 

                        <span class="title" style="font-size: 16px; font-weight: 600; color: #9e773e;">
                            Empresa em processo de abertura
                        </span>
                        <span class="title" style="color: #333; ">
                            Para que a Link inicie a abertura da sua empresa envie os documentos necessários.
                        </span>

                    <?php } ?>

                    <!-- Em migração -->
                    <?php if($status_business == 3){ ?> 

                        <span class="title" style="font-size: 16px; font-weight: 600; color: #9e773e;">
                            Empresa em processo de migração
                        </span>
                        <span class="title" style="color: #333; ">
                            Para que a Link inicie a migração da sua empresa envie os documentos necessários.
                        </span>

                    <?php } ?>

                    <a href='/client/business' class="btn btn-yellow size-sm margin-t-20" style="position: absolute; right: 30px; bottom: 25px;">
                        ENVIAR MEUS DOCUMENTOS
                    </a>

                </div>
            </div>
        </div>

    <?php } ?>

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">trending_up</i>
                <span class="title">Receitas</span>
                <span class="number green">R$ <?php echo number_format($total_receipt, 2, ',', '.'); ?></span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">description</i>
                <span class="title">Despesas</span>
                <span class="number dark">R$ <?php echo number_format(($total_payment * -1), 2, ',', '.'); ?></span>
            </div>
        </div>

        <?php
            $total_lucro = $total_receipt - ($total_payment * -1);
        ?>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">outlined_flag</i>
                <span class="title">Lucro x Prejuízo</span>

                <?php 
                    
                    if($total_lucro > 0){
                        echo '<span class="number blue">R$ '.number_format($total_lucro, 2, ',', '.').'</span>';
                    }

                    if($total_lucro < 0){
                        echo '<span class="number magenta">-R$ '.number_format(($total_lucro * -1), 2, ',', '.').'</span>';
                    }

                    if($total_lucro == 0){
                        echo '<span class="number dark">R$ '.number_format($total_lucro, 2, ',', '.').'</span>';
                    }
                ?>

            </div>
        </div>

        <?php

            $percent_lucro = 0;

            if($total_lucro > 0 && $total_receipt == 0){
                $percent_lucro = 100;
            }

            if($total_lucro == 0 && $total_receipt > 0){
                $percent_lucro = -100;
            }

            if($total_lucro < 0 && $total_receipt == 0){
                $percent_lucro = -100;
            }

            if($total_lucro == 0 && $total_receipt < 0){
                $percent_lucro = 100;
            }

            if($total_lucro > 0 && $total_receipt > 0){
                $percent_lucro = $total_lucro * 100 / $total_receipt;
            }

            if($total_lucro < 0 && $total_receipt > 0){
                $percent_lucro = $total_lucro * 100 / $total_receipt;
            }
            
        ?>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">auto_awesome</i>
                <span class="title">Lucratividade</span>

                <?php 
                    
                    if($percent_lucro > 0){
                        echo '<span class="number blue">'.number_format($percent_lucro, 2, ',', '.').'%</span>';
                    }

                    if($percent_lucro < 0){
                        echo '<span class="number magenta">'.number_format($percent_lucro, 2, ',', '.').'%</span>';
                    }

                    if($percent_lucro == 0){
                        echo '<span class="number dark">'.number_format($percent_lucro, 2, ',', '.').'%</span>';
                    }
                ?>

            </div>
        </div>

    </div>

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Desempenho no período</span>

                <?php
                    $values_lucratividade = '';
                    $values_despesas = '';
                    $values_receitas = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_lucratividade .= str_replace(',', '.', $month_lucratividade[$i]).','; 
                    } 

                    for ($i=1; $i < 13; $i++) { 
                        $values_despesas .= str_replace(',', '.', ($month_despesas[$i] * -1)).','; 
                    } 

                    for ($i=1; $i < 13; $i++) { 
                        $values_receitas .= str_replace(',', '.', $month_receitas[$i]).','; 
                    } 
                    
                ?>

                <canvas id="myChart1" height="70"></canvas>

                <script>
                    
                    var chart    = document.getElementById('myChart1').getContext('2d'),
                    
                    gradient_green = chart.createLinearGradient(0, 0, 0, 450);
                    gradient_green.addColorStop(0, 'rgba(46, 210, 66, 1)');
                    gradient_green.addColorStop(0.5, 'rgba(180, 255, 60, 0.2)');
                    gradient_green.addColorStop(1, 'rgba(180, 255, 60, 0)');

                    gradient_red = chart.createLinearGradient(0, 0, 0, 450);
                    gradient_red.addColorStop(0, 'rgba(255, 206, 44, 1)');
                    gradient_red.addColorStop(0.5, 'rgba(255, 206, 44, 0.2)');
                    gradient_red.addColorStop(1, 'rgba(255, 206, 44, 0)');

                    gradient_purple = chart.createLinearGradient(0, 0, 0, 450);
                    gradient_purple.addColorStop(0, 'rgba(255, 206, 44, 1)');
                    gradient_purple.addColorStop(0.5, 'rgba(255, 206, 44, 0.2)');
                    gradient_purple.addColorStop(1, 'rgba(255, 206, 44, 0)');

                    var data  = {
                        labels: [ 'JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                        datasets: [
                            {
                                label: 'Lucratividade',
                                backgroundColor: 'transparent',
                                pointBackgroundColor: '#999',
                                borderWidth: 2,
                                borderColor: '#999',
                                data: [<?php echo $values_lucratividade; ?>],
                                pointStyle: 'cross'
                            },
                            {
                                label: 'Despesas',
                                backgroundColor: gradient_red,
                                pointBackgroundColor: '#333',
                                borderWidth: 1,
                                borderColor: 'transparent',
                                data: [<?php echo $values_despesas; ?>],
                                pointStyle: 'cross'
                            },
                            {
                                label: 'Receitas',
                                backgroundColor: gradient_green,
                                pointBackgroundColor: '#41d242',
                                borderWidth: 1,
                                borderColor: 'transparent',
                                data: [<?php echo $values_receitas; ?>],
                                pointStyle: 'cross'
                            }
                            
                        ]
                    };

                    var options = {
                        responsive: true,
                        maintainAspectRatio: true,
                        animation: {
                            easing: 'easeInOutQuad',
                            duration: 520
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    color: 'rgba(200, 200, 200, 0.05)',
                                    lineWidth: 1
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: 'rgba(200, 200, 200, 0.08)',
                                    lineWidth: 1
                                }
                            }]
                        },
                        elements: {
                            line: {
                                tension: 0.4
                            }
                        },
                        legend: {
                            display: false
                            // position: 'bottom'
                        },
                        point: {
                            backgroundColor: 'white'
                        },
                        tooltips: {
                            titleFontFamily: 'Open Sans',
                            backgroundColor: 'rgba(0,0,0,0.7)',
                            titleFontColor: 'white',
                            caretSize: 5,
                            cornerRadius: 2,
                            xPadding: 10,
                            yPadding: 10
                        }
                    };

                    var chartInstance = new Chart(chart, {
                        type: 'line',
                        data: data,
                            options: options
                    });
                    
                </script>

            </div>
        </div>

        <?php if($origin_user != 'cadastro'){ ?>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                <div class="box-white size-lg">
                    <span class="title-box">Impostos a pagar</span>

                    <?php $x=0; foreach ($all_taxes as $taxes) { ?>

                        <?php if($taxes->status == 1){ $x++; ?>

                            <?php
                                if(date_format($taxes->maturity, 'm') == "01"){ $month = "Janeiro"; }
                                if(date_format($taxes->maturity, 'm') == "02"){ $month = "Fevereiro"; }
                                if(date_format($taxes->maturity, 'm') == "03"){ $month = "Março"; }
                                if(date_format($taxes->maturity, 'm') == "04"){ $month = "Abril"; }
                                if(date_format($taxes->maturity, 'm') == "05"){ $month = "Maio"; }
                                if(date_format($taxes->maturity, 'm') == "06"){ $month = "Junho"; }
                                if(date_format($taxes->maturity, 'm') == "07"){ $month = "Julho"; }
                                if(date_format($taxes->maturity, 'm') == "08"){ $month = "Agosto"; }
                                if(date_format($taxes->maturity, 'm') == "09"){ $month = "Setembro"; }
                                if(date_format($taxes->maturity, 'm') == "10"){ $month = "Outubro"; }
                                if(date_format($taxes->maturity, 'm') == "11"){ $month = "Novembro"; }
                                if(date_format($taxes->maturity, 'm') == "12"){ $month = "Dezembro"; }
                            ?>

                            <div class="item dark btn-open-taxes" data-id="<?= $taxes->id; ?>">
                                <span class="text"><?= date_format($taxes->maturity, 'd')." de ".$month; ?></span>
                                <span class="sub-text"><?= $taxes->title; ?></span>
                                <div class="area-right">
                                    <span>R$ <?= number_format($taxes->total, 2, ',', '.'); ?></span>
                                </div>
                            </div>

                        <?php } ?>
                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 60px;">

                            <ion-icon name="checkmark-circle-outline"></ion-icon>

                            <span class="title-box margin-t-10" style="margin-bottom: 5px; font-size: 20px;">Parabéns!</span>
                            <span class="title">Você está em dia com os seus impostos!</span>
                        </div>

                    <?php } ?>

                    <div class="text-center margin-t-30" style="position: absolute; bottom: 35px; left: 50%; transform: translateX(-50%);">
                        <a href="/client/taxes" class="link-primary">VER TODOS</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                <div class="box-white size-lg">
                    <span class="title-box">Extratos</span>

                    <!-- <a href="/client/extract/0/view" class="item-extract magenta">
                        <span class="text">Mês de Novembro</span>
                        <span class="sub-text">Extrato não enviado</span>
                        <div class="area-right">
                            <i class="material-icons-outlined" style="color: #ccc;">radio_button_unchecked</i>
                        </div>
                    </a> -->

                    <?php $x=0; foreach ($all_extracts as $extracts) { $x++; ?>

                        <div class="item dark btn-open-extracts" data-id="<?= $extracts->id; ?>">
                            <span class="text"><?= date_format($extracts->date_inicial, 'd/m/Y'); ?></span>
                            <span class="sub-text"><?php echo $extracts->bank; ?> | <?php echo $extracts->description; ?></span>
                            <div class="area-right">
                                <i class="material-icons-outlined" style="color: #20e041;">check_circle_outline</i>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 60px;">

                            <ion-icon name="file-tray-outline"></ion-icon>

                            <span class="title-box margin-t-10" style="margin-bottom: 5px; font-size: 20px;">Envie seus Extratos!</span>
                            <span class="title">Você ainda não enviou nenhum extrato bancário.</span>
                        </div>

                    <?php } ?>

                    <div class="text-center margin-t-30" style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);">
                        <a href="/client/extracts" class="link-primary">VER TODOS</a>
                    </div>

                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                <div class="box-white size-lg">
                    <span class="title-box">Notas Fiscais</span>

                    <?php $x=0; foreach ($all_notes as $notes) { $x++; ?>

                        <div class="item dark btn-open-notes" data-id="<?= $notes->id; ?>">
                            <span class="text">Referente <?= $notes->date; ?></span>
                            <span class="sub-text"><?php echo $notes->description; ?> | <?php echo $notes->title; ?></span>
                            <div class="area-right">
                                <i class="material-icons-outlined" style="color: #20e041;">check_circle_outline</i>
                            </div>
                        </div>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 60px;">

                            <ion-icon name="file-tray-outline"></ion-icon>

                            <span class="title-box margin-t-10" style="margin-bottom: 5px; font-size: 20px;">Envie suas Notas!</span>
                            <span class="title">Você ainda não enviou nenhuma nota fiscal.</span>
                        </div>

                    <?php } ?>

                    <div class="text-center margin-t-30" style="position: absolute; bottom: 30px; left: 50%; transform: translateX(-50%);">
                        <a href="/client/notes" class="link-primary">VER TODOS</a>
                    </div>

                </div>
            </div>

        <?php } ?>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Receitas</span>

                <canvas id="myChart3" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: [
                                'Receitas de Vendas e de Serviços',
                                'Receitas Financeiras',
                                'Outras Receitas e Entradas',
                            ],
                            datasets: [
                                {
                                    label: 'Receitas',
                                    data: [
                                        <?php 
                                            echo str_replace(',','.', $categories_values['receitas_de_vendas_e_de_servicos']);
                                            echo ',';
                                            echo str_replace(',','.', $categories_values['receitas_financeiras']);
                                            echo ',';
                                            echo str_replace(',','.', $categories_values['outras_receitas_e_entradas']);
                                        ?>
                                    ],                             
                                    backgroundColor: [
                                        '#DFFF00',
                                        '#FFBF00',
                                        '#FF7F50',
                                        '#DE3163',
                                        '#9FE2BF',
                                        '#40E0D0',
                                        '#6495ED',
                                        '#CCCCFF',
                                        '#DFFF00',
                                        '#FFBF00',
                                        '#FF7F50',
                                        '#DE3163',
                                        '#9FE2BF',
                                        '#40E0D0',
                                        '#6495ED',
                                        '#CCCCFF'
                                    ]
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: ''
                            },
                            legend: {
                                position: 'bottom',
                                align: 'left',
                                labels: {
                                    boxWidth: 10
                                }
                            },
                            
                        }
                    });
                </script>
                
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Despesas</span>

                <canvas id="myChart4" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: [
                                'Impostos sobre Vendas e sobre Serviços',
                                'Despesas com Vendas e Serviços',
                                'Despesas com Salários e Encargos',
                                'Despesas com Colaboradores',
                                'Despesas Administrativas',
                                'Despesas Comerciais',
                                'Despesas com Imóvel',
                                'Despesas com Veículos',
                                'Despesas com Diretoria',
                                'Despesas Financeiras',
                                'Outras Despesas',
                                'Outras Imobilizações por Aquisição',
                                'Empréstimos e Financiamentos',
                                'Parcelamentos e Dívidas'
                            ],
                            datasets: [
                                {
                                    label: 'Despesas',
                                    data: [
                                        <?php 
                                            echo str_replace(',','.', ($categories_values['impostos_sobre_vendas_e_sobre_servicos'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_vendas_e_servicos'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_salarios_e_encargos'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_colaboradores'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_administrativas'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_comerciais'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_imovel'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_veiculos'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_com_diretoria'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['despesas_financeiras'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['outras_despesas'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['outras_imobilizacoes_por_aquisicao'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['emprestimos_e_financiamentos'] * (-1)));
                                            echo ',';
                                            echo str_replace(',','.', ($categories_values['parcelamentos_e_dividas'] * (-1)));
                                        ?>
                                    ],                                
                                    backgroundColor: [
                                        '#DFFF00',
                                        '#FFBF00',
                                        '#FF7F50',
                                        '#DE3163',
                                        '#9FE2BF',
                                        '#40E0D0',
                                        '#6495ED',
                                        '#CCCCFF',
                                        '#DFFF00',
                                        '#FFBF00',
                                        '#FF7F50',
                                        '#DE3163',
                                        '#9FE2BF',
                                        '#40E0D0',
                                        '#6495ED',
                                        '#CCCCFF'
                                    ]
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: ''
                            },
                            legend: {
                                
                                display: true,
                                position: 'bottom',
                                align: 'left',
                                labels: {
                                    boxWidth: 10
                                }
                            }                            
                        }
                    });
                </script>
                
            </div>
        </div>

        <?php if($origin_user != 'cadastro'){ ?>

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                <div class="box-white size-lg">

                    <div id='calendar' style='z-index: 0;'></div>

                </div>

            </div>

        <?php } ?>
        
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>
