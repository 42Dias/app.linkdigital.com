
<div class="modal fade" id="update_permission" tabindex="-1" role="dialog" aria-labelledby="update_permissionLabel" aria-hidden="true">
    <div class="modal-dialog size-small" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h4 style="font-weight: 500; color: #333;">Atualizar Permissão</h4>
            </div>
            <div class="modal-body">

            <?php $permission = ""; 
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
                
                    <form method="POST" id="form-update-permission-<?php echo $business->id; ?>"> 
                        <input type="hidden" name="id" value="<?php echo $business->id; ?>" />
                        <div class="text-center item-permission" id="item-permission-<?= $business->id; ?>" style="display: none;">

                            <h3 style="font-weight: 500; color: #666; margin-top: 10px;"><?= $business->name.' '.$business->lastname; ?></h3>
                            <br>

                            <div class="row">
                                <div class="col-xl-12 margin-mobile-b-30">
                                    <span style="color: #999; font-size: 12px;">Permissão:</span>
                                    <strong style="color: #333; font-size: 14px;"><?= $permission; ?></strong>
                                    <br>
                                </div>
                            </div>

                            <br>

                            <div class="row margin-t-10">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30">
                                    <select class="form-control required margin-t-20" name="permission" style="font-size: 14px; background-color: #fff;">
                                        <option value="">Selecionar Nova Permissão</option>
                                        <option value="2">WebMaster</option>
                                        <option value="3">Direção</option>
                                        <option value="4">Fiscal</option>
                                        <option value="5">Pessoal</option>
                                        <option value="6">Financeiro</option>
                                        <option value="7">Contábil</option>
                                        <option value="8">Cadastro</option>
                                        <option value="9">Administrativo</option>
                                        <option value="10">Legalização</option>
                                        <option value="11">Atendimento</option>
                                        <option value="12">Treinamento</option>
                                        <option value="13">Comercial</option>
                                        <option value="14">Marketing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="btn btn-yellow margin-t-50 size-lg btnUpdatePermission" data-id="<?= $business->id; ?>">
                                Atualizar
                            </div>

                            <div class="btn btn-yellow margin-t-50 size-lg btnDeleteUser" data-id="<?= $business->id; ?>" style="background-color: #ff3c3c;">
                                Deletar Usuário
                            </div>

                        </div>
                    </form>

                <?php } ?>

            </div>
        </div>
    </div>
</div>
