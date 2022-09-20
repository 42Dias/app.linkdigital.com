
<?php

    echo $this->element('remove_all_releases');
    echo $this->element('import_releases');

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
<div class="menu-page margin-b-10">
  <span class="title-page">Conciliação bancária</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 17 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php 
                                $z=0; foreach ($query_conciliations as $conciliation) { $z++; } 

                                if($z == 0){ 
                                    echo '<p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">Lançamentos pendentes</p>'; 
                                }else{
                                    echo '<p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #333; background-color: #ffedaf; padding: 10px 20px; border-radius: 30px; font-weight: 600; font-size: 14px;"><span class="icon ion-android-warning"></span> '.$z.' Lançamentos pendentes</p>'; 
                                }
                            ?>

                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                            <!-- <div class="btn btn-line-gray size-sm" data-toggle="modal" data-target="#approve_all_releases">
                                    APROVAR TODOS
                            </div> -->

                            <div class="btn btn-line-gray size-sm" data-toggle="modal" data-target="#remove_all_releases">
                                    REMOVER TODOS
                            </div>

                            <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#import_conciliations">
                                    IMPORTAR
                            </div>
                        </div>
                    </div>

                    <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                        <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Data</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Conta</p>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Categoria</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Entidade</p>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;"></p>
                        </div>
                    </div>

                    <?php $x=0; foreach ($query_conciliations as $conciliation) { $x++; ?>

                        <div class="row margin-t-30" style="padding: 0px 10px; position: relative;" id="conciliation_item_<?php echo $conciliation->id; ?>">

                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #999; font-size: 12px;"><?php echo date_format($conciliation->created, 'd/m/Y'); ?></strong>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #333; font-size: 12px;"><?php echo $conciliation->title; ?></strong>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                <strong style="color: #333; font-size: 12px; color: <?php if($conciliation->value > 0){ echo ''; }else{ echo 'red'; } ?>">
                                    R$ <?php echo number_format($conciliation->value, 2, ',', '.'); ?>
                                </strong>
                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                
                                <select type="text" class="form-control required" id="conciliation_account_<?php echo $conciliation->id; ?>" style="font-size: 12px; height: 40px !important; background-color: #fff;">
                                    
                                    <?php foreach ($query_accounts as $account) { ?>

                                        <option value="<?php echo $account->id; ?>" <?php if($account->id == $conciliation->account_id){ echo "selected"; } ?>>
                                            <?php echo $account->bank; ?>
                                        </option>

                                    <?php } ?>
                                    
                                </select>

                            </div>

                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                                
                                <?php if($conciliation->suggest == 1){ ?>

                                    <span class="suggest-conciliation">
                                        Sugestão Link
                                    </span>

                                <?php } ?>

                                <select type="text" class="form-control required" id="conciliation_category_<?php echo $conciliation->id; ?>" style="font-size: 12px; height: 40px !important; background-color: #fff;">
                                    
                                    <?php foreach ($query_categories as $category) { ?>

                                        <?php if($conciliation->value > 0 && $category->type == 'receipt'){ ?>

                                            <option value="<?php echo $category->id; ?>" <?php if($category->id == $conciliation->category_id){ echo "selected"; } ?>>
                                                <?php echo $category->name; ?>
                                            </option>

                                        <?php } ?>

                                        <?php if($conciliation->value < 0 && $category->type == 'payment'){ ?>

                                            <option value="<?php echo $category->id; ?>" <?php if($category->id == $conciliation->category_id){ echo "selected"; } ?>>
                                                <?php echo $category->name; ?>
                                            </option>

                                        <?php } ?>
                                    <?php } ?>
                                    
                                </select>

                            </div>

                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">

                                <span class="material-icons" style="color: #4ff356; display: none;" id="icon-approve-conciliation-<?php echo $conciliation->id; ?>">
                                    check_circle
                                </span>

                                <div class="btn btn-line-gray size-sm btn-approve-conciliation" data-id="<?php echo $conciliation->id; ?>">
                                        APROVAR
                                </div>
                            </div>
                        </div>

                        <hr>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                            <span class="title" style="font-size: 12px;">Você não possui nenhum lançamento para conciliar.</span>
                        </div>

                    <?php } ?>

                </div>
            </div>

        </div>
    </div>
</div>

<?php
    // echo $this->element('footer_panel');
?>
