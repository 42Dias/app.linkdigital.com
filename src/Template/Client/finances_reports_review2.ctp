
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
  <span class="title-page">Financeiro</span>
</div>


<?php echo $this->element('finances_menu'); ?>


<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 16 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

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

                    <?php $old_date = ''; $x=0; foreach ($query_releases as $release) { $x++; ?>

                        <?php 
                            
                            if($old_date == ''){
                                echo '<div class="release-date-item">Dia '.date_format($release->created, 'd').' de '.$month_format_date[date_format($release->created, 'm')].' de '.date_format($release->created, 'Y').'</div>';
                                $old_date = $release->created;
                            }else{

                                if($old_date != $release->created){
                                    echo '<div class="release-date-item">Dia '.date_format($release->created, 'd').' de '.$month_format_date[date_format($release->created, 'm')].' de '.date_format($release->created, 'Y').'</div>';
                                    $old_date = $release->created;
                                }   
                            }
                        ?>

                        <div class="row margin-t-20" style="padding: 0px 10px; position: relative;">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #333; font-size: 12px;"><?php echo date_format($release->created, 'd/m/Y'); ?></strong>
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

                                <strong style="color: #333; font-size: 10px;">

                                    <?php foreach ($query_categories as $category) { ?>
                                        <?php if($category->id == $release->category_id){ echo $category->name; } ?>
                                    <?php } ?>

                                </strong>
                                
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                <strong style="color: #333; font-size: 12px;">R$ <?php echo number_format($release->balance, 2, ',', '.'); ?></strong>
                                
                            </div>
                        </div>

                        <hr>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                            <span class="title" style="font-size: 12px;">Você não possui nenhum lançamento.</span>
                        </div>

                    <?php } ?>

                <div>
            </div>
        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
