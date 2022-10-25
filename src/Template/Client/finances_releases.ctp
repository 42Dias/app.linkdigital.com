<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php

    $month_format_date['01'] = "Janeiro";
    $month_format_date['02'] = "Fevereiro";
    $month_format_date['03'] = "Março";
    $month_format_date['04'] = "Abril";
    $month_format_date['05'] = "Maio";
    $month_format_date['06'] = "Junho";
    $month_format_date['07'] = "Julho";
    $month_format_date['08'] = "Agosto";
    $month_format_date['09'] = "Setembro";
    $month_format_date['10'] = "Outubro";
    $month_format_date['11'] = "Novembro";
    $month_format_date['12'] = "Dezembro";
?>

<!-- Menu Page -->
<div class="menu-page">

    <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            <span class="title-page">Fluxo de caixa</span>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <form id="form-filter-dashboard" action="/client/finances/releases" method="POST">

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
        
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left: 0px;">

        
            <div class="box-white size-lg" style="min-height: 280px;">
                <span class="title-box">Despesas x Receitas</span>

                <?php
                    $values_lucratividade = '';
                    $values_balance = '';
                    $values_despesas = '';
                    $values_receitas = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_lucratividade .= str_replace(',', '.', $month_lucratividade[$i]).','; 
                    } 

                    for ($i=1; $i < 13; $i++) { 
                        // $values_despesas .= str_replace(',', '.', ($month_despesas[$i] * -1)).','; 
                        $values_despesas .= str_replace(',', '.', ($month_despesas[$i])).','; 
                    } 

                    for ($i=1; $i < 13; $i++) { 
                        $values_receitas .= str_replace(',', '.', $month_receitas[$i]).','; 
                    } 

                    for ($i=1; $i < 13; $i++) { 
                        $values_balance .= str_replace(',', '.', $month_receitas[$i] + $month_despesas[$i]).','; 
                    } 
                    
                ?>

                <canvas id="myChart1" height="50"></canvas>

                <script>
                    console.log(
                        [<?php echo $values_despesas; ?>],
                        [<?php echo $values_receitas; ?>],
                        [<?php echo $values_balance; ?>],
                    )

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
                                label: 'Despesas',
                                backgroundColor: gradient_red,
                                pointBackgroundColor: '#333',
                                borderWidth: 1,
                                borderColor: 'transparent',
                                data: [<?php echo $values_despesas; ?>],
                                pointStyle: 'cross',
                                borderSkipped: false,
                            },
                            {
                                label: 'Receitas',
                                backgroundColor: gradient_green,
                                pointBackgroundColor: ' #41d242',
                                borderWidth: 1,
                                borderColor: 'transparent',
                                data: [<?php echo $values_receitas; ?>],
                                pointStyle: 'cross',
                                borderSkipped: false,
                            },
                            {
                                label: 'Lucratividade',
                                data: [<?php echo $values_balance; ?>],
                                borderColor: "#4db8ff",
                                backgroundColor: "#82CDFF",
                                type: 'line',
                                fill: false,
                                tension: 0.1
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
                                },
                                stacked: true,
                            }],
                            yAxes: [{
                                gridLines: {
                                    color: 'rgba(200, 200, 200, 0.08)',
                                    lineWidth: 1,
                                },
                                stacked: true
                            }]
                        },
                        elements: {
                            line: {
                                tension: 0.4
                            }
                        },
                        legend: {
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
                        type: 'bar',
                        data: data,
                            options: options
                    });
                    
                </script>

            </div>
        </div>
    </div>

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 15 -->
            <div class="box-white active margin-t-30">
                <span class="title-box">Lançamentos</span>

                <div style="padding: 0px; padding-top: 0px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row margin-t-20">

                        <!-- ACCOUNTS -->
                        <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <!--<a href="?tab_select=15&account_id=all" class="box-account-item <?php if($account_selected_id == "all"){ echo "active"; } ?>" style="">-->
                            <!--    <strong style="color: #333; font-size: 14px;">Todas contas</strong>-->
                            <!--    <br>-->
                            <!--    <strong style="color: #28bd56; font-size: 12px;">R$ <?php echo number_format($total_accounts, 2, ',', '.'); ?></strong>-->
                            <!--</a>-->

                            <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>

                                <a href="?tab_select=15&account_id=<?php echo $account->id; ?>" class="box-account-item <?php if($account_selected_id == $account->id){ echo "active"; } ?>" style="">
                                    <strong style="color: #333; font-size: 14px;"><?php echo $account->bank; ?></strong>
                                    <br>
                                    <strong style="color: #28bd56; font-size: 12px;">R$ <?php echo number_format($account->total, 2, ',', '.'); ?></strong>
                                </a>

                            <?php } ?>

                        </div>

                        <!-- RELEASES -->
                        <div class="col-xl-10 col-lg-10 col-md-6 col-sm-12 col-xs-12 animate-scroll" style="display: <?php if($account_selected_id == "all"){ echo "none"; } ?>;">

                            <!-- <div class="row margin-t-20">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                                    <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                                        Extrato                                
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
                            </div> -->

                            <div class="row margin-t-10" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Data</p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">
                                        Entrada <i class="material-icons" style="font-size: 14px; color: #1bda44;">arrow_upward</i>
                                    </p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">
                                        Saída <i class="material-icons" style="font-size: 14px; color: #f33535;">arrow_downward</i>
                                    </p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Categoria</p>
                                </div>

                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                    <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Saldo</p>
                                </div>
                                
                            </div>

                            <?php
                            $old_date = ''; $x=0; foreach ($query_releases as $release) { $x++; ?>

                                <?php 
                                    // if($old_date == ''){
                                    //     echzo '<div class="release-date-item">Dia '.date_format($release->created, 'd').' de '.$month_format_date[date_format($release->created, 'm')].' de '.date_format($release->created, 'Y').'</div>';
                                    //     $old_date = $release->created;
                                    // }else{

                                    //     if($old_date != $release->created){
                                    //         echo '<div class="release-date-item">Dia '.date_format($release->created, 'd').' de '.$month_format_date[date_format($release->created, 'm')].' de '.date_format($release->created, 'Y').'</div>';
                                    //         // $old_date = $release->created;
                                    //     }   
                                    // }
                                ?>

                                <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                        <strong style="color: #999; font-size: 12px;"><?php echo date_format($release->created, 'd/m/Y'); ?></strong>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                        <strong style="color: #333; font-size: 12px;"><?php echo strval($release->title); ?></strong>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                        <?php if($release->type == 'receipt'){ ?>
                                            <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($release->value, 2, ',', '.'); ?></strong>
                                        <?php } ?>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                        <?php if($release->type == 'payment'){ ?>
                                            <strong style="color: #f33535; font-size: 12px;">R$ <?php echo number_format($release->value, 2, ',', '.'); ?></strong>
                                        <?php } ?>
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                        <strong style="color: #999; font-size: 10px; line-height: 13px; display: block;">

                                            <?php foreach ($query_categories as $category) { ?>
                                                <?php if($category->id == $release->category_id){ echo $category->name; } ?>
                                            <?php } ?>

                                        </strong>
                                        
                                    </div>

                                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                        <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($release->balance, 2, ',', '.'); ?></strong>
                                        
                                        <div style="position: absolute; right: 0px; top: 0px;">

                                            <i class="material-icons-outlined" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Editar">
                                                create
                                            </i>
                                            
                                            <i class="material-icons-outlined btn_send_form" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="Remover">
                                                delete
                                            </i>
                                        </div>
                                        
                                    </div>
                                </div>

                                <hr>

                                <!--<?php if($old_date != $release->created){ $old_date = $release->created; ?>-->

                                <!--    <div class="row margin-t-20" style="padding: 10px 10px; position: relative; background-color: #dcdcdc; color: #333; border-radius: 10px;">-->
                                <!--        <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 animate-scroll">-->
                                <!--            <strong style="color: #333; font-size: 12px;">Saldo do dia</strong>-->
                                <!--        </div>-->

                                <!--        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">-->
                                <!--            <strong style="color: #333; font-size: 12px;">R$ 0,00</strong>-->
                                <!--        </div>-->
                                <!--    </div>-->

                                <!--<?php } ?>-->

                            <?php } ?>

                            <?php if($x == 0){ ?>

                                <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                                    <span class="title" style="font-size: 12px;">Você não possui nenhum lançamento.</span>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
