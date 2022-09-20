
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

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
            <div class="box-white" style="min-height: 310px;">
                <span class="title">Leads recentes</span>

                <hr class="margin-t-20 margin-b-20">

                <?php
                    $y = 0;

                    foreach ($all_contracts as $contract) {
                        $phone_user = "";

                        if($contract->status == 1){
                            
                            foreach ($all_access as $access) {
                                if($contract->id == $access->business_id){
                                    $user_id = $access->user_id;
                                }
                            }

                            foreach ($all_users as $users) {
                                if($users->id == $user_id){
                                    $name_user = $users->name.' '.$users->lastname;
                                    $phone_user = $users->phone;
                                }
                            }

                            $y++;

                            if($contract->action == "abertura"){ $contract_model = "Abertura"; }
                            if($contract->action == "migracao"){ $contract_model = "Migração"; }

                            if($contract->steps == 1){ $contract_steps = "Etapa 1"; }
                            if($contract->steps == 2){ $contract_steps = "Etapa 2"; }
                            if($contract->steps == 3){ $contract_steps = "Etapa 3"; }
                            if($contract->steps == 4){ $contract_steps = "Etapa 4"; }
                            if($contract->steps == 5){ $contract_steps = "Etapa 5"; }

                ?>

                            <a class="box-company" href="/admin/business/<?php echo $contract->id; ?>/view" style="text-transform: none; color: black;">
                                <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; color: <?php if($contract_model == 'Migração'){ echo '#8f2ae2'; }else{ echo '#2ad1e2'; } ?>"><?php echo $contract_model; ?></span>
                                <br>
                                <div class="row">
                                    <span class="document col-10" style="padding-left: 16px;">
                                        <?php echo date_format($contract->created, 'd/m/Y')." às ".date_format($contract->created, 'H:i'); ?>
                                        <br>
                                        <?php echo $name_user; ?>

                                        <?php if($phone_user !== ""){ ?>
                                            <br>
                                            <?php echo $phone_user; ?>
                                        <?php } ?>

                                        <?php echo "<br><strong style='color: #000;'>".$contract_steps."</strong>"; ?>
                                        <br>
                                        <span style="text-transform: uppercase;"><?php echo $contract->razao; ?></span>
                                    </span>
                                    <div class="col-2" style="display: block;float: right;margin-left: auto;">
                                        <icon class="icon ion-ios-arrow-right"></icon>
                                    </div>
                                </div>
                            </a>
                            <hr class="margin-t-20 margin-b-20">

                <?php
                        }
                    }

                    if($y == 0){
                ?>

                <div class="text-center">
                    <span class="icon ion-ios-filing-outline margin-t-30" style="display: block; font-size: 80px; color: #dee0e8;"></span>
                    <p class="text-center margin-t-0 margin-b-30" style="color: #7c808e;">Não existe nenhum lead novo</p>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
            <div class="box-white" style="min-height: 310px;">
                <span class="title">Contratos pendentes</span>

                <hr class="margin-t-20 margin-b-20">

                <?php
                     $x = 0;

                     foreach ($all_contracts as $contract) {
                         $phone_user = "";
 
                         if($contract->sign == 0){
                             
                             foreach ($all_access as $access) {
                                 if($contract->id == $access->business_id){
                                     $user_id = $access->user_id;
                                 }
                             }
 
                             foreach ($all_users as $users) {
                                 if($users->id == $user_id){
                                     $name_user = $users->name.' '.$users->lastname;
                                     $phone_user = $users->phone;
                                 }
                             }
 
                             $x++;
                ?>
                
                            <a class="box-company" href="/admin/business/<?php echo $contract->id; ?>/view" style="text-transform: none; color: black;">
                                <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; color: <?php if($contract_model == 'Migração'){ echo '#8f2ae2'; }else{ echo '#2ad1e2'; } ?>"><?php echo $contract_model; ?></span>
                                <br>
                                <div class="row">
                                    <span class="document col-10" style="padding-left: 16px;">
                                        <?php echo date_format($contract->created, 'd/m/Y')." às ".date_format($contract->created, 'H:i'); ?>
                                        <br>
                                        <?php echo $name_user; ?>

                                        <?php if($phone_user !== ""){ ?>
                                            <br>
                                            <?php echo $phone_user; ?>
                                        <?php } ?>
                                        <br>
                                        <span style="text-transform: uppercase;"><?php echo $contract->razao; ?></span>
                                    </span>
                                    <div class="col-2" style="display: block;float: right;margin-left: auto;">
                                        <icon class="icon ion-ios-arrow-right"></icon>
                                    </div>
                                </div>
                            </a>
                            <hr class="margin-t-20 margin-b-20">

                <?php
                        }
                    }

                    if($x == 0){
                ?>

                    <div class="text-center">
                        <span class="icon ion-ios-filing-outline margin-t-30" style="display: block; font-size: 80px; color: #dee0e8;"></span>
                        <p class="text-center margin-t-0 margin-b-30" style="color: #7c808e;">Não existe nenhum cliente novo</p>
                    </div>

                <?php
                    }
                ?>
            </div>
        </div>

        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
            <div class="box-white" style="min-height: 310px;">
                <span class="title">Contratos em andamento</span>

                <hr class="margin-t-20 margin-b-20">

                <?php
                    $z = 0;

                    foreach ($all_contracts as $contract) {

                        if($contract->status == 2){
                            $z++;

                            // Razao
                            $contract_razao = "";
                            $contract_document = "";

                            // Type Contract
                            if($contract->contract == "abertura"){ $contract_model = "Abertura"; }
                            if($contract->contract == "migracao"){ $contract_model = "Migração"; }

                ?>

                            <a class="box-company" href="/admin/business/<?php echo $contract->id; ?>/view" style="text-transform: none; color: black;">
                                <span style="font-size: 10px; font-weight: 800; text-transform: uppercase; color: <?php if($contract_model == 'Migração'){ echo '#8f2ae2'; }else{ echo '#2ad1e2'; } ?>"><?php echo $contract_model; ?></span>
                                <br>
                                <div class="row">
                                    <span class="document col-10" style="padding-left: 16px;">
                                        <?php echo date_format($contract->created, 'd/m/Y')." às ".date_format($contract->created, 'H:i'); ?>
                                        <br>
                                        <?php echo $name_user; ?>

                                        <?php if($phone_user !== ""){ ?>
                                            <br>
                                            <?php echo $phone_user; ?>
                                        <?php } ?>
                                        <br>
                                        <span style="text-transform: uppercase;"><?php echo $contract->razao; ?></span>
                                    </span>
                                    <div class="col-2" style="display: block;float: right;margin-left: auto;">
                                        <icon class="icon ion-ios-arrow-right"></icon>
                                    </div>
                                </div>
                            </a>
                            <hr class="margin-t-20 margin-b-20">

                <?php
                        }
                    }

                    if($z == 0){
                ?>

                    <div class="text-center">
                        <span class="icon ion-ios-filing-outline margin-t-30" style="display: block; font-size: 80px; color: #dee0e8;"></span>
                        <p class="text-center margin-t-0 margin-b-30" style="color: #7c808e;">Não existe nenhum cliente novo</p>
                    </div>

                <?php
                    }
                ?>
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
