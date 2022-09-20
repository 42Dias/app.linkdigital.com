
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?= $title; ?>Link Contabilidade Consultiva Digital</title>

    <meta name="author" content="Link Contabilidade Consultiva Digital | www.linkcontabilidade.com.br">
    <meta name="description" content="Sua contabilidade digital lucrativa e segura! Venha para a Link e conheça as vantagens para sua empresa. Transforme sua Empresa através da Contabilidade Consultiva">
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
    <link rel="stylesheet" href="/tools/bootstrap/bootstrap.min.css">

    <?php echo $this->Html->css($css); ?>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
    <script src="/tools/jquery/jquery-3.1.1.slim.min.js"></script>
    <script src="/tools/jquery/jquery-3.2.1.min.js"></script>
    <script src="/tools/tether/tether.min.js"></script>
    <script src="/tools/bootstrap/bootstrap.min.js"></script>
    <script src="/tools/jquery_mask/jquery.mask.js"></script>
    <!-- <script src="/tools/masked/maskedinput.js"></script> -->
    <script src="/tools/masked/maskedmoney.js"></script>
    <script src="/js/simulations.js"></script>

    <?php echo $this->Html->script($script); ?>

    <!-- Bulldesk -->
    <!-- <script>
      window.BulldeskSettings = {
        token: 'f25ca659c689f30f8ad6469a235a33ad'
      };

      !function(a,b,c){if('object'!=typeof c){var d=function(){d.c(arguments)};d.q=[],d.c=function(a){d.q.push(a)},a.Bulldesk=d;var e=b.createElement('script');e.type='text/javascript',e.async=!0,e.id='bulldesk-analytics',e.src='https://static.bulldesk.com.br/bulldesk.js';var f=b.getElementsByTagName('script')[0];f.parentNode.insertBefore(e,f)}}(window,document,window.Bulldesk);
    </script> -->

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

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KNJZS8T');</script>
    <!-- End Google Tag Manager -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-194428989-1">
    </script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-194428989-1');
    </script>

    <script src="https://fast.conpass.io/ug3w6LROzEPk.js"></script>

    <meta name="facebook-domain-verification" content="g3xlu322qq9k3q8i5fu6mm1xd3j7m4" />

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '819320608998988');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=819320608998988&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KNJZS8T"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- wbot -->
    <script src="https://wbot.chat/index.js" token="a34d914cd510d2734368a67c7f00bbe0"></script>

    <a href="https://api.whatsapp.com/send?phone=5512981473602" class="btn-float-whats" target="_blank">
        <ion-icon name="logo-whatsapp" style="font-size: 26px;"></ion-icon>
    </a>

    <?php
        echo $this->element('loading');
        echo $this->element('alert_modal');
        // echo $this->element('agendar_atendimento');
        echo $this->element('transferir_mei_me');
        echo $this->element('popup_exit');
        echo $this->element('alert_lucro_real');
        echo $this->element('agendar_proposta_lucro_real');
        echo $this->element('help_package');
        echo $this->element('help_certificado');
        echo $this->element('popup-cookies');
        echo $this->element('simulation');
    ?>

    <?= $this->fetch('content') ?>

</body>
</html>
