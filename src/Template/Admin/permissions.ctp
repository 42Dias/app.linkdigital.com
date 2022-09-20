
<?php echo $this->element('update_permission'); ?>
<?php echo $this->element('add_user'); ?>
<!-- Menu Page -->
<div class="menu-page">

  <span class="title-page">Nível de Permissão</span>
  <button class="btn btn-yellow size-lg margin-r-50" style="float:right;"  data-toggle="modal" data-target="#add_user">Adicionar Usuário</button>

</div>

<div class="area-actions" style="padding-top: 0px;">
    <!-- QUADROS -->
    <div class="row margin-t-40">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

        <?php 
            $permission = "";
            foreach ($all_business as $business) { 

                if($business->permission == 2){ $permission = "WebMaster"; }
                if($business->permission == 3){ $permission = "Direção"; }
                if($business->permission == 4){ $permission = "Fiscal"; }
                if($business->permission == 5){ $permission = "Pessoal"; }
                if($business->permission == 6){ $permission = "Financeiro"; }
                if($business->permission == 7){ $permission = "Contábil"; }
                if($business->permission == 8){ $permission = "Cadastro"; }
                if($business->permission == 9){ $permission = "Administrativo"; }
                if($business->permission == 10){ $permission = "Legalização"; }
                if($business->permission == 11){ $permission = "Atendimento"; }
                if($business->permission == 12){ $permission = "Treinamento"; }
                if($business->permission == 13){ $permission = "Comercial"; }
                if($business->permission == 14){ $permission = "Marketing"; }
        ?>
                <div class="box-white size-auto btn-open-permission" data-id="<?php echo $business->id; ?>" style="display: block; margin-top: 5px; text-decoration: none; padding: 20px 30px; padding-left: 90px;">

                    <div class="box-name-business"><?php echo substr($business->name, 0, 1); ?></div>

                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: #999; font-weight: 600;">Nome: </span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?php echo $business->name.' '.$business->lastname; ?></span>
                        </div>

                        <div class="col-xl-4 col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: #999; font-weight: 500;">E-mail: </span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?php echo $business->username; ?></span>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">
                            <span style="font-size: 12px; color: #999; font-weight: 500;">Nível de Permissão: </span>
                            <br>
                            <span style="font-size: 14px; color: #666; font-weight: 600;"><?= $permission; ?></span>
                        </div>
                    </div>

                </div>

            <?php } ?>

        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>
