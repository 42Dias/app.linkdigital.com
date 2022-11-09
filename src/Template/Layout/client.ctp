
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?= $title; ?>Link Contabilidade Consultiva Digital</title>

    <meta name="author" content="Oceaning Marketing e Estratégia | www.oceaning.com.br">
    <meta name="description" content="Contabilidade Online">
    <meta name="keywords" content="Contabilidade, Online">

    <meta property="og:title" content="Link - Contabilidade Consultiva Digital" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.linkcontabilidade.com.br" />
    <meta property="og:image" content="https://www.linkcontabilidade.com.br" />

    <link rel="shortcut icon" href="/img/favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="/tools/ionicons/ionicons.min.css">
    <link rel="stylesheet" href="/tools/animate/animate.css"/>
    <link rel="stylesheet" href="/tools/datepicker/datepicker.min.css">
    <link rel="stylesheet" href="/tools/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/tools/scrollbar/scrollbar.min.css">


    <?php echo $this->Html->css($css); ?>

    <!-- <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script> -->
    <script src="/tools/jquery/jquery-3.1.1.slim.min.js"></script>
    <script src="/tools/jquery/jquery-3.2.1.min.js"></script>
    <script src="/tools/tether/tether.min.js"></script>
    <script src="/tools/bootstrap/bootstrap.min.js"></script>
    <script src="/tools/jquery_mask/jquery.mask.js"></script>
    <script src="/tools/datepicker/datepicker.min.js"></script>
    <script src="/tools/datepicker/datepicker.pt.min.js"></script>
    <script src="/tools/scrollbar/scrollbar.jquery.min.js"></script>
    <script src="/tools/scrollbar/scrollbar.min.js"></script>
    
    <script>
        
        // TYPE NF

    $("#input_nf_type").click(function(){
        
        alert("asd");
        
        if($(this).val() === "nfs-e"){
            $("#area-nf-produtos").css("display", "none");
            $("#area-nf-servicos").css("display", "block");
        }
        
        if($(this).val() === "nf-e" || $(this).val() === "nfc-e"){
            $("#area-nf-produtos").css("display", "block");
            $("#area-nf-servicos").css("display", "none");
        }
    });
        
    </script>

    <?php echo $this->Html->script($script); ?>

    <!--Start of Tawk.to Script-->
    <!-- <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/5ce0808ad07d7e0c6394455c/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script> -->
    <!--End of Tawk.to Script-->

    <!--<script src="https://fast.conpass.io/ug3w6LROzEPk.js"></script>-->

</head>
<body class="app">

    <!--<script>
        var count = 0;
        var ConpassInterval = window.setInterval(function() {
        if (window.Conpass) {
            window.Conpass.init({
            name: "<?php //echo $name_user; ?>",
            email: "<?php //echo $email_user; ?>",
        
            // Informações opcionais (usado para segmentação)
            custom_fields: {
                <?php //if($origin_user == 'cadastro'){ echo 'usuario_trial: "ativado"'; }else{ echo 'usuario_trial: "desativado"'; } ?>
            }

            });
            if (window.Conpass || count >= 100) clearInterval(ConpassInterval);
        }
        count += 1;
        }, 100);

        Conpass.debug();
    </script>-->

    <?php
        
        echo $this->element('loading');
        echo $this->element('add_note_client');
        echo $this->element('add_extract_client');
        echo $this->element('add_document_client');
        // echo $this->element('add_expenses_receipt_client');

        // echo $this->element('open_expenses_receipt_client');
        // echo $this->element('open_note_client');
        // echo $this->element('open_taxe_client');
        // echo $this->element('open_extract_client');
        // echo $this->element('open_document_client');
        echo $this->element('finances_menu');
    ?>

    <!-- Main menu -->
    <div class="main-menu">

        <div class="box-title-itens" style="display: none;">

            <a href="/client" class="title-item <?php if($menu_active == "home"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="top" title="Tipos de tributação">
                <i class="material-icons-outlined">home</i> &nbsp;&nbsp; Visão Geral
            </a>

            <?php if($origin_user == 'cadastro'){ ?>

                <a href="/client/finances/releases" class="title-item <?php if($menu_active == 'releases'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">receipt_long</i> Fluxo de caixa
                </a>
                <a href="/client/finances/conciliations" class="title-item <?php if($menu_active == 'conciliations'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">assignment_turned_in</i> Conciliação
                </a>
                <a href="/client/finances/receipts" class="title-item <?php if($menu_active == 'receipts'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">cloud_done</i> Recebimentos
                </a>
                <a href="/client/finances/payments" class="title-item <?php if($menu_active == 'payments'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">class</i> Pagamentos
                </a>
                <a href="/client/finances/reports/fluxo-previsto" class="title-item <?php if($menu_active == 'reports'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">class</i> Relatórios
                </a>
                <a href="/client/finances/indicators" class="title-item <?php if($menu_active == 'indicators'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">insert_chart_outlined</i> Indicadores
                </a>
                <a href="/client/finances/accounts" class="title-item <?php if($menu_active == 'accounts'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">content_copy</i> Contas
                </a>
                <a href="/client/finances/customers" class="title-item <?php if($menu_active == 'customers'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">person</i> Clientes
                </a>
                <a href="/client/finances/providers" class="title-item <?php if($menu_active == 'providers'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">business_center</i> Fornecedores
                </a>
                <a href="/client/finances/employees" class="title-item <?php if($menu_active == 'employees'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">assignment_ind</i> Funcionários
                </a>
                <a href="/client/finances/partners" class="title-item <?php if($menu_active == 'partners'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">account_circle</i> Sócios
                </a>
                <a href="/client/finances/categories" class="title-item <?php if($menu_active == 'categories'){ echo 'active'; } ?>" data-item="default">
                    <i class="material-icons-outlined">bookmark_border</i> Categorias
                </a>

            <?php } ?>

            <?php if($origin_user != 'cadastro'){ ?>

                <a href="/client/business" class="title-item <?php if($menu_active == "business"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">work_outline</i> &nbsp;&nbsp; Minha contabilidade
                </a>

                <a href="/client/finances/releases" class="title-item <?php if($menu_active == "finances"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">insert_chart_outlined</i> &nbsp;&nbsp; Financeiro
                </a>

                <a href="/client/taxes" class="title-item <?php if($menu_active == "taxes"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">outlined_flag</i> &nbsp;&nbsp; Impostos e Contribuições
                </a>

                <a href="/client/notes" class="title-item <?php if($menu_active == "notes"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">book</i> &nbsp;&nbsp; Notas fiscais
                </a>

                <a href="/client/extracts" class="title-item <?php if($menu_active == "extracts"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">description</i> &nbsp;&nbsp; Extratos financeiros
                </a>

                <a href="/client/documents" class="title-item <?php if($menu_active == "documents"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">folder</i> &nbsp;&nbsp; Documentos
                </a>

                <a href="/client/invoices" class="title-item <?php if($menu_active == "invoices"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">payment</i> &nbsp;&nbsp; Faturas
                </a>

                <a href="/client/services" class="title-item <?php if($menu_active == "services"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">shopping_bag</i> &nbsp;&nbsp; Serviços extras
                </a>

                <!-- <a href="/client/expenses-receipt" class="title-item <?php if($menu_active == "expensesReceipt"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">copy</i> &nbsp;&nbsp; Despesas e Receitas
                </a> -->

                <a href="/client/partners" class="title-item <?php if($menu_active == "partners"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">emoji_objects</i> &nbsp;&nbsp; Parceiros
                </a>

                <!-- <a href="/client/account" class="title-item <?php if($menu_active == "account"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">perm_identity</i> &nbsp;&nbsp; Minha conta
                </a> -->

                <a href="/client/support" class="title-item <?php if($menu_active == "support"){ echo "active"; } ?>" data-item="default">
                    <i class="material-icons-outlined">help_outline</i> &nbsp;&nbsp; Ajuda
                </a>

            <?php } ?>

            <a href="/client/tickets" class="title-item <?php if($menu_active == "tickets"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">bookmarks</i> &nbsp;&nbsp; Chamados
            </a>

        </div>

        <span class="icon ion-close-round btn-close-mobile hidden-mobile visible-xs" style="position: absolute; right: 26px; top: 18px; color: #d8d8d8; font-size: 22px;"></span>

        <a href="/client" class="item <?php if($menu_active == "home"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Visão geral">
            <i class="material-icons-outlined">home</i>
        </a>

        <?php if($origin_user == 'cadastro'){ ?>

            <a href="/client/finances/releases" class="item <?php if($menu_active == 'releases'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Fluxo de caixa">
                <i class="material-icons-outlined">receipt_long</i>
            </a>
            <a href="/client/finances/conciliations" class="item <?php if($menu_active == 'conciliations'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Conciliações">
                <i class="material-icons-outlined">assignment_turned_in</i>
            </a>
            <a href="/client/finances/receipts" class="item <?php if($menu_active == 'receipts'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Recebimentos">
                <i class="material-icons-outlined">cloud_done</i>
            </a>
            <a href="/client/finances/payments" class="item <?php if($menu_active == 'payments'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Pagamentos">
                <i class="material-icons-outlined">class</i>
            </a>
            <a href="/client/finances/reports/fluxo-previsto" class="item <?php if($menu_active == 'reports'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Relatórios">
                <i class="material-icons-outlined">class</i>
            </a>
            <a href="/client/finances/indicators" class="item <?php if($menu_active == 'indicators'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Indicadores">
                <i class="material-icons-outlined">insert_chart_outlined</i>
            </a>
            <a href="/client/finances/accounts" class="item <?php if($menu_active == 'accounts'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Contas">
                <i class="material-icons-outlined">content_copy</i>
            </a>
            <a href="/client/finances/customers" class="item <?php if($menu_active == 'customers'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Clientes">
                <i class="material-icons-outlined">person</i>
            </a>
            <a href="/client/finances/providers" class="item <?php if($menu_active == 'providers'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Fornecedores">
                <i class="material-icons-outlined">business_center</i>
            </a>
            <a href="/client/finances/employees" class="item <?php if($menu_active == 'employees'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Funcionários">
                <i class="material-icons-outlined">assignment_ind</i>
            </a>
            <a href="/client/finances/partners" class="item <?php if($menu_active == 'partners'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Sócios">
                <i class="material-icons-outlined">account_circle</i>
            </a>
            <a href="/client/finances/categories" class="item <?php if($menu_active == 'categories'){ echo 'active'; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Categorias">
                <i class="material-icons-outlined">bookmark_border</i>
            </a>

        <?php } ?>

        <?php if($origin_user != 'cadastro'){ ?>

            <a href="/client/business" class="item <?php if($menu_active == "business"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Minha contabilidade">
                <i class="material-icons-outlined">work_outline</i>
            </a>

            <a href="/client/finances/releases" class="item <?php if($menu_active == "finances"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Financeiro">
                <i class="material-icons-outlined">insert_chart_outlined</i>
            </a>
            
            <a href="/client/tasks" class="item <?php if($menu_active == "tasks"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Minhas obrigações">
                <i class="material-icons-outlined">event</i>
            </a>

            <a href="/client/taxes" class="item <?php if($menu_active == "taxes"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Impostos e Contribuições">
                <i class="material-icons-outlined">outlined_flag</i>
            </a>

            <a href="/client/notes" class="item <?php if($menu_active == "notes"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Notas fiscais">
                <i class="material-icons-outlined">book</i>
            </a>

            <a href="/client/extracts" class="item <?php if($menu_active == "extracts"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Extratos financeiros">
                <i class="material-icons-outlined">description</i>
            </a>

            <a href="/client/documents" class="item <?php if($menu_active == "documents"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Documentos">
                <i class="material-icons-outlined">folder</i>
            </a>

            <a href="/client/invoices" class="item <?php if($menu_active == "invoices"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Faturas">
                <i class="material-icons-outlined">payment</i>
            </a>

            <a href="/client/services" class="item <?php if($menu_active == "services"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Serviços extras">
                <i class="material-icons-outlined">shopping_bag</i>
            </a>

            <!-- <a href="/client/" class="item <?php if($menu_active == "expensesReceipt"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Tipos de tributação">
                <i class="material-icons-outlined">copy</i>
            </a> -->

            <a href="/client/partners" class="item <?php if($menu_active == "partners"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Parceiros">
                <i class="material-icons-outlined">emoji_objects</i>
            </a>

            <!--<a href="/client/" class="item <?php if($menu_active == "account"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Tipos de tributação">
                <i class="material-icons-outlined">perm_identity</i>
            </a> -->

            <a href="/client/support" class="item <?php if($menu_active == "support"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Ajuda">
                <i class="material-icons-outlined">help_outline</i>
            </a>

        <?php } ?>

        <a href="/client/tickets" class="item <?php if($menu_active == "tickets"){ echo "active"; } ?>" data-item="default" data-toggle="tooltip" data-placement="right" title="Chamados">
            <i class="material-icons-outlined">bookmarks</i>
        </a>

    </div>

    <!-- Main menu -->
    <div class="sub-menu">

        <div class="list help">

        </div>

    </div>

    <!-- Menu Top -->
    <div class="menu-top">

        <a href="/client" class="logo">
        </a>

        <div class="hidden-mobile visible-xs menu-mobile" style="position: fixed; box-shadow: 0px 10px 20px rgba(0,0,0,.1); z-index: 2;">
            <a class="nav-link">

                <span class="icon ion-navicon" id="btn-open-menu-mobile" style="position: absolute; left: 20px; top: 3px; color: #3f4756; font-size: 36px;"></span>

                <div class="box-user" style="float: right; background-image: url(/img/users/<?php echo $image_user; ?>.jpg);"></div>

                <span class="name-advisor" style="float: right; margin-top: 10px; margin-right: 10px; font-size: 12px; font-weight: 500;">
                    <?php echo $name_user." ".$lastname_user; ?>
                </span>

                <div class="clear"></div>
            </a>

            <div class="box-user-tooltip">
                <div class="arrow"></div>
                <div class="image-advisor" style="background-image: url(/img/users/<?php echo $image_user; ?>.jpg);"></div>
                <span class="name-advisor margin-t-20"><?php echo $name_user; ?></span>
                <span class="email-advisor"><?php echo $email_user; ?></span>

                <div class="text-center margin-t-30 margin-b-10">
                    <a href="/client/account" class="btn btn-yellow btn-block size-sm">EDITAR PERFIL</a>
                    <a href="/login/logout" class="btn btn-line-gray btn-block size-sm">SAIR</a>
                </div>
            </div>
        </div>

      <div class="row">
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">

              <ul class="nav">
                  <li class="nav-item">

                      <span class="text-welcome">
                         Sua empresa
                      </span>

                      <span class="text-time" style="display: inline-block;">
                          <!-- <?php //echo $business_name.' | '.$business_cnpj; ?> &nbsp;<span class="icon ion-android-arrow-dropdown" style="font-size: 18px; line-height: 0px;"></span> -->
                          <?php echo $business_name.' | '.$business_cnpj; ?>
                      </span>

                      <?php if($origin_user == 'cadastro'){ ?>
                        <!-- 
                            <span class="text-time" style="background-color: #ffcc00; display: inline-block; border-radius: 50px; padding: 0px 10px; font-size: 10px; font-weight: 600; text-transform: uppercase;">
                                <?php echo $expire_days || 0; ?> dias
                            </span>
                        -->

                      <?php } ?>

                      <div class="clear"></div>
                  </li>
              </ul>

          </div>

          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5" style="padding-top: 10px;">
              <ul class="nav justify-content-end">

                  <!-- <li class="nav-item">
                      <a class="nav-link">
                          <span class="icon ion-grid"></span>
                      </a>
                  </li> -->

                  <li class="nav-item">
                      <a href="/client/notifications" class="nav-link box-notification">
                          <span class="icon ion-android-notifications-none"></span>
                      </a>
                  </li>

                  <li class="nav-item hidden-mobile visible-md visible-lg">
                      <a class="nav-link">
                          <span class="name-advisor" style="float: left; margin-top: 10px; margin-right: 10px; font-size: 14px; font-weight: 500;">
                              <?php echo $name_user." ".$lastname_user; ?>
                          </span>
                          <div class="box-user" style="background-image: url(/img/users/<?php echo $image_user; ?>.jpg);"></div>
                          <div class="clear"></div>
                      </a>

                      <div class="box-user-tooltip">
                          <div class="arrow"></div>
                          <!-- <span class="level-advisor">Master</span> -->
                          <div class="image-advisor" style="background-image: url(/img/users/<?php echo $image_user; ?>.jpg);"></div>
                          <span class="name-advisor margin-t-20"><?php echo $name_user." ".$lastname_user; ?></span>
                          <span class="email-advisor"><?php echo $email_user; ?></span>


                          <div class="text-center margin-t-30 margin-b-10">
                              <a href="/client/account" class="btn btn-yellow btn-block size-sm">EDITAR PERFIL</a>
                              <a href="/login/logout" class="btn btn-line-gray btn-block size-sm">SAIR</a>
                          </div>
                      </div>
                  </li>

              </ul>
          </div>
      </div>

    </div>

    <!-- Content App -->

    <?php 
        if($_SERVER['REQUEST_URI'] == '/client/finances'){
            echo '<div class="content-admin" style="background-image: url(../img/bg-homepage-v9.jpg);">';
        }else{
            echo '<div class="content-admin">';
        }
    ?>

      <?= $this->fetch('content') ?>

    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

    <?php echo $this->element('alert_modal'); ?>

</body>
</html>
