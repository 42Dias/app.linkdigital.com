
<?php

    echo $this->element('add_partner');
    echo $this->element('add_file');
    echo $this->element('add_note');

    echo $this->element('import_partners');
    // echo $this->element('export_partners');

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
            <span class="title-page">Sócios</span>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="btn btn-yellow size-sm" style="display: block; float: right; margin-left: 0px;"
                data-toggle="modal" data-target="#import_partners">
                    IMPORTAR
            </div>

            <div class="btn btn-line-gray size-sm margin-r-10" style="display: block; float: right; margin-left: 0px;"
                data-toggle="modal" data-target="#export_partners">
                    EXPORTAR
            </div>

        </div>
    </div>

</div>


<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 11 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px; border-radius: 8px;">

                    <div class="row margin-t-20">

                        <!-- ACCOUNTS -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <div style="max-height: 400px; overflow: scroll; overflow-x: hidden;">

                                <div data-toggle="modal" data-target="#add_partner" class="box-client-item" style="cursor: pointer; text-align: center; background-color: #ffcf31; border: #ffcf31; margin-bottom: 20px;">
                                    <strong style="color: #333; font-size: 12px;">
                                        NOVO SÓCIO
                                    </strong>
                                </div>

                                <?php $total_partners=0; foreach ($query_partners as $partner) { $total_partners++; ?>

                                    <a href="?tab_select=11&partner_id=<?php echo $partner->id; ?>" class="box-client-item <?php if($partner_selected_id == $partner->id){ echo "active"; } ?>" style="">
                                        <strong style="color: #333; font-size: 12px;">
                                        
                                            <?php
                                                if($partner->type == 'pj'){
                                                    echo $partner->pj_razao;
                                                }else{
                                                    echo $partner->pf_name;
                                                }
                                            ?>

                                        </strong>
                                    </a>

                                <?php } ?>

                            </div>

                        </div>

                        <!-- RELEASES -->
                        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php if($total_partners > 0){ ?>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <?php 
                                        $partner_name = '';
                                        $partner_document = '';
                                        $partner_phone = '';
                                        $partner_email = '';
                                        $partner_type = '';
                                        $partner_pj_document = '';
                                        $partner_pj_fantasia = '';
                                        $partner_pj_razao = '';
                                        $partner_pj_insc = '';
                                        $partner_pf_document = '';
                                        $partner_pf_name = '';
                                        $partner_mobile = '';
                                        $partner_contact = '';
                                        $partner_zipcode = '';
                                        $partner_address = '';
                                        $partner_number = '';
                                        $partner_complement = '';
                                        $partner_district = '';
                                        $partner_city = '';
                                        $partner_state = '';
                                        $partner_country = '';
                                        $partner_bank = '';
                                        $partner_agency = '';
                                        $partner_account = '';
                                        $partner_account_type = '';
                                        $partner_site = '';
                                        $partner_created = '';
                                        $partner_updated = '';

                                        foreach ($query_partners as $partner){ 
                                            if($partner->id == $partner_selected_id){
                                                
                                                if($partner->type == 'pj'){
                                                    $partner_name =  $partner->pj_razao;
                                                }else{
                                                    $partner_name = $partner->pf_name;
                                                }

                                                if($partner->type == 'pj'){
                                                    $partner_document =  $partner->pj_document;
                                                }else{
                                                    $partner_document = $partner->pf_document;
                                                }

                                                $partner_phone = $partner->phone;
                                                $partner_email = $partner->email;
                                                $partner_type = $partner->type;
                                                $partner_pj_document = $partner->pj_document;
                                                $partner_pj_fantasia = $partner->pj_fantasia;
                                                $partner_pj_razao = $partner->pj_razao;
                                                $partner_pj_insc = $partner->pj_insc;
                                                $partner_pf_document = $partner->pf_document;
                                                $partner_pf_name = $partner->pf_name;
                                                $partner_mobile = $partner->mobile;
                                                $partner_contact = $partner->contact;
                                                $partner_zipcode = $partner->zipcode;
                                                $partner_address = $partner->address;
                                                $partner_number = $partner->number;
                                                $partner_complement = $partner->complement;
                                                $partner_district = $partner->district;
                                                $partner_city = $partner->city;
                                                $partner_state = $partner->state;
                                                $partner_country = $partner->country;
                                                $partner_bank = $partner->bank;
                                                $partner_agency = $partner->agency;
                                                $partner_account = $partner->account;
                                                $partner_account_type = $partner->account_type;
                                                $partner_site = $partner->site;
                                                $partner_created = $partner->created;
                                                $partner_updated = $partner->updated;

                                            }
                                        }
                                    ?>

                                    <h3 style="font-weight: 600; color: #333;"><?= $partner_name; ?></h3>
                                    <p style="font-weight: 600; color: #999; font-size: 14px; margin-top: 5px;">
                                    <?= $partner_document; ?>&nbsp; | &nbsp;<?= $partner_email; ?>&nbsp; | &nbsp;<?= $partner_phone; ?>
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
                                    <h4 style="font-weight: 500; color: #333;">Editar sócio</h4>
                                    <hr>

                                    <form id="form_update_partner">

                                        <input type='hidden' name="partner_id" value="<?= $partner->id; ?>" id="partner_id">

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de cliente</p>
                                                <select type="text" class="form-control required" name="partner_type" id="input_partner_type" data-type="partner" style="font-size: 14px; background-color: #fff;">
                                                    <option value="pj" <?php if($partner->type == 'pj'){ echo 'selected'; } ?>>Pessoa jurídica</option>
                                                    <option value="pf" <?php if($partner->type == 'pf'){ echo 'selected'; } ?>>Pessoa física</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div id="area_partner_pj">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                                    <input type="text" class="form-control accountant mask-cnpj" name="partner_pj_document" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pj_document; ?>">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                                    <input type="text" class="form-control accountant" name="partner_pj_fantasia" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pj_fantasia; ?>">
                                                
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                                    <input type="text" class="form-control accountant" name="partner_pj_razao" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pj_razao; ?>">
                                                    
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                                    <input type="text" class="form-control accountant" name="partner_pj_insc" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pj_insc; ?>">
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div id="area_partner_pf" style="display: none;">

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                                    <input type="text" class="form-control accountant mask-cpf" name="partner_pf_document" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pf_document; ?>">
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                                    <input type="text" class="form-control accountant" name="partner_pf_name" style="font-size: 14px; background-color: #fff;" value="<?= $partner_pf_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TABS -->
                                        <div class="box-tabs update no-link">
                                            <a class="tab-item active" data-open="#tab_content_update_partner_1" data-type="partner" style="font-size: 12px;">Contato</a>
                                            <a class="tab-item" data-open="#tab_content_update_partner_2" data-type="partner" style="font-size: 12px;">Endereço</a>
                                            <a class="tab-item" data-open="#tab_content_update_partner_3" data-type="partner" style="font-size: 12px;">Dados bancários</a>
                                            <a class="tab-item" data-open="#tab_content_update_partner_4" data-type="partner" style="font-size: 12px;">Adicionais</a>
                                            <div class="clear"></div>
                                        </div>

                                        <!-- TAB 1 -->
                                        <div class="box-tab-content active" id="tab_content_update_partner_1" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                                        <input type="text" class="form-control accountant" name="partner_email" style="font-size: 14px; background-color: #fff;" value="<?= $partner_email; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                                        <input type="text" class="form-control accountant mask-phonefixed" name="partner_phone" style="font-size: 14px; background-color: #fff;" value="<?= $partner_phone; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                                        <input type="text" class="form-control accountant mask-phone" name="partner_mobile" style="font-size: 14px; background-color: #fff;" value="<?= $partner_mobile; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                                        <input type="text" class="form-control accountant" name="partner_contact" style="font-size: 14px; background-color: #fff;" value="<?= $partner_contact; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 2 -->
                                        <div class="box-tab-content" id="tab_content_update_partner_2" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                                        <input type="text" class="form-control accountant mask-cep" name="partner_zipcode" style="font-size: 14px; background-color: #fff;" value="<?= $partner_zipcode; ?>">
                                                    </div>

                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                                        <input type="text" class="form-control accountant" name="partner_address" style="font-size: 14px; background-color: #fff;" value="<?= $partner_address; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                                        <input type="text" class="form-control accountant" name="partner_number" style="font-size: 14px; background-color: #fff;" value="<?= $partner_number; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                                        <input type="text" class="form-control accountant" name="partner_complement" style="font-size: 14px; background-color: #fff;" value="<?= $partner_complement; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                                        <input type="text" class="form-control accountant" name="partner_district" style="font-size: 14px; background-color: #fff;" value="<?= $partner_district; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                                        <input type="text" class="form-control accountant" name="partner_city" style="font-size: 14px; background-color: #fff;" value="<?= $partner_city; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                                        <input type="text" class="form-control accountant" name="partner_state" style="font-size: 14px; background-color: #fff;" value="<?= $partner_state; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                                        <input type="text" class="form-control accountant" name="partner_country" style="font-size: 14px; background-color: #fff;" value="<?= $partner_country; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 3 -->
                                        <div class="box-tab-content" id="tab_content_update_partner_3" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                                        <input type="text" class="form-control accountant" name="partner_bank" style="font-size: 14px; background-color: #fff;" value="<?= $partner_bank; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                                        <input type="text" class="form-control accountant" name="partner_agency" style="font-size: 14px; background-color: #fff;" value="<?= $partner_agency; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                                        <input type="text" class="form-control accountant" name="partner_account" style="font-size: 14px; background-color: #fff;" value="<?= $partner_account; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                                        <input type="text" class="form-control accountant" name="partner_account_type" style="font-size: 14px; background-color: #fff;" value="<?= $partner_account_type; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 4 -->
                                        <div class="box-tab-content" id="tab_content_update_partner_4" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                                        <input type="text" class="form-control accountant" name="partner_site" style="font-size: 14px; background-color: #fff;" value="<?= $partner_site; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-left">
                                        
                                            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                                data-url="/api/web/custom/partners/update" data-form="#form_update_partner" data-redirect="none">
                                                    ATUALIZAR
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Excluir sócio</h4>
                                    <hr>

                                    <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                        Tem certeza que deseja excluir esse sócio? Essa ação não poderá ser desfeita.
                                    </p>

                                    <div class="text-left">
                                    
                                        <div class="btn btn-line-gray size-lg margin-t-10 btn_send_form"
                                            data-url="/api/web/custom/customers/add" data-form="#form_add_customer" data-redirect="none">
                                                EXCLUIR SÓCIO
                                        </div>
                                    </div>

                                    <br><br>

                                </div>
                            </div>

                            <?php }else{ ?>

                                <div class="row margin-t-20" style="padding-top: 150px; padding-bottom: 150px; ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center animate-scroll">

                                        <h4 style="font-weight: 500; color: #333;">Nenhum sócio selecionado</h4>

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
