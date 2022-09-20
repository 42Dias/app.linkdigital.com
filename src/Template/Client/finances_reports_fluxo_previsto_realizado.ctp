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

    $model_report_dre = [
        0 => [
            'text' => 'Saldo do Mês Anterior',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        1 => [
            'text' => 'Total de Recebimentos',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        2 => [
            'text' => 'Receitas de Vendas e de Serviços',
            'origin_id' => 0,
            'slug' => 'receitas_de_vendas_e_de_servicos'
        ],
        3 => [
            'text' => 'Receitas de Serviços',
            'origin_id' => 0,
            'slug' => 'receitas_de_vendas_e_de_servicos'
        ],
        4 => [
            'text' => 'Saldo Inicial',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        5 => [
            'text' => 'Total de Pagamentos',
            'origin_id' => 0,
            'slug' => 'despesas_com_vendas_e_servicos'
        ],
        6 => [
            'text' => 'Despesas com Salários e Encargos',
            'origin_id' => 0,
            'slug' => 'despesas_com_salarios_e_encargos'
        ],
        7 => [
            'text' => 'Adiantamento Salarial',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        8 => [
            'text' => 'Geração de Caixa do Período',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        9 => [
            'text' => 'Total de Transferências',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        10 => [
            'text' => 'Saldo Final de Caixa',
            'origin_id' => 0,
            'slug' => 'default'
        ]
    ];

    // for ($i=1; $i < count($model_report_dre); $i++) {
    //     echo $model_report_dre[$i]."<br>";
    // }

    // die();


    // // TOTAL OPERACIONAL
    // $total_operacional = [];

    // for ($i=1; $i < 13; $i++) {
    //     $total_operacional[$i] = 0;
    // }

    // $total_operacional[$year_select] = 0;

    // for ($i=1; $i < 13; $i++) { 
    //     $total_operacional[$i] += $main_categories['receitas_operacionais'][$i];
    //     $total_operacional[$i] += $main_categories['custos_operacionais'][$i];
    //     $total_operacional[$i] += $main_categories['despesas_opercionais_e_outras_receitas'][$i];
    //     $total_operacional[$i] += $main_categories['atividade_de_investimento'][$i];
    //     $total_operacional[$i] += $main_categories['atividade_de_financiamento'][$i];

    //     $total_operacional[$year_select] += $main_categories['receitas_operacionais'][$year_select];
    //     $total_operacional[$year_select] += $main_categories['custos_operacionais'][$year_select];
    //     $total_operacional[$year_select] += $main_categories['despesas_opercionais_e_outras_receitas'][$year_select];
    //     $total_operacional[$year_select] += $main_categories['atividade_de_investimento'][$year_select];
    //     $total_operacional[$year_select] += $main_categories['atividade_de_financiamento'][$year_select];
    // }
?>


<!-- Menu Page -->
<div class="menu-page">
    <span class="title-page">Fluxo de caixa Previsto x Realizado</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

<!-- QUADROS -->
<div class="row">

    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

        <!-- TAB 16 -->
        <div class="box-tab-content active margin-t-30">

            <div style="padding: 20px; padding-top: 20px; padding-bottom: 0px; margin-top: 0px; border-radius: 8px;">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                        
                        <div class="box-tabs" style="margin-top: 0px;">
                            <a href="/client/finances/reports/dre-mensal-demonstracao" class="tab-item " data-open="#tab-content-9">
                                DRE
                            </a>
                            <a href="/client/finances/reports/fluxo-previsto" class="tab-item active" data-open="#tab-content-8">
                                Fluxo de caixa
                            </a>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll text-right">

                        <form action="/client/finances/reports/fluxo-previsto-realizado" method="POST" id="form-update-report-review-1">

                            <select type="text" class="form-control margin-r-10" name="report_type"  style="font-size: 14px; background-color: #fff; width: auto; display: inline-block;" id="input-filter-report-type" onchange="location = this.value;">
                                <option value="/client/finances/reports/fluxo-previsto">Fluxo de caixa Previsto</option>
                                <option value="/client/finances/reports/fluxo-realizado">Fluxo de caixa Realizado</option>
                                <option value="/client/finances/reports/fluxo-previsto-realizado" selected>Fluxo de caixa Previsto x Realizado</option>
                            </select>

                            <select type="text" class="form-control" name="report_year"  style="font-size: 14px; background-color: #fff; width: auto; display: inline-block;" id="input-filter-report-review-1">
                                <option value="2021" <?php if($year_select == 2021){ echo 'selected'; } ?>>Ano de 2021</option>
                                <option value="2020" <?php if($year_select == 2020){ echo 'selected'; } ?>>Ano de 2020</option>
                                <option value="2019" <?php if($year_select == 2019){ echo 'selected'; } ?>>Ano de 2019</option>
                                <option value="2018" <?php if($year_select == 2018){ echo 'selected'; } ?>>Ano de 2018</option>
                                <option value="2017" <?php if($year_select == 2017){ echo 'selected'; } ?>>Ano de 2017</option>
                                <option value="2016" <?php if($year_select == 2016){ echo 'selected'; } ?>>Ano de 2016</option>
                                <option value="2015" <?php if($year_select == 2015){ echo 'selected'; } ?>>Ano de 2015</option>
                            </select>   

                        </form>  

                    </div>
                </div>

                <br><br>

                <table class="table table-responsive" style="height: 510px;">
                    <tr class='fixed-row' style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;"></p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Previsto</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Realizado</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Ano</p></td>
                    </tr>
                    <tr class='fixed-row-second' style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Categoria</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jan</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jan</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Fev</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Fev</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mar</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mar</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Abr</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Abr</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mai</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mai</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jun</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jun</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jul</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jul</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Ago</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Ago</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Set</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Set</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Out</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Out</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Nov</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Nov</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Dez</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Dez</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;"><?php echo $year_select; ?></p></td>
                    </tr>

                    <?php 
                        for ($x=0; $x < count($model_report_dre); $x++) {

                            $color_bg = 'fff';

                            if($model_report_dre[$x]['text'] == 'Receitas de Vendas e de Serviços'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Saldo Inicial'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Despesas com Salários e Encargos'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Geração de Caixa do Período'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Total de Transferências'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Saldo Final de Caixa'){ $color_bg = 'FFF8E3'; }
                    ?>

                        <tr style="background-color: #<?php echo $color_bg; ?>; padding: 10px; border-radius: 10px;">
                            
                            <td class="fixed-col" style="background-color: #<?php echo $color_bg; ?>;">
                                <strong style="color: #333; font-size: 12px;"><?php echo $model_report_dre[$x]['text']; ?></strong>
                            </td>
                    
                            <?php 

                                $category_selected_text = $model_report_dre[$x]['text'];
                                $category_selected_slug = $model_report_dre[$x]['slug'];

                                for ($i=1; $i < 13; $i++) { 

                                    $color_value = '999';

                                    if($category_selected_slug == ''){

                                        echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                        echo 'R$ 0,00';
                                        echo '</strong></td>';

                                    }else{

                                        if($category_selected_slug == 'default'){
                                            $value_item = 0;
                                        }else{
                                            $value_item = $main_categories[$category_selected_slug][$i];
                                        }

                                        if($category_selected_text == 'Receitas Operacionais'){
                                            $value_item += $main_categories['receitas_de_vendas_e_de_servicos'][$i];
                                            $value_item += $main_categories['receitas_financeiras'][$i];
                                            $value_item += $main_categories['outras_receitas_e_entradas'][$i];
                                        }

                                        if($category_selected_text == 'Deduções da Receita Bruta'){
                                            $value_item += $main_categories['impostos_sobre_vendas_e_sobre_servicos'][$i];
                                            $value_item += $main_categories['despesas_com_vendas_e_servicos'][$i];
                                        }

                                        if($value_item > 0){ $color_value = '4caf50'; }
                                        if($value_item < 0){ $color_value = 'f33535'; }
                                        if($value_item == 0){ $color_value = '999'; }
                                    
                                        echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                        echo 'R$ '.$value_item;
                                        echo '</strong></td>';

                                        echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                        echo 'R$ '.$value_item;
                                        echo '</strong></td>';
                                    }
                                }

                                $color_value = '999';

                                if($category_selected_slug == ''){

                                    echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                    echo 'R$ 0,00';
                                    echo '</strong></td>';

                                }else{

                                    if($category_selected_slug == 'default'){
                                        $value_year_item = 0;
                                    }else{
                                        $value_year_item = $main_categories[$category_selected_slug][$year_select];
                                    }

                                    if($category_selected_text == 'Receitas Operacionais'){
                                        $value_year_item += $main_categories['receitas_de_vendas_e_de_servicos'][$year_select];
                                        $value_year_item += $main_categories['receitas_financeiras'][$year_select];
                                        $value_year_item += $main_categories['outras_receitas_e_entradas'][$year_select];
                                    }

                                    if($category_selected_text == 'Deduções da Receita Bruta'){
                                        $value_year_item += $main_categories['impostos_sobre_vendas_e_sobre_servicos'][$year_select];
                                        $value_year_item += $main_categories['despesas_com_vendas_e_servicos'][$year_select];
                                    }

                                    if($value_year_item > 0){ $color_value = '4caf50'; }
                                    if($value_year_item < 0){ $color_value = 'f33535'; }
                                    if($value_year_item == 0){ $color_value = '999'; }
                                
                                    echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                    echo 'R$ '.$value_year_item;
                                    echo '</strong></td>';
                                }
                                
                            ?>

                        </tr>

                    <?php } ?>

                </table>  

                <br><br>

            </div>
        </div>
    </div>
</div>
</div>

<?php
// echo $this->element('footer_panel');
?>
