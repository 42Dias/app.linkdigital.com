
<?php

    if($month_select == "01"){ $month_select_text = "Janeiro"; }
    if($month_select == "02"){ $month_select_text = "Fevereiro"; }
    if($month_select == "03"){ $month_select_text = "Março"; }
    if($month_select == "04"){ $month_select_text = "Abril"; }
    if($month_select == "05"){ $month_select_text = "Maio"; }
    if($month_select == "06"){ $month_select_text = "Junho"; }
    if($month_select == "07"){ $month_select_text = "Julho"; }
    if($month_select == "08"){ $month_select_text = "Agosto"; }
    if($month_select == "09"){ $month_select_text = "Setembro"; }
    if($month_select == "10"){ $month_select_text = "Outubro"; }
    if($month_select == "11"){ $month_select_text = "Novembro"; }
    if($month_select == "12"){ $month_select_text = "Dezembro"; }

    if($status_select == "all"){ $status_select_text = "Todos"; }
    if($status_select == "0"){ $status_select_text = "Atrasados"; }
    if($status_select == "1"){ $status_select_text = "Em aberto"; }
    if($status_select == "2"){ $status_select_text = "Pagos"; }

?>

<!-- Menu Page -->
<div class="menu-page">
  <span class="title-page">Documentos</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row margin-t-50">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <span style="float: left; font-size: 12px; margin-top: 5px;">Filtrar por:</span>

            <div class="box-filter">
                <?= $month_select_text; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                <div class="space-itens"></div>

                <div class="itens-filter scroll-active">
                    <a href="?month_select=01&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Janeiro</a>
                    <a href="?month_select=02&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Fevereiro</a>
                    <a href="?month_select=03&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Março</a>
                    <a href="?month_select=04&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Abril</a>
                    <a href="?month_select=05&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Maio</a>
                    <a href="?month_select=06&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Junho</a>
                    <a href="?month_select=07&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Julho</a>
                    <a href="?month_select=08&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Agosto</a>
                    <a href="?month_select=09&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Setembro</a>
                    <a href="?month_select=10&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Outubro</a>
                    <a href="?month_select=11&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Novembro</a>
                    <a href="?month_select=12&year_select=<?= $year_select; ?>&status=<?= $status_select; ?>" class="item-filter">Dezembro</a>
                </div>
            </div>

            <div class="box-filter">
                <?= $year_select; ?>  &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                <div class="space-itens"></div>

                <div class="itens-filter scroll-active">
                    <a href="?month_select=<?= $month_select; ?>&year_select=2019&status=<?= $status_select; ?>" class="item-filter">2019</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2018&status=<?= $status_select; ?>" class="item-filter">2018</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2017&status=<?= $status_select; ?>" class="item-filter">2017</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2016&status=<?= $status_select; ?>" class="item-filter">2016</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2015&status=<?= $status_select; ?>" class="item-filter">2015</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2014&status=<?= $status_select; ?>" class="item-filter">2014</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2013&status=<?= $status_select; ?>" class="item-filter">2013</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2012&status=<?= $status_select; ?>" class="item-filter">2012</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2011&status=<?= $status_select; ?>" class="item-filter">2011</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=2010&status=<?= $status_select; ?>" class="item-filter">2010</a>
                </div>
            </div>

            <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Vencimento:</span>

            <div class="box-filter">
                <?= $status_select_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                <div class="space-itens"></div>

                <div class="itens-filter scroll-active">
                    <a href="?month_select=<?= $month_select; ?>&year_select=<?= $year_select; ?>&status=all" class="item-filter">Todos</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=<?= $year_select; ?>&status=0" class="item-filter">Atrasados</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=<?= $year_select; ?>&status=1" class="item-filter">Em aberto</a>
                    <a href="?month_select=<?= $month_select; ?>&year_select=<?= $year_select; ?>&status=2" class="item-filter">Pagos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- QUADROS -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_document_client">
                <i class="material-icons-outlined">add</i>
                <span class="date"></span>
                <span class="title" style="color: #999;">Adicionar <br>novo documento</span>
            </div>

        </div>
    </div>

    <div class="row margin-t-40" style="background-color: #efefef; padding: 10px; border-radius: 10px;">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Área</p>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Descrição</p>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Tipo de documento</p>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Data</p>
        </div>

        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;"></p>
        </div>
    </div>

    <!-- QUADROS -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <?php $x=0; foreach ($all_documents as $documents) { $x++; ?>

                <!-- <div class="box-file client btn-open-documents" data-id="<?= $documents->id; ?>">
                    <i class="material-icons-outlined">folder</i>
                    <span class="date"><?= date_format($documents->date, 'd/m/Y'); ?></span>
                    <span class="title"><?= strval($documents->title); ?></span>
                </div> -->

                <div class="box-file client btn-open-documents" data-id="<?= $documents->id; ?>" style="padding-left: 30px;">
                    <!-- <i class="material-icons-outlined">description</i> -->
                    
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <span class="date"><?php echo strval($documents->title); ?></span>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 animate-scroll">
                            <span class="date"><?php echo $documents->description; ?></span>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <span class="title"><?php echo $documents->type; ?></span>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <span class="title"><?= date_format($documents->date, 'd/m/Y'); ?></span>
                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                            <p class="text" style="margin-bottom: 0px; color: #666; font-weight: 600;">Download</p>
                        </div>
                    </div>

                </div>

            <?php } ?>

            <?php if($x == 0){ ?>

                <!-- <div class="box-white size-xs">

                    <div class="text-center" style="margin-top: 40px; padding-bottom: 50px;">
                        <span class="title-box margin-t-10" style="margin-bottom: 5px; font-size: 20px;">Ops...</span>
                        <span class="title">Você não possui nenhum documento.</span>
                    </div>
                </div> -->

            <?php } ?>

        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>
