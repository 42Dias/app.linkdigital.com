
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<?php

    echo $this->element('add_category');

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
            <span class="title-page">Indicadores</span>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <form id="form-filter-dashboard" action="/client/finances/indicators" method="POST">

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

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">TOTAL DE VENDAS</span>

                <?php
                    $values_vendas = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_vendas .= str_replace(',', '.', $month_vendas[$i]).','; 
                    } 
                ?>

                <canvas id="myChart1" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart1').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                            datasets: [
                                {
                                    label: 'Vendas',
                                    data: [
                                        <?php echo $values_vendas; ?>
                                    ],
                                    borderColor: '#f1c40f',
                                    pointBackgroundColor: '#f1c40f',
                                    backgroundColor: '#f1c40f',
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: 'none'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            
                        }
                    });
                </script>

            </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">TICKET MÉDIO</span>

                <?php
                    $values_ticket = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_ticket .= str_replace(',', '.', $month_ticket[$i]).','; 
                    } 
                ?>

                <canvas id="myChart2" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart2').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                            datasets: [
                                {
                                    label: 'Ticket',
                                    data: [
                                        <?php echo $values_ticket; ?>
                                    ],
                                    borderColor: '#6495ED',
                                    pointBackgroundColor: '#6495ED',
                                    backgroundColor: '#6495ED',
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: 'none'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            
                        }
                    });
                </script>
                
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">LUCRO BRUTO</span>

                <?php
                    $values_bruto = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_bruto .= str_replace(',', '.', $month_bruto[$i]).','; 
                    } 
                ?>

                <canvas id="myChart3" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart3').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                            datasets: [
                                {
                                    label: 'Lucro bruto',
                                    data: [
                                        <?php echo $values_bruto; ?>
                                    ],
                                    borderColor: '#DE3163',
                                    pointBackgroundColor: '#DE3163',
                                    backgroundColor: '#DE3163',
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: 'none'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            
                        }
                    });
                </script>
                
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">LUCRO LÍQUIDO</span>

                <?php
                    $values_liquido = '';

                    for ($i=1; $i < 13; $i++) { 
                        $values_liquido .= str_replace(',', '.', $month_liquido[$i]).','; 
                    } 
                ?>

                <canvas id="myChart4" height="150"></canvas>

                <script>
                    var ctx = document.getElementById('myChart4').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                            datasets: [
                                {
                                    label: 'Lucro líquido',
                                    data: [
                                        <?php echo $values_liquido; ?>
                                    ],
                                    borderColor: '#e77e23',
                                    pointBackgroundColor: '#e77e23',
                                    backgroundColor: '#e77e23',
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: 'none'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            
                        }
                    });
                </script>
                
            </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">LUCRO BRUTO x LÍQUIDO</span>

                <canvas id="myChart5" height="70"></canvas>

                <script>
                    var ctx = document.getElementById('myChart5').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['JAN', 'FEV', 'MAR', 'ABR', 'MAI', 'JUN', 'JUL', 'AGO', 'SET', 'OUT', 'NOV', 'DEZ'],
                            datasets: [
                                {
                                    label: 'Bruto',
                                    data: [
                                        <?php echo $values_bruto; ?>
                                    ],
                                    borderColor: '#DE3163',
                                    pointBackgroundColor: '#DE3163',
                                    backgroundColor: 'transparent',
                                    borderWidth: 2
                                },
                                {
                                    label: 'Líquido',
                                    data: [
                                        <?php echo $values_liquido; ?>
                                    ],
                                    borderColor: '#e77e23',
                                    pointBackgroundColor: '#e77e23',
                                    backgroundColor: 'transparent',
                                    borderWidth: 2
                                }
                            ]
                        },
                        options: {
                            scales: {
                                display: 'none'
                            },
                            legend: {
                                position: 'bottom'
                            },
                            
                        }
                    });
                </script>
                
            </div>
        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
