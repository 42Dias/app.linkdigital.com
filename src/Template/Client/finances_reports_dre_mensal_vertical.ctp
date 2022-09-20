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
            'text' => 'Receitas Operacionais',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        1 => [
            'text' => 'Receita de Vendas de Produtos e Serviços',
            'origin_id' => 0,
            'slug' => 'receitas_de_vendas_e_de_servicos'
        ],
        2 => [
            'text' => 'Receita de Fretes e Entregas',
            'origin_id' => 0,
            'slug' => 'receitas_financeiras'
        ],
        3 => [
            'text' => 'Receita Bruta de Vendas',
            'origin_id' => 0,
            'slug' => 'outras_receitas_e_entradas'
        ],
        4 => [
            'text' => 'Deduções da Receita Bruta',
            'origin_id' => 0,
            'slug' => 'default'
        ],
        5 => [
            'text' => 'Impostos Sobre Vendas',
            'origin_id' => 0,
            'slug' => 'impostos_sobre_vendas_e_sobre_servicos'
        ],
        6 => [
            'text' => 'Comissões Sobre Vendas',
            'origin_id' => 0,
            'slug' => 'despesas_com_vendas_e_servicos'
        ],
        7 => [
            'text' => 'Descontos Incondicionais',
            'origin_id' => 0,
            'slug' => ''
        ],
        8 => [
            'text' => 'Devoluções de Vendas',
            'origin_id' => 0,
            'slug' => ''
        ],
        9 => [
            'text' => 'Receita Líquida de Vendas',
            'origin_id' => 0,
            'slug' => 'receitas_de_vendas_e_de_servicos'
        ],
        10 => [
            'text' => 'Custos Operacionais',
            'origin_id' => 0,
            'slug' => 'despesas_com_salarios_e_encargos'
        ],
        11 => [
            'text' => 'Custo dos Produtos Vendidos',
            'origin_id' => 0,
            'slug' => ''
        ],
        12 => [
            'text' => 'Custo das Vendas de Produtos',
            'origin_id' => 0,
            'slug' => ''
        ],
        13 => [
            'text' => 'Custo dos Serviços Prestados',
            'origin_id' => 0,
            'slug' => ''
        ],
        14 => [
            'text' => 'Lucro Bruto',
            'origin_id' => 0,
            'slug' => ''
        ],
        15 => [
            'text' => 'Despesas Operacionais',
            'origin_id' => 0,
            'slug' => ''
        ],
        16 => [
            'text' => 'Despesas Comerciais',
            'origin_id' => 0,
            'slug' => 'despesas_comerciais'
        ],
        17 => [
            'text' => 'Despesas Administrativas',
            'origin_id' => 0,
            'slug' => 'despesas_administrativas'
        ],
        18 => [
            'text' => 'Despesas Operacionais',
            'origin_id' => 0,
            'slug' => 'despesas_com_salarios_e_encargos'
        ],
        19 => [
            'text' => 'Lucro / Prejuízo Operacional',
            'origin_id' => 0,
            'slug' => ''
        ],
        20 => [
            'text' => 'Receitas e Despesas Financeiras',
            'origin_id' => 0,
            'slug' => ''
        ],
        21 => [
            'text' => 'Receitas e Rendimentos Financeiros',
            'origin_id' => 0,
            'slug' => 'receitas_financeiras'
        ],
        22 => [
            'text' => 'Despesas Financeiras',
            'origin_id' => 0,
            'slug' => 'despesas_financeiras'
        ],
        23 => [
            'text' => 'Outras Receitas e Despesas Não Operacionais',
            'origin_id' => 0,
            'slug' => ''
        ],
        24 => [
            'text' => 'Outras Receitas Não Operacionais',
            'origin_id' => 0,
            'slug' => 'outras_receitas_e_entradas'
        ],
        25 => [
            'text' => 'Outras Despesas Não Operacionais',
            'origin_id' => 0,
            'slug' => 'outras_despesas'
        ],
        26 => [
            'text' => 'Lucro / Prejuízo Líquido',
            'origin_id' => 0,
            'slug' => ''
        ],
        27 => [
            'text' => 'Despesas com Investimentos e Empréstimos',
            'origin_id' => 0,
            'slug' => 'emprestimos_e_financiamentos'
        ],
        28 => [
            'text' => 'Investimentos em Imobilizado',
            'origin_id' => 0,
            'slug' => 'outras_imobilizacoes_por_aquisicao'
        ],
        29 => [
            'text' => 'Empréstimos e Dívidas',
            'origin_id' => 0,
            'slug' => 'parcelamentos_e_dividas'
        ],
        30 => [
            'text' => 'Lucro / Prejuízo Final',
            'origin_id' => 0,
            'slug' => ''
        ],
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
    <span class="title-page">DRE Mensal Vertical</span>
</div>


<div class="area-actions" style="padding-top: 0px;">

<!-- QUADROS -->
<div class="row">

    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

        <!-- TAB 16 -->
        <div class="box-tab-content active margin-t-20">

            <div style="padding: 20px; padding-top: 20px; padding-bottom: 0px; margin-top: 0px; border-radius: 8px;">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">
                        
                        <div class="box-tabs" style="margin-top: 0px;">
                            <a href="/client/finances/reports/dre-mensal-demonstracao" class="tab-item active" data-open="#tab-content-9">
                                DRE
                            </a>
                            <a href="/client/finances/reports/fluxo-previsto" class="tab-item" data-open="#tab-content-8">
                                Fluxo de caixa
                            </a>
                            <div class="clear"></div>
                        </div>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll text-right">

                        <form action="/client/finances/reports/dre-mensal-vertical" method="POST" id="form-update-report-review-1">

                            <select type="text" class="form-control margin-r-10" name="report_type"  style="font-size: 14px; background-color: #fff; width: auto; display: inline-block;" id="input-filter-report-type" onchange="location = this.value;">
                                <option value="/client/finances/reports/dre-anual-horizontal" >DRE Anual Horizontal</option>
                                <option value="/client/finances/reports/dre-anual-vertical">DRE Anual Vertical</option>
                                <option value="/client/finances/reports/dre-mensal-demonstracao">DRE Demonstração</option>
                                <option value="/client/finances/reports/dre-mensal-horizontal">DRE Mensal Horizontal</option>
                                <option value="/client/finances/reports/dre-mensal-vertical" selected>DRE Mensal Vertical</option>
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
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Categoria</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jan</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Fev</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mar</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Abr</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Mai</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jun</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Jul</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Ago</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Set</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Out</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Nov</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">Dez</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;">AV%</p></td>
                        <td><p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600; font-size: 12px;"><?php echo $year_select; ?></p></td>
                    </tr>


                    <?php 
                        for ($x=0; $x < count($model_report_dre); $x++) {

                            $color_bg = 'fff';

                            if($model_report_dre[$x]['text'] == 'Receitas Operacionais'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Deduções da Receita Bruta'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Receita Líquida de Vendas'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Custos Operacionais'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Lucro Bruto'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Despesas Operacionais'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Lucro / Prejuízo Operacional'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Receitas e Despesas Financeiras'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Outras Receitas e Despesas Não Operacionais'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Lucro / Prejuízo Líquido'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Despesas com Investimentos e Empréstimos'){ $color_bg = 'FFF8E3'; }
                            if($model_report_dre[$x]['text'] == 'Lucro / Prejuízo Final'){ $color_bg = 'FFF8E3'; }
                    ?>

                        <tr style="background-color: #<?php echo $color_bg; ?>; padding: 10px; border-radius: 10px;">
                        
                            <td class="fixed-col" style="background-color: #<?php echo $color_bg; ?>;">
                                <strong style="color: #333; font-size: 12px;"><?php echo $model_report_dre[$x]['text']; ?></strong>
                            </td>
                    
                            <?php 

                                $category_selected_text = $model_report_dre[$x]['text'];
                                $category_selected_slug = $model_report_dre[$x]['slug'];

                                $value_old_month = 1;

                                for ($i=1; $i < 13; $i++) { 

                                    $color_value = '999';

                                    if($category_selected_slug == ''){

                                        echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                        echo 'R$ 0,00';
                                        echo '</strong></td>';

                                        echo '<td><strong style="color: #'.$color_value.'; font-size: 11px;">';
                                        echo '0%';
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

                                        if($value_item > 0 || $value_item < 0){
                                            $value_ah = (($value_item - $value_old_month) / $value_old_month) * 100;
                                            $value_old_month = $value_item;
                                        }

                                        if($value_item == 0){
                                            $value_ah = 0;
                                            $value_old_month = 1;
                                        }

                                        if($i == 1){
                                            $value_ah = 0;
                                        }

                                        echo '<td><strong style="color: #999; font-size: 11px;">';
                                        echo number_format($value_ah, 0, '.', ',').'%';
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
