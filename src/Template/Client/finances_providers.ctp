
<?php

    echo $this->element('add_provider');
    echo $this->element('add_file');
    echo $this->element('add_note');

    echo $this->element('import_providers');
    // echo $this->element('export_providers');

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

    <div class="row">

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">
            <span class="title-page">Fornecedores</span>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="btn btn-yellow size-sm" style="display: block; float: right; margin-left: 0px;"
                data-toggle="modal" data-target="#import_providers">
                    IMPORTAR
            </div>

            <div class="btn btn-line-gray size-sm margin-r-10" style="display: block; float: right; margin-left: 0px;"
                data-toggle="modal" data-target="#export_providers">
                    EXPORTAR
            </div>

        </div>
    </div>

</div>


<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 9 -->
            <div class="box-tab-content active margin-t-20" >

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row margin-t-20">

                        <!-- ACCOUNTS -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <div style="max-height: 400px; overflow: scroll; overflow-x: hidden;">

                                <!-- <div class="btn btn-yellow size-sm" data-toggle="modal" data-target="#add_customer" style="width: 100%; margin-left: 10px;">
                                    NOVO CLIENTE
                                </div> -->

                                <div data-toggle="modal" data-target="#add_provider" class="box-client-item" style="cursor: pointer; text-align: center; background-color: #ffcf31; border: #ffcf31; margin-bottom: 20px;">
                                    <strong style="color: #333; font-size: 12px;">
                                        NOVO FORNECEDOR
                                    </strong>
                                </div>

                                <?php $total_providers=0; foreach ($query_providers as $provider) { $total_providers++; ?>

                                    <a href="?tab_select=9&provider_id=<?php echo $provider->id; ?>" class="box-client-item <?php if($provider_selected_id == $provider->id){ echo "active"; } ?>" style="">
                                        <strong style="color: #333; font-size: 12px;">
                                        
                                            <?php
                                                if($provider->type == 'pj'){
                                                    echo $provider->pj_razao;
                                                }else{
                                                    echo $provider->pf_name;
                                                }
                                            ?>

                                        </strong>
                                    </a>

                                <?php } ?>

                            </div>

                        </div>

                        <!-- RELEASES -->
                        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php if($total_providers > 0){ ?>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <?php 
                                        $provider_name = '';
                                        $provider_document = '';
                                        $provider_phone = '';
                                        $provider_email = '';
                                        $provider_type = '';
                                        $provider_pj_document = '';
                                        $provider_pj_fantasia = '';
                                        $provider_pj_razao = '';
                                        $provider_pj_insc = '';
                                        $provider_pf_document = '';
                                        $provider_pf_name = '';
                                        $provider_mobile = '';
                                        $provider_contact = '';
                                        $provider_zipcode = '';
                                        $provider_address = '';
                                        $provider_number = '';
                                        $provider_complement = '';
                                        $provider_district = '';
                                        $provider_city = '';
                                        $provider_state = '';
                                        $provider_country = '';
                                        $provider_bank = '';
                                        $provider_agency = '';
                                        $provider_account = '';
                                        $provider_account_type = '';
                                        $provider_site = '';
                                        $provider_created = '';
                                        $provider_updated = '';

                                        foreach ($query_providers as $provider){ 
                                            if($provider->id == $provider_selected_id){
                                                
                                                if($provider->type == 'pj'){
                                                    $provider_name =  $provider->pj_razao;
                                                }else{
                                                    $provider_name = $provider->pf_name;
                                                }

                                                if($provider->type == 'pj'){
                                                    $provider_document =  $provider->pj_document;
                                                }else{
                                                    $provider_document = $provider->pf_document;
                                                }

                                                $provider_phone = $provider->phone;
                                                $provider_email = $provider->email;
                                                $provider_type = $provider->type;
                                                $provider_pj_document = $provider->pj_document;
                                                $provider_pj_fantasia = $provider->pj_fantasia;
                                                $provider_pj_razao = $provider->pj_razao;
                                                $provider_pj_insc = $provider->pj_insc;
                                                $provider_pf_document = $provider->pf_document;
                                                $provider_pf_name = $provider->pf_name;
                                                $provider_mobile = $provider->mobile;
                                                $provider_contact = $provider->contact;
                                                $provider_zipcode = $provider->zipcode;
                                                $provider_address = $provider->address;
                                                $provider_number = $provider->number;
                                                $provider_complement = $provider->complement;
                                                $provider_district = $provider->district;
                                                $provider_city = $provider->city;
                                                $provider_state = $provider->state;
                                                $provider_country = $provider->country;
                                                $provider_bank = $provider->bank;
                                                $provider_agency = $provider->agency;
                                                $provider_account = $provider->account;
                                                $provider_account_type = $provider->account_type;
                                                $provider_site = $provider->site;
                                                $provider_created = $provider->created;
                                                $provider_updated = $provider->updated;

                                            }
                                        }
                                    ?>

                                    <h3 style="font-weight: 600; color: #333;"><?= $provider_name; ?></h3>
                                    <p style="font-weight: 600; color: #999; font-size: 14px; margin-top: 5px;">
                                    <?= $provider_document; ?>&nbsp; | &nbsp;<?= $provider_email; ?>&nbsp; | &nbsp;<?= $provider_phone; ?>
                                    </p>

                                    <hr class="margin-t-30">

                                    <div class="row margin-t-30">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas pagas</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #1bda44; font-weight: 600;">R$ <?php echo number_format($total_closed, 2, ',', '.'); ?></p>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas a pagar</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #333; font-weight: 600;">R$ <?php echo number_format($total_open, 2, ',', '.'); ?></p>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas vencidas</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #f33535; font-weight: 600;">R$ <?php echo number_format($total_loser, 2, ',', '.'); ?></p>
                                        </div>
                                    </div>

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Últimos Recebimentos</h4>
                                    <br>

                                    <?php $x=0; foreach ($query_receipts as $receipt) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $receipt->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo strval($receipt->title); ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo $receipt->value; ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date"><?= date_format($receipt->maturity, 'd/m/Y'); ?></span>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br>

                                    <h4 style="font-weight: 500; color: #333;">Arquivos</h4>

                                    <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_file">
                                        <i class="material-icons-outlined" style="top: 12px;">add</i>
                                        <span class="date"></span>
                                        <span class="title" style="color: #999;">Adicionar arquivo</span>
                                    </div>

                                    <div class="clear"></div>

                                    <?php $x=0; foreach ($query_files as $file) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $file->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="title"><?php echo $file->url; ?></span>
                                                </div>

                                                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date">Enviado <?= date_format($file->created, 'd/m/Y H:m'); ?></span>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <a href="../../uploads/files/<?php echo $file->url; ?>" target="blank_" class="btn btn-line-gray size-sm">Download</a>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <div class="btn btn-line-gray size-sm btn_send_form" data-url="/api/web/custom/files/<?php echo $file->id; ?>/delete" data-form="none" data-redirect="none">Excluir</div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                    <br><br>

                                    <h4 style="font-weight: 500; color: #333;">Anotações</h4>
                                    
                                    <div class="box-file add client btn-add-document" data-toggle="modal" data-target="#add_note">
                                        <i class="material-icons-outlined" style="top: 12px;">add</i>
                                        <span class="date"></span>
                                        <span class="title" style="color: #999;">Adicionar anotação</span>
                                    </div>

                                    <div class="clear"></div>

                                    <?php $x=0; foreach ($query_notes as $note) { $x++; ?>

                                        <div class="box-file client" data-id="<?= $note->id; ?>" style="padding-left: 30px;">
                                            <!-- <i class="material-icons-outlined">description</i> -->
                                            
                                            <div class="row">
                                                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 animate-scroll">
                                                    <span class="date"><?= date_format($note->created, 'd/m/Y'); ?></span>
                                                    <span class="title"><?php echo $note->text; ?></span>
                                                </div>

                                                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12 animate-scroll">
                                                    <div class="btn btn-line-gray size-sm btn_send_form" data-url="/api/web/custom/notes/<?php echo $note->id; ?>/delete" data-form="none" data-redirect="none">Excluir</div>
                                                </div>
                                            </div>

                                        </div>

                                        <hr>

                                    <?php } ?>

                                    <div class="clear"></div>

                                    <br><br>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br>
                                    <h4 style="font-weight: 500; color: #333;">Editar fornecedor</h4>
                                    <hr>

                                    <form id="form_update_provider">

                                        <input type='hidden' name="provider_id" value="<?= $provider->id; ?>" id="provider_id">

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de cliente</p>
                                                <select type="text" class="form-control required" name="provider_type" id="input_provider_type" data-type="provider" style="font-size: 14px; background-color: #fff;">
                                                    <option value="pj" <?php if($provider->type == 'pj'){ echo 'selected'; } ?>>Pessoa jurídica</option>
                                                    <option value="pf" <?php if($provider->type == 'pf'){ echo 'selected'; } ?>>Pessoa física</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div id="area_provider_pj">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                                    <input type="text" class="form-control accountant mask-cnpj" name="provider_pj_document" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pj_document; ?>">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                                    <input type="text" class="form-control accountant" name="provider_pj_fantasia" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pj_fantasia; ?>">
                                                
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                                    <input type="text" class="form-control accountant" name="provider_pj_razao" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pj_razao; ?>">
                                                    
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                                    <input type="text" class="form-control accountant" name="provider_pj_insc" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pj_insc; ?>">
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div id="area_provider_pf" style="display: none;">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                                    <input type="text" class="form-control accountant mask-cpf" name="provider_pf_document" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pf_document; ?>">
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                                    <input type="text" class="form-control accountant" name="provider_pf_name" style="font-size: 14px; background-color: #fff;" value="<?= $provider_pf_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TABS -->
                                        <div class="box-tabs update no-link">
                                            <a class="tab-item active" data-open="#tab_content_update_provider_1" data-type="provider" style="font-size: 12px;">Contato</a>
                                            <a class="tab-item" data-open="#tab_content_update_provider_2" data-type="provider" style="font-size: 12px;">Endereço</a>
                                            <a class="tab-item" data-open="#tab_content_update_provider_3" data-type="provider" style="font-size: 12px;">Dados bancários</a>
                                            <a class="tab-item" data-open="#tab_content_update_provider_4" data-type="provider" style="font-size: 12px;">Adicionais</a>
                                            <div class="clear"></div>
                                        </div>

                                        <!-- TAB 1 -->
                                        <div class="box-tab-content active" id="tab_content_update_provider_1" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                                        <input type="text" class="form-control accountant" name="provider_email" style="font-size: 14px; background-color: #fff;" value="<?= $provider_email; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                                        <input type="text" class="form-control accountant mask-phonefixed" name="provider_phone" style="font-size: 14px; background-color: #fff;" value="<?= $provider_phone; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                                        <input type="text" class="form-control accountant mask-phone" name="provider_mobile" style="font-size: 14px; background-color: #fff;" value="<?= $provider_mobile; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                                        <input type="text" class="form-control accountant" name="provider_contact" style="font-size: 14px; background-color: #fff;" value="<?= $provider_contact; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 2 -->
                                        <div class="box-tab-content" id="tab_content_update_provider_2" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                                        <input type="text" class="form-control accountant mask-cep" name="provider_zipcode" style="font-size: 14px; background-color: #fff;" value="<?= $provider_zipcode; ?>">
                                                    </div>

                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                                        <input type="text" class="form-control accountant" name="provider_address" style="font-size: 14px; background-color: #fff;" value="<?= $provider_address; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                                        <input type="text" class="form-control accountant" name="provider_number" style="font-size: 14px; background-color: #fff;" value="<?= $provider_number; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                                        <input type="text" class="form-control accountant" name="provider_complement" style="font-size: 14px; background-color: #fff;" value="<?= $provider_complement; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                                        <input type="text" class="form-control accountant" name="provider_district" style="font-size: 14px; background-color: #fff;" value="<?= $provider_district; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                                        <input type="text" class="form-control accountant" name="provider_city" style="font-size: 14px; background-color: #fff;" value="<?= $provider_city; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                                        <input type="text" class="form-control accountant" name="provider_state" style="font-size: 14px; background-color: #fff;" value="<?= $provider_state; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                                        <input type="text" class="form-control accountant" name="provider_country" style="font-size: 14px; background-color: #fff;" value="<?= $provider_country; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 3 -->
                                        <div class="box-tab-content" id="tab_content_update_provider_3" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                                        <input type="text" class="form-control accountant" name="provider_bank" style="font-size: 14px; background-color: #fff;" value="<?= $provider_bank; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                                        <input type="text" class="form-control accountant" name="provider_agency" style="font-size: 14px; background-color: #fff;" value="<?= $provider_agency; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                                        <input type="text" class="form-control accountant" name="provider_account" style="font-size: 14px; background-color: #fff;" value="<?= $provider_account; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                                        <input type="text" class="form-control accountant" name="provider_account_type" style="font-size: 14px; background-color: #fff;" value="<?= $provider_account_type; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 4 -->
                                        <div class="box-tab-content" id="tab_content_update_provider_4" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                                        <input type="text" class="form-control accountant" name="provider_site" style="font-size: 14px; background-color: #fff;" value="<?= $provider_site; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-left">
                                        
                                            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                                data-url="/api/web/custom/providers/update" data-form="#form_update_provider" data-redirect="none">
                                                    ATUALIZAR
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Excluir fornecedor</h4>
                                    <hr>

                                    <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                        Tem certeza que deseja excluir esse fornecedor? Essa ação não poderá ser desfeita.
                                    </p>

                                    <div class="text-left">
                                    
                                        <div class="btn btn-line-gray size-lg margin-t-10 btn_send_form"
                                            data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                                EXCLUIR FORNECEDOR
                                        </div>
                                    </div>

                                    <br><br>

                                </div>
                            </div>

                            <?php }else{ ?>

                                <div class="row margin-t-20" style="padding-top: 150px; padding-bottom: 150px; ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center animate-scroll">

                                        <h4 style="font-weight: 500; color: #333;">Nenhum fornecedor selecionado</h4>

                                        <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                            Selecione um cliente para que apareça mais detalhes
                                        </p>

                                    </div>
                                </div>

                            <?php } ?>

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
