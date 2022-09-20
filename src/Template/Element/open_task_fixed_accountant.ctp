
<div class="modal fade" id="open_task_fixed_accountant" tabindex="-1" role="dialog" aria-labelledby="open_task_fixed_accountantLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Obrigação</h4>

            </div>
            <div class="modal-body">

                <?php $x=0; foreach ($all_tasks_fixed as $task) { $x++; ?>

                    <?php 
                    
                        if($task->type == "none"){
                            $maturity = date_format($task->maturity, 'd/m/Y');
                        }

                        if($task->type  == "diary"){
                            $maturity = 'Todo dia';
                        }

                        if($task->type  == "week"){
                            if($task->week == 1){ $maturity = "Segunda-feira"; }
                            if($task->week == 2){ $maturity = "Terça-feira"; }
                            if($task->week == 3){ $maturity = "Quarta-feira"; }
                            if($task->week == 4){ $maturity = "Quinta-feira"; }
                            if($task->week == 5){ $maturity = "Sexta-feira"; }
                        }

                        if($task->type  == "month"){
                            $maturity = "Dia ".$task->day;
                        }

                        if($task->type == "yearly"){

                            if($task->month == 1){ $month_text = "Janeiro"; }
                            if($task->month == 2){ $month_text = "Fevereiro"; }
                            if($task->month == 3){ $month_text = "Março"; }
                            if($task->month == 4){ $month_text = "Abril"; }
                            if($task->month == 5){ $month_text = "Maio"; }
                            if($task->month == 6){ $month_text = "Junho"; }
                            if($task->month == 7){ $month_text = "Julho"; }
                            if($task->month == 8){ $month_text = "Agosto"; }
                            if($task->month == 9){ $month_text = "Setembro"; }
                            if($task->month == 10){ $month_text = "Outubro"; }
                            if($task->month == 11){ $month_text = "Novembro"; }
                            if($task->month == 12){ $month_text = "Dezembro"; }

                            $maturity = $month_text." - Dia ".$task->day;
                        }

                    ?>

                    <div class="text-left margin-t-20 item-tasks-fixed" id="item-tasks-fixed-<?= $task->id; ?>" style="display: none;">

                        <h3 style="font-weight: 500; color: #333;"><?= $task->title; ?></h3>
                        <p style="font-weight: 500; color: #666; margin-top: 10px;"><?= $task->description; ?></p>

                        <div class="row margin-t-30">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                <span style="color: #999; font-size: 12px;">Data de entrega:</span>
                                <br>
                                <strong style="color: #333; font-size: 14px;"><?= $maturity; ?></strong>
                                <br>
                            </div>
                        </div>

                        <div class="text-left">

                            <div class="btn btn-line-gray size-lg margin-t-50 btn_send_form"
                                    data-url="/api/web/accountant/tasks/<?= $task->id; ?>/delete-fixed" data-form="#form" data-redirect="none">EXCLUIR</div>
                        </div>

                    </div>

                <?php } ?>

            </div>
        </div>
    </div>
</div>
