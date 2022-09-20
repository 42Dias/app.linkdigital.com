
<!-- Menu Page -->
<div class="menu-page">

  <span class="title-page">Visão geral</span>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">trending_up</i>
                <span class="title">Novos Leads</span>
                <span class="number yellow"><?= $total_leads; ?></span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">description</i>
                <span class="title">Contratos Ativos</span>
                <span class="number dark"><?= $total_contracts; ?></span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">outlined_flag</i>
                <span class="title">Clientes pendentes</span>
                <span class="number dark"><?= $total_pendentes; ?></span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs" style="padding-left: 80px;">
                <i class="icon material-icons-outlined">book</i>
                <span class="title">Cancelamentos</span>
                <span class="number dark"><?= $total_cancelamentos; ?></span>
            </div>
        </div>
    </div>

    <!-- QUADROS -->
    <!-- <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Extratos</span>

            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Notas Fiscais</span>

            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-lg">
                <span class="title-box">Documentos</span>

            </div>
        </div>
    </div> -->

</div>

<?php
    echo $this->element('footer_panel');
?>
