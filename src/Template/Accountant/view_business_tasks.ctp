
<?php 
    echo $this->element('open_task_accountant');
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
            
            $day_now = date_format($date_now, 'j');
            $week_now = date_format($date_now, 'N');
            $month_now = date_format($date_now, 'n');
            $year_now = date_format($date_now, 'Y');

            foreach ($all_tasks_fixed as $task) {

                $day_maturity = $day_now;
                $month_maturity = $month_now;
                $year_maturity = $year_now;
                
                $one_view = false;
                $status_task = 'event-task-default';

                // Anual
                if($task->type == "yearly"){

                    // Mês anterior
                    if( $task->month == ($month_now - 1) ){
                        $day_maturity = $task->day;
                        $month_maturity = $task->month;
                        $year_maturity = $year_now;
                        $one_view = true;
                    }

                    // Mês atual
                    if( $task->month == $month_now ){
                        $day_maturity = $task->day;
                        $month_maturity = $task->month;
                        $year_maturity = $year_now;
                        $one_view = true;
                    }

                    // Mês próximo
                    if( $task->month == ($month_now + 1) ){
                        $day_maturity = $task->day;
                        $month_maturity = $task->month;
                        $year_maturity = $year_now;
                        $one_view = true;
                    }
                    
                }

                // Trimestral
                if($task->type == "quarterly"){
                    
                    // Mês anterior
                    if( ($month_now - 1) == 3 || ($month_now - 1) == 6 || ($month_now - 1) == 9 || ($month_now - 1) == 12 ){
                        $day_maturity = $task->day;
                        $month_maturity = ($month_now - 1);
                        $year_maturity = $year_now;
                        $one_view = true;
                    }

                    // Mês atual
                    if( $month_now == 3 || $month_now == 6 || $month_now == 9 || $month_now == 12 ){
                        $day_maturity = $task->day;
                        $month_maturity = $month_now;
                        $year_maturity = $year_now;
                        $one_view = true;
                    }

                    // Mês próximo
                    if( ($month_now + 1) == 3 || ($month_now + 1) == 6 || ($month_now + 1) == 9 || ($month_now + 1) == 12 ){
                        $day_maturity = $task->day;
                        $month_maturity = ($month_now + 1);
                        $year_maturity = $year_now;
                        $one_view = true;
                    }
                }

                // Mensal
                if($task->type == "monthly"){

                    // :::::::::::::::::::::::::
                    // Mês anterior
                    $day_maturity = $task->day;
                    $month_maturity = ($month_now - 1);
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
                    echo "title: '".$task->title."',\n";
                    echo "classNames: '".$status_task."',\n";
                    echo "start: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "extendedProps: {\n";
                        echo "date: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "}\n";
                    echo "},"."\n";


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
                    echo "title: '".$task->title."',\n";
                    echo "classNames: '".$status_task."',\n";
                    echo "start: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "extendedProps: {\n";
                        echo "date: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "}\n";
                    echo "},"."\n";


                    // :::::::::::::::::::::::::
                    // Mês próximo
                    $day_maturity = $task->day;
                    $month_maturity = ($month_now + 1);
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
                    echo "title: '".$task->title."',\n";
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

                        if($date_active == $date_end){
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
                                echo "title: '".$task->title."',\n";
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

                        if($date_active == $date_end){
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
                                echo "title: '".$task->title."',\n";
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

                        if($date_active == $date_end){
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
                                echo "title: '".$task->title."',\n";
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
                    echo "title: '".$task->title."',\n";
                    echo "classNames: '".$status_task."',\n";
                    echo "start: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "extendedProps: {\n";
                        echo "date: '".$year_maturity."-".$month_maturity."-".$day_maturity."',\n";
                    echo "}\n";
                    echo "},"."\n";
                }
            }

        ?>
      ],

        eventClick: function(info) {

            $('#open_task_accountant').modal('show');
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

                            $('#task_button_close').data('url', '/api/web/accountant/tasks/<?php echo $business_id ?>/' + task_fixed_id + '/' + task_date + '/close');

                        }else{
                            $('#task_button_open').css('display', 'inline-block');
                            $('#task_button_close').css('display', 'none');

                            $('#task_button_open').data('url', '/api/web/accountant/tasks/<?php echo $business_id ?>/' + id_task + '/' + task_date + '/open');
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

<?php

    foreach ($all_business as $business) {

        if($business->status == 1){ $status_select_text = "lead"; $status_color = "gray"; }
        if($business->status == 2){ $status_select_text = "Em abertura"; $status_color = "yellow"; }
        if($business->status == 3){ $status_select_text = "Em migração"; $status_color = "yellow"; }
        if($business->status == 4){ $status_select_text = "Ativo"; $status_color = "green"; }
        if($business->status == 5){ $status_select_text = "Inativo"; $status_color = "gray"; }
        if($business->status == 6){ $status_select_text = "Cancelado"; $status_color = "gray"; }

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

    <!-- CONTENTS -->
    <div class="box-tab-content active" id="tab-content-1">

        <!-- CALENDAR -->
        <br>
        <div id='calendar' style='z-index: 0;'></div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<?php
    echo $this->element('sidebar_timeline');
?>