
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        


<?php 
    echo $this->element('open_task_accountant');
?>

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

                <canvas id="myChart1" height="70"></canvas>
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
<script>
  const queryData = <?php echo json_encode($query_releases); ?>;
  const inputBeginDate = "<?php echo ($date_begin_input); ?>";
  const inputEndDate = "<?php echo ($date_end_input); ?>";

</script>
<script src="/js/custom/graphic_desempenho_home.js"></script>
