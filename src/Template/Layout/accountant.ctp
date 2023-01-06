
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js" ></script>

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
    <script src="/tools/jquery_mask/jquery.mask.js"></script>

    <?php echo $this->Html->script($script); ?>

</head>
<body class="app">

    <?php
        echo $this->element('loading');
        echo $this->element('add_activity_accountant');
    ?>

    <!-- Main menu -->
    <div class="main-menu">

        <div class="box-title-itens">

            <a href="/accountant" class="title-item <?php if($menu_active == "home"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">home</i> &nbsp;&nbsp; Visão Geral
            </a>

            <a href="/accountant/business" class="title-item <?php if($menu_active == "business"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">work_outline</i> &nbsp;&nbsp; Empresas
            </a>

            <a href="/accountant/tasks" class="title-item <?php if($menu_active == "tasks"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">description</i> &nbsp;&nbsp; Minhas obrigações
            </a>

            <!-- <a href="/accountant/crm" class="title-item <?php if($menu_active == "crm"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">filter_list</i> &nbsp;&nbsp; Pipeline de vendas
            </a> -->

            <!-- <a href="/accountant/invoices" class="title-item <?php if($menu_active == "invoices"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">description</i> &nbsp;&nbsp; Faturas
            </a> -->

            <!-- <a href="/accountant/reports" class="title-item <?php //if($menu_active == "reports"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">show_chart</i> &nbsp;&nbsp; Relatórios
            </a> -->

            <a href="/accountant/tickets" class="title-item <?php if($menu_active == "tickets"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">bookmarks</i> &nbsp;&nbsp; Chamados
            </a>

            <a href="/accountant/support" class="title-item <?php if($menu_active == "support"){ echo "active"; } ?>" data-item="default">
                <i class="material-icons-outlined">help_outline</i> &nbsp;&nbsp; Ajuda
            </a>

        </div>

        <span class="icon ion-close-round btn-close-mobile hidden-mobile visible-xs" style="position: absolute; right: 26px; top: 18px; color: #d8d8d8; font-size: 22px;"></span>

        <a href="/accountant" class="item <?php if($menu_active == "home"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">home</i>
        </a>

        <a href="/accountant" class="item <?php if($menu_active == "business"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">work_outline</i>
        </a>

        <a href="/tasks" class="item <?php if($menu_active == "tasks"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">description</i>
        </a>

        <!-- <a href="/accountant" class="item <?php if($menu_active == "crm"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">filter_list</i>
        </a> -->

        <!-- <a href="/accountant" class="item <?php if($menu_active == "invoices"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">description</i>
        </a> -->

        <!-- <a href="/accountant/reports" class="item <?php if($menu_active == "reports"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">show_chart</i>
        </a> -->

        <a href="/accountant/tickets" class="item <?php if($menu_active == "tickets"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">bookmarks</i>
        </a>

        <a href="/accountant" class="item <?php if($menu_active == "support"){ echo "active"; } ?>" data-item="default">
            <i class="material-icons-outlined">help_outline</i>
        </a>

    </div>

    <!-- Main menu -->
    <div class="sub-menu">

        <div class="list help">
            <span class="title">Central de Ajuda</span>
            <a href="/admin/about">Sobre o BrandYOU360</a>
            <a href="/admin/faq">Perguntas Frequentes</a>
            <!-- <a href="/admin/terminologies">Terminologias</a> -->
            <a href="/admin/support">Suporte</a>
        </div>

    </div>

    <div class="box-search-business scroll-active">

        <div class="btn-close-search-business">
            <i class="material-icons" style="">close</i>
        </div>

        <form id="form-search-business">
            <input type="text" autocomplete="off" id="input-search-business" class="form-control input-line" name="query" style="font-size: 14px; background-color: transparent;" placeholder="Pesquisar por">
        </form>

        <div class="area-result-search-business">

            <!-- <a href="" class="item-result">
                <span class="title">Willian Half</span>
                <span class="text">35468798/4564-12</span>
            </a> -->

        </div>

    </div>

    <!-- Menu Top -->
    <div class="menu-top">

        <a href="/accountant" class="logo">
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
                    <a href="/accountant/account" class="btn btn-yellow btn-block size-sm">EDITAR PERFIL</a>
                    <a href="/login/logout" class="btn btn-line-gray btn-block size-sm">SAIR</a>
                </div>
            </div>
        </div>

      <div class="row">
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">

              <ul class="nav">
                  <li class="nav-item btn-search-business">

                      <span class="text-time">
                          <i class="material-icons" style="position: relative; top: 6px; line-height: 0px; font-size: 22px;">search</i> Pesquisar por...
                      </span>

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
                      <a class="nav-link box-notification">
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
                          <span class="name-advisor margin-t-20"><?php echo $name_user; ?></span>
                          <span class="email-advisor"><?php echo $email_user; ?></span>


                          <div class="text-center margin-t-30 margin-b-10">
                              <a href="/accountant/account" class="btn btn-yellow btn-block size-sm">EDITAR PERFIL</a>
                              <a href="/login/logout" class="btn btn-line-gray btn-block size-sm">SAIR</a>
                          </div>
                      </div>
                  </li>

              </ul>
          </div>
      </div>

    </div>

    <!-- Content App -->
    <div class="content-admin" style="<?php echo $styles_page; ?>">

      <?= $this->fetch('content') ?>

    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>
</html>
