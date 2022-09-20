
<?php 
    echo $this->element('add_history_accountant');
?>

<?php

    foreach ($all_business as $business) {

        if($business->status == 1){ $status_select_text = "lead"; $status_color = "gray"; }
        if($business->status == 2){ $status_select_text = "Em abertura"; $status_color = "yellow"; }
        if($business->status == 3){ $status_select_text = "Em migração"; $status_color = "yellow"; }
        if($business->status == 4){ $status_select_text = "Ativo"; $status_color = "green"; }
        if($business->status == 5){ $status_select_text = "Inativo"; $status_color = "gray"; }
        if($business->status == 6){ $status_select_text = "Cancelado"; $status_color = "gray"; }

        if($business->taxation == "simei"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "simples"){ $taxation_text = "Simples Nacional"; }
        if($business->taxation == "lucro"){ $taxation_text = "Lucro presumido"; }
        if($business->taxation == "real"){ $taxation_text = "Lucro real"; }

        if($business->type == "s"){ $type_text = "Prestação de serviços"; }
        if($business->type == "c"){ $type_text = "Comércio"; }
        if($business->type == "sc"){ $type_text = "Prestação de serviços e Comércio"; }
        if($business->type == "mei"){ $type_text = "Micro empreendedor individual"; }
        if($business->type == "domestico"){ $type_text = "Empregado doméstico"; }
        if($business->type == "industria"){ $type_text = "Indústria"; }
        if($business->type == "inativa"){ $type_text = "Empresa inativa"; }
        if($business->type == "liberal"){ $type_text = "Profissional Liberal ou Autonomo"; }

        $business_name = $business->fantasia;
        $business_cnpj = $business->cnpj;
        $business_razao = $business->razao;
        $business_fantasia = $business->fantasia;
        $business_taxation = $business->taxation;
        $business_faturamento = $business->faturamento;
        $business_socios = $business->socios;
        $business_funcionarios = $business->funcionarios;
        $business_atividades = $business->atividades;
        $business_zipcode = $business->zipcode;
        $business_address = $business->address;
        $business_number = $business->number;
        $business_complement = $business->complement;
        $business_district = $business->district;
        $business_city = $business->city;
        $business_state = $business->state;
        $user_step = $business->steps;
        
        $service_action = $business->action;
        $service_type = $business->type;

        if($service_action == "migracao"){ $service_action_text = "Migração de empresa"; }
        if($service_action == "abertura"){ $service_action_text = "Abertura de empresa"; }

        // Services
        foreach ($all_services as $service) {
            $service_name = $service->name;
            $service_price = $service->price;

            // Taxation
            if($service->taxation == "simples"){ $service_taxation = "Simples Nacional"; }
            if($service->taxation == "lucro"){ $service_taxation = "Lucro Presumido"; }

            // Cycle
            if($service->cycle == "monthly"){ $service_cycle = "Mensal"; }
            if($service->cycle == "yearly"){ $service_cycle = "Anual"; }
        }

        foreach ($all_business as $business) {
            $business_socios = $business->socios;
            $business_funcionarios = $business->funcionarios;
        }

        $total_month = $service_price;
        $total_month += ($business_socios - 1) * 29.90;
        $total_month += $business_funcionarios * 29.90;
    }

    // USERS
    foreach ($all_users as $user) {
        $user_name = $user->name;
        $user_lastname = $user->lastname;
        $user_username = $user->username;
        $user_cpf = $user->cpf;
        $user_birthday = $user->birthday;
        $user_phone = $user->phone;
        $user_whatsapp = $user->whatsapp;
    }
?>

<!-- Content -->
<div style="background-color: #fff; padding: 40px; min-height: 800px; padding-right: 330px;">

    <!-- Menu Page -->
    <div class="menu-page">

      <div class="row">
          <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-xs-12">
              <span class="title-page"><?= $business->fantasia; ?></span>

              <span style="display: block; font-size: 14px; color: #999; font-weight: 500; margin-top: 8px;">
                  <?= $type_text; ?> | <?= $taxation_text; ?>
              </span>
          </div>

          <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12">

              <!-- BOX 1 -->
              <div style="float: left;">
                  <span style="font-size: 12px; color: #999; font-weight: 500;">Responsável</span>
                  <br>

                  <div class="box-filter gray" style="margin-left: 0px; margin-top: 10px;">

                      <?php foreach ($all_accountants as $accountant) { ?>
                          <?php if($accountant->id == $business->accountant_id){ echo $accountant->name; } ?></a>
                      <?php } ?>

                      <?php if($business->accountant_id == 0){ echo "Nenhum"; } ?>

                      &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">

                          <?php foreach ($all_accountants as $accountant) { ?>
                              <a href="#" class="item-filter"><?php $accountant->name; ?></a>
                          <?php } ?>

                      </div>
                  </div>
                  <div class="clear"></div>
              </div>

              <!-- BOX 2 -->
              <div style="float: left; margin-left: 10px;">
                  <span style="font-size: 12px; color: #999; font-weight: 500;">Status</span>
                  <br>

                  <div class="box-filter <?= $status_color; ?>" style="margin-left: 0px; margin-top: 10px;">
                      <?= $status_select_text; ?> &nbsp; <i class="material-icons-outlined">keyboard_arrow_down</i>
                      <div class="space-itens"></div>

                      <div class="itens-filter scroll-active" style="width: 200px;">
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="1">Lead</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="2">Em abertura</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="3">Em migração</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="4">Ativo</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="5">Inativo</a>
                          <a href="#" class="item-filter update-status-business" data-id="<?php echo $business_id; ?>" data-status="6">Cancelado</a>
                      </div>
                  </div>
                  <div class="clear"></div>
              </div>

              <div class="clear"></div>

          </div>
      </div>

    </div>

    <?php
        echo $this->element('business_menu');
    ?>

    <div class="box-tab-content active" id="tab-content-6">

        <!-- TAXES -->
        <div style="background-color: #f9f9f9; padding: 40px; padding-top: 20px; padding-bottom: 60px; margin-top: 30px; border-radius: 8px;">

            <!-- DOCUMENTS -->
            <br>
            <span class="title-box" style="margin-top: 20px; margin-bottom: 5px; line-height: 24px; font-size: 18px; font-weight: 600; color: #333;">
                Documentos necessários
            </span>
            <br><br>
                            
            <?php

                if($status_select_text == "Em abertura"){
                    foreach ($all_docs_abertura as $doc) {

                        $document_send_status = '';
                        $document_send_url = '';

                        foreach($all_documents_actions as $document_send){ 
                            if($document_send->document_id == $doc->id && $document_send->type == 'abertura'){
                                $document_send_status = 'send';
                                $document_send_url = $document_send->url;
                            }
                        }
            ?>
                        <div class="box-document-action <?php echo $document_send_status; ?>">
                            <span class="check"></span>
                            <span class="name"><?php echo $doc->title; ?></span>

                            <?php if($document_send_status == 'send'){ ?>
                                <span class="name send">Documento enviado</span>
                            <?php } ?>

                            <?php if($document_send_status == ''){ ?>

                            <?php }else{ ?>

                                <a href="../../../uploads/documents/<?php echo $document_send_url; ?>" target="_blank" class="btn btn-green btn-block size-sm" style="bottom: 70px;">FAZER DOWNLOAD</a>

                            <?php } ?>
                        </div>
            <?php
                    }

                }else{

                    foreach ($all_docs_migracao as $doc) {

                        $document_send_status = '';
                        $document_send_url = '';

                        foreach($all_documents_actions as $document_send){ 
                            if($document_send->document_id == $doc->id && $document_send->type == 'migracao'){
                                $document_send_status = 'send';
                                $document_send_url = $document_send->url;
                            }
                        }
                            
            ?>
                        <div class="box-document-action <?php echo $document_send_status; ?>">
                            <span class="check"></span>
                            <span class="name"><?php echo $doc->title; ?></span>

                            <?php if($document_send_status == 'send'){ ?>
                                <span class="name send">Documento enviado</span>
                            <?php } ?>

                            <?php if($document_send_status == ''){ ?>

                            <?php }else{ ?>

                                <div class="btn btn-line-gray btn-block size-sm btn_send_form" data-url="/api/web/client/documents/<?php echo $doc->id; ?>/remove-action" data-form="none" data-redirect="none">REMOVER</div>                                    
                                <a href="../../../uploads/documents/<?php echo $document_send_url; ?>" target="_blank" class="btn btn-green btn-block size-sm" style="bottom: 70px;">FAZER DOWNLOAD</a>

                            <?php } ?>
                        </div>

            <?php
                    }
                }                    
            ?>

            <div class="clear"></div>

            

            <!-- ::::::::::::::: -->



            <!-- ATIVIDADES -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                    <div class="box-file add client btn-add-history" data-toggle="modal" data-target="#addHistory">
                        <i class="material-icons-outlined">add</i>
                        <span class="date"></span>
                        <span class="title" style="color: #999;">Adicionar <br>nova atividade</span>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

                    <?php $x=0; foreach ($all_history as $history) { $x++; ?>

                        <a href="<?= $history->id; ?>" target="_blank" class="box-file client" data-id="<?= $history->id; ?>" style="text-decoration: none;">
                            <i class="material-icons-outlined">description</i>
                            <span class="date"><?= date_format($history->created, 'd/m/Y'); ?></span>
                            <span class="title"><?= $history->title; ?></span>
                        </a>

                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center" style="margin-top: 70px; padding-bottom: 50px;">
                            <i class="material-icons-outlined icon-empty">all_inclusive</i>
                            <span class="title" style="font-size: 12px;">O cliente não possui nenhuma atividade.</span>
                        </div>

                    <?php } ?>

                    <div class="clear"></div>

                </div>
            </div>

        </div>

    </div>

    <?php
        echo $this->element('footer_panel');
    ?>

</div>

<?php
    echo $this->element('sidebar_timeline');
?>
