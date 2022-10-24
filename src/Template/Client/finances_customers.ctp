
<?php

    echo $this->element('add_customer');
    echo $this->element('add_file');
    echo $this->element('add_note');

    echo $this->element('import_customers');
    // echo $this->element('export_customers');

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
            <span class="title-page">Clientes</span>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="btn btn-yellow size-sm" style="display: block; float: right; margin-left: 0px;" 
                data-toggle="modal" data-target="#import_customers">
                    IMPORTAR
            </div>

            <div class="btn btn-line-gray size-sm margin-r-10" style="display: block; float: right; margin-left: 0px;" 
                data-toggle="modal" data-target="#export_customers">
                    EXPORTAR
            </div>

        </div>
    </div>

</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <!-- TAB 8 -->
            <div class="box-tab-content active margin-t-20">

                <div style="padding: 20px; padding-top: 20px; padding-bottom: 40px; margin-top: 0px; border-radius: 8px;">

                    <div class="row margin-t-20">

                        <!-- ACCOUNTS -->
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <div style="max-height: 400px; overflow: scroll; overflow-x: hidden;">

                                <div data-toggle="modal" data-target="#add_customer" class="box-client-item" style="cursor: pointer; text-align: center; background-color: #ffcf31; border: #ffcf31; margin-bottom: 20px;">
                                    <strong style="color: #333; font-size: 12px;">
                                        NOVO CLIENTE 
                                    </strong>
                                </div>

                                <?php $total_clients=0; foreach ($query_customers as $customer) { $total_clients++; ?>

                                    <a href="?tab_select=8&customer_id=<?php echo $customer->id; ?>" class="box-client-item <?php if($customer_selected_id == $customer->id){ echo "active"; } ?>" style="">
                                        <strong style="color: #333; font-size: 12px;">
                                        
                                            <?php
                                                if($customer->type == 'pj'){
                                                    echo $customer->pj_razao;
                                                }else{
                                                    echo $customer->pf_name;
                                                }
                                            ?>

                                        </strong>
                                    </a>

                                <?php } ?>

                            </div>

                        </div>

                        <!-- RELEASES -->
                        <div class="col-xl-9 col-lg-9 col-md-6 col-sm-12 col-xs-12 animate-scroll">

                            <?php if($total_clients > 0){ ?>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <?php 
                                        $customer_id = '';
                                        $customer_name = '';
                                        $customer_document = '';
                                        $customer_phone = '';
                                        $customer_email = '';
                                        $customer_type = '';
                                        $customer_pj_document = '';
                                        $customer_pj_fantasia = '';
                                        $customer_pj_razao = '';
                                        $customer_pj_insc = '';
                                        $customer_pf_document = '';
                                        $customer_pf_name = '';
                                        $customer_mobile = '';
                                        $customer_contact = '';
                                        $customer_zipcode = '';
                                        $customer_address = '';
                                        $customer_number = '';
                                        $customer_complement = '';
                                        $customer_district = '';
                                        $customer_city = '';
                                        $customer_state = '';
                                        $customer_country = '';
                                        $customer_bank = '';
                                        $customer_agency = '';
                                        $customer_account = '';
                                        $customer_account_type = '';
                                        $customer_site = '';
                                        $customer_created = '';
                                        $customer_updated = '';

                                        foreach ($query_customers as $customer){ 
                                            if($customer->id == $customer_selected_id){
                                                
                                                if($customer->type == 'pj'){
                                                    $customer_name =  $customer->pj_razao;
                                                }else{
                                                    $customer_name = $customer->pf_name;
                                                }

                                                if($customer->type == 'pj'){
                                                    $customer_document =  $customer->pj_document;
                                                }else{
                                                    $customer_document = $customer->pf_document;
                                                }

                                                $customer_id = $customer->id; 
                                                $customer_phone = $customer->phone;
                                                $customer_email = $customer->email;
                                                $customer_type = $customer->type;
                                                $customer_pj_document = $customer->pj_document;
                                                $customer_pj_fantasia = $customer->pj_fantasia;
                                                $customer_pj_razao = $customer->pj_razao;
                                                $customer_pj_insc = $customer->pj_insc;
                                                $customer_pf_document = $customer->pf_document;
                                                $customer_pf_name = $customer->pf_name;
                                                $customer_mobile = $customer->mobile;
                                                $customer_contact = $customer->contact;
                                                $customer_zipcode = $customer->zipcode;
                                                $customer_address = $customer->address;
                                                $customer_number = $customer->number;
                                                $customer_complement = $customer->complement;
                                                $customer_district = $customer->district;
                                                $customer_city = $customer->city;
                                                $customer_state = $customer->state;
                                                $customer_country = $customer->country;
                                                $customer_bank = $customer->bank;
                                                $customer_agency = $customer->agency;
                                                $customer_account = $customer->account;
                                                $customer_account_type = $customer->account_type;
                                                $customer_site = $customer->site;
                                                $customer_created = $customer->created;
                                                $customer_updated = $customer->updated;

                                            }
                                        }
                                    ?>

                                    <h3 style="font-weight: 600; color: #333;"><?= $customer_name; ?></h3>
                                    <p style="font-weight: 600; color: #999; font-size: 14px; margin-top: 5px;">
                                    <?= $customer_document; ?>&nbsp; | &nbsp;<?= $customer_email; ?>&nbsp; | &nbsp;<?= $customer_phone; ?>
                                    </p>

                                    <hr class="margin-t-30">

                                    <div class="row margin-t-30">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas recebidas</p>
                                            <p class="text" style="font-size: 18px; margin-bottom: 10px; color: #1bda44; font-weight: 600;">R$ <?php echo number_format($total_closed, 2, ',', '.'); ?></p>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <p class="text" style=" margin-bottom: 5px; color: #969696; font-weight: 600;">Contas a receber</p>
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
                                    <h4 style="font-weight: 500; color: #333;">Editar cliente</h4>
                                    <hr>

                                    <form id="form_update_customer">

                                        <input type='hidden' name="customer_id" value="<?= $customer_id; ?>" id="customer_id">

                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de cliente</p>
                                                <select type="text" class="form-control required" name="customer_type" id="input_customer_type_update" data-type="customer" style="font-size: 14px; background-color: #fff;">
                                                    <option value="pj" <?php if($customer_type == 'pj'){ echo 'selected'; } ?>>Pessoa jurídica</option>
                                                    <option value="pf" <?php if($customer_type == 'pf'){ echo 'selected'; } ?>>Pessoa física</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div id="area_customer_pj_update" <?php if($customer_type == 'pj'){ echo 'style="display: block;"'; }else{echo 'style="display: none;"';} ?>>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CNPJ</p>
                                                    <input type="text" class="form-control accountant mask-cnpj" name="customer_pj_document" id="input-search-cnpj-update" data-type="update" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pj_document; ?>">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome Fantasia</p>
                                                    <input type="text" class="form-control accountant" name="customer_pj_fantasia" id="input-cnpj-fantasia-update" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pj_fantasia; ?>">
                                                
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Razão social</p>
                                                    <input type="text" class="form-control accountant" name="customer_pj_razao" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pj_razao; ?>">
                                                    
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Insc. Mun.</p>
                                                    <input type="text" class="form-control accountant" name="customer_pj_insc" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pj_insc; ?>">
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div id="area_customer_pf_update" <?php if($customer_type == 'pf'){ echo 'style="display: block;"'; }else{echo 'style="display: none;"';} ?>>

                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CPF</p>
                                                    <input type="text" class="form-control accountant mask-cpf" name="customer_pf_document" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pf_document; ?>">
                                                </div>

                                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Nome</p>
                                                    <input type="text" class="form-control accountant" name="customer_pf_name" style="font-size: 14px; background-color: #fff;" value="<?= $customer_pf_name; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- TABS -->
                                        <div class="box-tabs update no-link">
                                            <a class="tab-item active" data-open="#tab_content_update_customer_1" data-type="customer" style="font-size: 12px;">Contato</a>
                                            <a class="tab-item" data-open="#tab_content_update_customer_2" data-type="customer" style="font-size: 12px;">Endereço</a>
                                            <a class="tab-item" data-open="#tab_content_update_customer_3" data-type="customer" style="font-size: 12px;">Dados bancários</a>
                                            <a class="tab-item" data-open="#tab_content_update_customer_4" data-type="customer" style="font-size: 12px;">Adicionais</a>
                                            <div class="clear"></div>
                                        </div>

                                        <!-- TAB 1 -->
                                        <div class="box-tab-content active" id="tab_content_update_customer_1" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">E-mail</p>
                                                        <input type="text" class="form-control accountant" name="customer_email" style="font-size: 14px; background-color: #fff;" value="<?= $customer_email; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Telefone</p>
                                                        <input type="text" class="form-control accountant mask-phonefixed" name="customer_phone" style="font-size: 14px; background-color: #fff;" value="<?= $customer_phone; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Celular</p>
                                                        <input type="text" class="form-control accountant mask-phone" name="customer_mobile" style="font-size: 14px; background-color: #fff;" value="<?= $customer_mobile; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Pessoa de contato</p>
                                                        <input type="text" class="form-control accountant" name="customer_contact" style="font-size: 14px; background-color: #fff;" value="<?= $customer_contact; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 2 -->
                                        <div class="box-tab-content" id="tab_content_update_customer_2" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">CEP</p>
                                                        <input type="text" class="form-control accountant mask-cep" name="customer_zipcode" style="font-size: 14px; background-color: #fff;" value="<?= $customer_zipcode; ?>">
                                                    </div>

                                                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Endereço</p>
                                                        <input type="text" class="form-control accountant" name="customer_address" style="font-size: 14px; background-color: #fff;" value="<?= $customer_address; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Número</p>
                                                        <input type="text" class="form-control accountant" name="customer_number" style="font-size: 14px; background-color: #fff;" value="<?= $customer_number; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Complemento</p>
                                                        <input type="text" class="form-control accountant" name="customer_complement" style="font-size: 14px; background-color: #fff;" value="<?= $customer_complement; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Bairro</p>
                                                        <input type="text" class="form-control accountant" name="customer_district" style="font-size: 14px; background-color: #fff;" value="<?= $customer_district; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Cidade</p>
                                                        <input type="text" class="form-control accountant" name="customer_city" style="font-size: 14px; background-color: #fff;" value="<?= $customer_city; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Estado</p>
                                                        <input type="text" class="form-control accountant" name="customer_state" style="font-size: 14px; background-color: #fff;" value="<?= $customer_state; ?>">
                                                    </div>

                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">País</p>
                                                        <input type="text" class="form-control accountant" name="customer_country" style="font-size: 14px; background-color: #fff;" value="<?= $customer_country; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 3 -->
                                        <div class="box-tab-content" id="tab_content_update_customer_3" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Banco</p>
                                                        <input type="text" class="form-control accountant" name="customer_bank" style="font-size: 14px; background-color: #fff;" value="<?= $customer_bank; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Agência</p>
                                                        <input type="text" class="form-control accountant" name="customer_agency" style="font-size: 14px; background-color: #fff;" value="<?= $customer_agency; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Conta</p>
                                                        <input type="text" class="form-control accountant" name="customer_account" style="font-size: 14px; background-color: #fff;" value="<?= $customer_account; ?>">
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Tipo de conta</p>
                                                        <input type="text" class="form-control accountant" name="customer_account_type" style="font-size: 14px; background-color: #fff;" value="<?= $customer_account_type; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- TAB 4 -->
                                        <div class="box-tab-content" id="tab_content_update_customer_4" style="padding-top: 0px; background-color: #f9f9f9;">
                                            <div style="padding: 0px; padding-top: 20px; padding-bottom: 60px; margin-top: 0px;">

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                        <p class="text margin-t-20" style=" margin-bottom: 10px; color: #969696; font-weight: 600;">Website</p>
                                                        <input type="text" class="form-control accountant" name="customer_site" style="font-size: 14px; background-color: #fff;" value="<?= $customer_site; ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="text-left">
                                        
                                            <div class="btn btn-yellow size-lg margin-t-50 btn_send_form"
                                                data-url="/api/web/custom/customers/update" data-form="#form_update_customer" data-redirect="none">
                                                    ATUALIZAR
                                            </div>
                                        </div>

                                    </form>

                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <br><br>
                                    <h4 style="font-weight: 500; color: #333;">Excluir cliente</h4>
                                    <hr>

                                    <p style="font-weight: 500; color: #666; font-size: 12px; margin-top: 5px;">
                                        Tem certeza que deseja excluir esse cliente? Essa ação não poderá ser desfeita.
                                    </p>

                                    <div class="text-left">
                                    
                                        <div class="btn btn-line-gray size-lg margin-t-10 btn_send_form"
                                            data-url="/api/web/custom/customers/<?= $customer_id; ?>/delete" data-form="none" data-redirect="none">
                                                EXCLUIR CLIENTE
                                        </div>
                                    </div>

                                    <br><br>

                                </div>
                            </div>

                            <?php }else{ ?>

                                <div class="row margin-t-20" style="padding-top: 150px; padding-bottom: 150px; ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center animate-scroll">

                                        <h4 style="font-weight: 500; color: #333;">Nenhum cliente selecionado</h4>

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
