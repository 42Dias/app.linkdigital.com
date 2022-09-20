
<?php
    echo $this->element('add_account');

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
  <span class="title-page">Contas</span>
</div>


<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 12 -->
            <div class="box-tab-content active margin-t-20" id="tab-content-12">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php $count_accounts=0; foreach ($query_accounts as $account) { $count_accounts++; } ?>

                            <p class="text" style="margin-top: 5px; margin-bottom: 0px; color: #666;">
                                <?php echo $count_accounts; ?> contas encontradas
                            </p>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                            <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_account">
                                    NOVA CONTA
                            </div>
                        </div>
                    </div>

                    <div class="row margin-t-30" style="padding: 0px 10px; position: relative;">

                        <?php $x=0; foreach ($query_accounts as $account) { $x++; ?>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <div style="background-color: #fff; padding: 30px; box-shadow: 0px 2px 5px rgba(0,0,0,.2); border-radius: 10px; min-height: 160px;">

                                    <strong style="color: #333; font-size: 18px;"><?php echo $account->bank; ?></strong>
                                    <br>
                                    <strong style="color: #868686; font-size: 12px;"><?php echo $account->agency; ?></strong> | 
                                    <strong style="color: #868686; font-size: 12px;"><?php echo $account->account; ?></strong>
                                    <br>
                                    <strong style="color: #868686; font-size: 12px;"><?php echo $account->account_type; ?></strong>
                                    

                                    <div style="position: absolute; right: 35px; bottom: 30px;">
                                        <strong style="color: #28bd56; font-size: 14px;">R$ <?php echo number_format($account->total, 2, ',', '.'); ?></strong>
                                    </div>

                                    <div style="position: absolute; right: 30px; top: 20px;">
                                        <i class="material-icons-outlined btn_send_form" style="cursor: pointer; color: #868686;"
                                            data-url="/api/web/custom/accounts/<?php echo $account->id; ?>/delete" data-form="#form" data-redirect="none">delete</i>
                                    </div>

                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                            <span class="title" style="font-size: 12px;">O cliente não possui nenhuma conta bancária.</span>
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
