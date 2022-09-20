
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

    <?php echo $this->Html->script($script); ?>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/5ce0808ad07d7e0c6394455c/default';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
      })();
    </script>
    <!--End of Tawk.to Script-->

</head>
<body class="app">

    <?php
        echo $this->element('loading');
    ?>


    <!-- Menu Top -->
    <div class="menu-top">

        <a href="/client" class="logo">
        </a>

        <div class="hidden-mobile visible-xs menu-mobile" style="position: fixed; box-shadow: 0px 10px 20px rgba(0,0,0,.1); z-index: 2;">
            
        </div>

      <div class="row">
          <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">

          </div>

          <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5" style="padding-top: 10px;">

          </div>
      </div>

    </div>

    <!-- Content App -->
    <div class="content-admin" style="padding-left: 0; padding-right: 0;">

      <?= $this->fetch('content') ?>

    </div>

    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>

</body>
</html>
