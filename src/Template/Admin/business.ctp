
<?php

    if($type_select == "all"){ $type_select_text = "Todas empresas"; }
    if($type_select == "1"){ $type_select_text = "Lead"; }
    if($type_select == "2"){ $type_select_text = "Em abertura"; }
    if($type_select == "3"){ $type_select_text = "Em migração"; }
    if($type_select == "4"){ $type_select_text = "Ativas"; }
    if($type_select == "5"){ $type_select_text = "Inativas"; }
    if($type_select == "6"){ $type_select_text = "Canceladas"; }

    if($status_select == "all"){ $status_select_text = "Todos"; }
    if($status_select == "s"){ $status_select_text = "Prestação de serviços"; }
    if($status_select == "c"){ $status_select_text = "Comércio"; }
    if($status_select == "sc"){ $status_select_text = "Prestação de serviços e Comércio"; }
    if($status_select == "mei"){ $status_select_text = "Micro empreendedor individual"; }
    if($status_select == "domestico"){ $status_select_text = "Empregado doméstico"; }
    if($status_select == "inativa"){ $status_select_text = "Empresa inativa"; }
    if($status_select == "liberal"){ $status_select_text = "Profissional Liberal ou Autonomo"; }

?>

<!-- Menu Page -->
<div class="menu-page">

  <span class="title-page">Empresas</span>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row margin-t-50">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <span style="float: left; font-size: 12px; margin-top: 5px;">Tipo de empresa:</span>

            <div class="box-filter">
                Todos tipos &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                <div class="space-itens"></div>

                <div class="itens-filter scroll-active" style="width: 200px;">
                    <a href="?type=all&status=<?= $status_select; ?>" class="item-filter">Todos tipos</a>
                    <a href="?type=s&status=<?= $status_select; ?>" class="item-filter">Prestação de serviços</a>
                    <a href="?type=c&status=<?= $status_select; ?>" class="item-filter">Comércio</a>
                    <a href="?type=sc&status=<?= $status_select; ?>" class="item-filter">Prestação de serviços e Comércio</a>
                    <a href="?type=mei&status=<?= $status_select; ?>" class="item-filter">Micro empreendedor individual</a>
                    <a href="?type=domestico&status=<?= $status_select; ?>" class="item-filter">Empregado doméstico</a>
                    <a href="?type=inativa&status=<?= $status_select; ?>" class="item-filter">Empresa inativa</a>
                    <a href="?type=liberal&status=<?= $status_select; ?>" class="item-filter">Profissional Liberal ou Autonomo</a>
                </div>
            </div>

            <span style="float: left; font-size: 12px; margin-top: 5px; margin-left: 30px;">Filtrar por:</span>

            <div class="box-filter">
                Todas empresas &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                <div class="space-itens"></div>

                <div class="itens-filter scroll-active">
                    <a href="?type=<?= $type_select; ?>&status=all" class="item-filter">Todas empresas</a>
                    <a href="?type=<?= $type_select; ?>&status=1" class="item-filter">Lead</a>
                    <a href="?type=<?= $type_select; ?>&status=2" class="item-filter">Em abertura</a>
                    <a href="?type=<?= $type_select; ?>&status=3" class="item-filter">Em migração</a>
                    <a href="?type=<?= $type_select; ?>&status=4" class="item-filter">Ativas</a>
                    <a href="?type=<?= $type_select; ?>&status=5" class="item-filter">Inativas</a>
                    <a href="?type=<?= $type_select; ?>&status=6" class="item-filter">Canceladas</a>
                </div>
            </div>

        </div>
    </div>

    <!-- QUADROS -->
    <div class="row margin-t-40">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <?php $x=0; foreach ($all_business as $business) { $x++; ?>

                <?php
                    if($business->status == 1){ $status_select_text = "Novo lead"; $status_color = "#eca523"; }
                    if($business->status == 2){ $status_select_text = "Em abertura"; $status_color = "#eca523"; }
                    if($business->status == 3){ $status_select_text = "Em migração"; $status_color = "#eca523"; }
                    if($business->status == 4){ $status_select_text = "Ativo"; $status_color = "#eca523"; }
                    if($business->status == 5){ $status_select_text = "Inativo"; $status_color = "#ff3576"; }
                    if($business->status == 6){ $status_select_text = "Cancelado"; $status_color = "#ff3576"; }

                    if($business->taxation == "simples"){ $taxation_text = "Simples Nacional"; }
                    if($business->taxation == "lucro"){ $taxation_text = "Lucro presumido"; }
                    if($business->taxation == "real"){ $taxation_text = "Lucro real"; }

                    if($business->type == "s"){ $type_text = "Prestação de serviços"; }
                    if($business->type == "c"){ $type_text = "Comércio"; }
                    if($business->type == "sc"){ $type_text = "Prestação de serviços e Comércio"; }
                    if($business->type == "mei"){ $type_text = "Micro empreendedor individual"; }
                    if($business->type == "domestico"){ $type_text = "Empregado doméstico"; }
                    if($business->type == "inativa"){ $type_text = "Empresa inativa"; }
                    if($business->type == "inativa"){ $type_text = "Empresa inativa"; }
                    if($business->type == "liberal"){ $type_text = "Profissional Liberal ou Autonomo"; }
                ?>

                <a href="/admin/business/<?= $business->id; ?>/view" class="box-white size-auto" style="display: block; margin-top: 5px; text-decoration: none; padding: 20px 30px; padding-left: 90px;">

                    <div class="box-name-business"><?php echo substr($business->fantasia, 0, 1); ?></div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: <?= $status_color; ?>; font-weight: 600;"><?= $status_select_text; ?></span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?php if($business->fantasia == ""){ echo $business->razao; }else{ echo $business->fantasia; } ?></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: #999; font-weight: 500;"><?= $taxation_text; ?></span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?= $type_text; ?></span>
                        </div>

                        <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: #999; font-weight: 500;">Criado em <?= date_format($business->created, 'd/m/Y')." às ".date_format($business->created, 'h:i'); ?></span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?php echo $business->city." - ".$business->state; ?></span>
                        </div>
                    </div>

                </a>

            <?php } ?>

            <?php if($x == 0){ ?>

                <div class="box-white size-xs">

                    <div class="text-center" style="margin-top: 40px; padding-bottom: 50px;">
                        <span class="title-box margin-t-10" style="margin-bottom: 5px; font-size: 20px;">Ops...</span>
                        <span class="title">Você não possui nenhuma empresa ainda.</span>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>
