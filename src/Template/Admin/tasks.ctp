
<?php 
    echo $this->element('open_task_fixed_accountant');
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
            foreach ($all_tasks as $task) {

                $status_task = 'event-task-default';

                // None
                if($type_group[$task->id] == "none"){

                    if($task->maturity < $date_now && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Diary
                if($type_group[$task->id] == "diary"){
                    if($task->maturity < $date_now && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Week
                if($type_group[$task->id] == "week"){

                    if(date_format($date_now, 'N') < 6 && date_format($date_now, 'N') > $task->week && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Month
                if($type_group[$task->id] == "month"){

                    if(date_format($date_now, 'j') > $task->day && $task->status == 1){
                        $status_task = 'event-task-pending';
                    }
                }

                // Yearly
                if($type_group[$task->id] == "yearly"){

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

                if($task->status == 0){
                    $status_task = 'event-task-completed';
                }

                echo "{\n";
                echo "id: '".$task->id."',\n";
                echo "title: '".$name_business[$task->id]." - ".$task->title."',\n";
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

<!-- Menu Page -->
<div class="menu-page">

  <span class="title-page">Obrigações</span>

</div>

<div class="area-actions" style="padding-top: 0px;">

  <!-- CALENDAR -->
  <br><br><br>

  <div id='calendar' style='z-index: 0;'></div>

</div>

<?php
    echo $this->element('footer_panel');
?>
