
<div class="area-login">
    <div class="container">

        <div class="text-center" style="margin-bottom: 50px;">
            <a class="header-logo animate-scroll" href="/">
                <img src="/img/logo-link-white.png" width="200">
                <br><br>
            </a>
        </div>

        <div class="row content">

            <div class="column col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12" style="margin: 0 auto;">
                <div class="login-content">

                    <div class="box-login">

                        <!-- Content -->
                        <span class="title">Acesse sua conta</span>

                        <div style="margin-top: 50px;">

                            <form id="form-login" method="POST">

                                <div class="card-user">
                                    <a class="box-user" href="/login">
                                        <div class="icon ion-ios-refresh-empty icon-change"></div>
                                    <?php
                                        // echo '<div class="image" style="background-image: url(/img/users/'.$id.'.jpg);"></div>';
                                        echo '<div class="image" style="background-image: url(/img/users/'.$image.'.jpg);"></div>';
                                        echo '<span class="name" style="font-weight: 600; color: #606060;">'.$name.'</span>';
                                        echo '<span class="email" style="font-weight: 600;">'.$username.'</span>';
                                    ?>
                                    </a>
                                </div>

                                <label for="password" class="label margin-t-20">Senha</label>
                                <div class="margin-t-10">
                                    <!-- <input type="password" class="form-control" name="password" id="password"
                                    value="" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    placeholder="******" style="font-size: 16px; font-weight: 600;"> -->
                                    <input type="password" class="form-control" name="password" id="password"
                                    value="" placeholder="" style="font-size: 16px; font-weight: 600;">
                                </div>

                                <input type="hidden" class="form-control" name="username" id="username" value="<?php echo $username; ?>">

                                <script>
                                    $(function(){
                                        $("#password").focus();
                                    });
                                </script>

                                <div class="margin-t-40">
                                    <div id="validate-password" class="btn btn-yellow btn-block size-lg">FAZER LOGIN</div>
                                </div>

                                <div class="text-center" style="margin-top: 30px;">
                                    <a href="/login/esqueci-minha-senha" class="btn btn-link link-default">
                                        Esqueci minha senha
                                    </a>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>

            <?php
                //echo $this->element('banner_login');
            ?>

        </div>
    </div>
</div>
