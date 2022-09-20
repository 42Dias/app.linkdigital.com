
<?php

echo $this->element('add_payment');
echo $this->element('update_payment');

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

$tab_select = "";

if(isset($_GET["tab_select"])){
    $tab_select = $_GET["tab_select"];
}

?>

<!-- Menu Page -->
<div class="menu-page">

<div class="row">

    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
        <span class="title-page">Estoque</span>
    </div>

    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

        <div class="btn btn-line-gray size-sm btn_send_form" style="display: block; float: right; margin-left: 0px; padding: 15px 25px;"
                data-url="" data-form="" data-redirect="none">
                FILTRAR
        </div>

        <select type="text" class="form-control margin-r-10" name="report_type"  style=" float: right; font-size: 12px; background-color: #fff; width: auto; display: inline-block; height: 45px !important;">
            <option value="/client/finances/reports/dre-anual-horizontal">Hoje</option>    
            <option value="/client/finances/reports/dre-anual-horizontal">Últimos 3 dias</option>
            <option value="/client/finances/reports/dre-anual-horizontal">Últimos 7 dias</option>
            <option value="/client/finances/reports/dre-anual-horizontal">Últimos 15 dias</option>
            <option value="/client/finances/reports/dre-anual-horizontal">Últimos 30 dias</option>
        </select>

        <?php

            $date = date_format($date_now, 'd/m/Y');
            $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

        ?>

        <div class="input-date1" style='width: 150px; float: right; margin-right: 10px;'>
            <div class="icon ion-android-calendar arrow"></div>

            <input type="text" class="form-control add-date" name="date_end"
            value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-end">

            <!-- Datepicker -->
            <div class="box-datepicker1 client" style="top: 0px !important; left: -130px !important;">
                <div class="datepicker1" data-date="<?= h($date_input); ?>" data-id="#date-report-end"></div>
            </div>

        </div>

        <?php

            $date = '01/01/2021';
            $date_input = substr($date,8 ,2)."/".substr($date,5 ,2)."/".substr($date,0 ,4);

        ?>

        <div class="input-date" style='width: 150px; float: right; margin-right: 10px;'>
            <div class="icon ion-android-calendar arrow"></div>

            <input type="text" class="form-control add-date" name="date_begin"
            value="<?= $date; ?>" placeholder="" style="cursor: pointer; height: 45px !important;" id="date-report-begin">

            <!-- Datepicker -->
            <div class="box-datepicker client" style="top: 0px !important; left: -130px !important;">
                <div class="datepicker" data-date="<?= h($date_input); ?>" data-id="#date-report-begin"></div>
            </div>

        </div>
        

        <div class="clear"></div>

    </div>
</div>

</div>

<div class="area-actions" style="padding-top: 0px;">

<!-- QUADROS -->
<div class="row">

    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

        <!-- TAB 13 -->
        <div class="box-tab-content active margin-t-40" >

            <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                        <div class="box-tabs" style="margin-top: 0px;">
                            <a href="/client/stock?tab_select=all" class="tab-item <?php if($tab_select == '' || $tab_select == 'all'){ echo 'active'; } ?>" data-open="#tab-content-all">Todos</a>
                            <a href="/client/stock?tab_select=active" class="tab-item <?php if($tab_select == 'active'){ echo 'active'; } ?>" data-open="#tab-content-active">Em estoque</a>
                            <a href="/client/stock?tab_select=sold" class="tab-item <?php if($tab_select == 'sold'){ echo 'active'; } ?>" data-open="#tab-content-sold">Em falta</a>
                            <div class="clear"></div>
                        </div>

                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right animate-scroll">

                        <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_product">
                                NOVO PRODUTO
                        </div>
                    </div>
                </div>

                <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Título</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Estoque</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Icms</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Pis</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Cofins</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Valor</p>
                    </div>
                </div>

                <!-- :::::::::::::::::::::::: -->
                
                <div class="row margin-t-10" style="padding: 10px; border-radius: 10px;">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Camiseta Branca</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">15</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">R$ 256,00</p>
                    </div>
                </div>
                
                <div class="row margin-t-10" style="padding: 10px; border-radius: 10px;">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Camiseta Verde</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">15</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">R$ 187,00</p>
                    </div>
                </div>
                
                <div class="row margin-t-10" style="padding: 10px; border-radius: 10px;">
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Camiseta Azul</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">9</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">0.00%</p>
                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                        <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">R$ 344,00</p>
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
