
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
  <span class="title-page">Categorias</span>
</div>


<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 16 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php $x=0; foreach ($query_categories as $category) { $x++; } ?>

                            <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                                <?php echo $x; ?> Categorias encontradas
                            </p>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                            <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_category">
                                    NOVA CATEGORIA
                            </div>
                        </div>
                    </div>

                    <!-- <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Nome</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Grupo</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Tipo de categoria</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            
                        </div>
                    </div> -->

                    <?php $category_initial = ''; ?>

                    <?php $x=0; foreach ($query_categories as $category) { $x++; ?>

                        <?php if($category->group_categories !== $category_initial){ ?>

                            <?php 

                                $text_group_category = '';
                                $category_initial = $category->group_categories; 

                                if($category_initial == 'receitas_de_vendas_e_de_servicos'){ $text_group_category = 'Receitas de Vendas e de Serviços'; }
                                if($category_initial == 'receitas_financeiras'){ $text_group_category = 'Receitas Financeiras'; }
                                if($category_initial == 'outras_receitas_e_entradas'){ $text_group_category = 'Outras Receitas e Entradas'; }
                                if($category_initial == 'impostos_sobre_vendas_e_sobre_servicos'){ $text_group_category = 'Impostos sobre Vendas e sobre Serviços'; }
                                if($category_initial == 'despesas_com_vendas_e_servicos'){ $text_group_category = 'Despesas com Vendas e Serviços'; }
                                if($category_initial == 'despesas_com_salarios_e_encargos'){ $text_group_category = 'Despesas com Salários e Encargos'; }
                                if($category_initial == 'despesas_com_colaboradores'){ $text_group_category = 'Despesas com Colaboradores'; }
                                if($category_initial == 'despesas_administrativas'){ $text_group_category = 'Despesas Administrativas'; }
                                if($category_initial == 'despesas_comerciais'){ $text_group_category = 'Despesas Comerciais'; }
                                if($category_initial == 'despesas_com_imovel'){ $text_group_category = 'Despesas com Imóvel'; }
                                if($category_initial == 'despesas_com_veiculos'){ $text_group_category = 'Despesas com Veículos'; }
                                if($category_initial == 'despesas_com_diretoria'){ $text_group_category = 'Despesas com Diretoria'; }
                                if($category_initial == 'despesas_financeiras'){ $text_group_category = 'Despesas Financeiras'; }
                                if($category_initial == 'outras_despesas'){ $text_group_category = 'Outras Despesas'; }
                                if($category_initial == 'outras_imobilizacoes_por_aquisicao'){ $text_group_category = 'Outras Imobilizações por Aquisição'; }
                                if($category_initial == 'emprestimos_e_financiamentos'){ $text_group_category = 'Empréstimos e Financiamentos'; }
                                if($category_initial == 'parcelamentos_e_dividas'){ $text_group_category = 'Parcelamentos e Dívidas'; }

                                if($category_initial == 'receitas_operacionais'){ $text_group_category = 'Receitas operacionais'; }
                                if($category_initial == 'custos_operacionais'){ $text_group_category = 'Custos operacionais'; }
                                if($category_initial == 'despesas_operacionais_e_outras_receitas'){ $text_group_category = 'Despesas operacionais e outras receitas'; }
                                if($category_initial == 'atividade_de_investimento'){ $text_group_category = 'Atividade de investimento'; }
                                if($category_initial == 'atividade_de_financiamento'){ $text_group_category = 'Atividade de financiamento'; }
 
                            ?>
                            

                            <div class="row margin-t-20" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 animate-scroll">
                                    <strong style="color: #333; font-size: 12px;"><?php echo $text_group_category; ?></strong>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="row margin-t-10" style="padding: 0px 10px; position: relative;">
                            
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #333; font-size: 12px;"><?php echo $category->name; ?></strong>
                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #333; font-size: 12px;">
                                
                                    <?php 
                                        if($category->type == "receipt"){
                                            echo '<i class="material-icons" style="font-size: 14px; color: #1bda44;">arrow_upward</i> Receita';
                                        }else{
                                            echo '<i class="material-icons" style="font-size: 14px; color: #f33535;">arrow_downward</i> Despesa';
                                        }
                                    ?>
                                </strong>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                <div style="position: absolute; right: 0px; top: 0px;">
                                    <i class="material-icons-outlined btn_send_form" style="cursor: pointer;"
                                            data-url="/api/web/custom/categories/<?php echo $category->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>

                                    <!-- <i class="material-icons-outlined">create</i> -->
                                </div>
                            </div>
                        </div>

                        <hr>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
