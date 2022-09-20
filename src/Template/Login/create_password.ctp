
<div class="area-login">
    <div class="container">

        <div class="text-center" style="margin-bottom: 50px;">
            <a class="header-logo animate-scroll" href="/">
                <img src="/img/logo-link-white.png" width="200">
                <br><br>
            </a>
        </div>

        <div class="row content">

            <div class="column col-xl-5 col-lg-6 col-md-7 col-sm-12 col-xs-12" style="margin: 0 auto;">
                <div class="login-content">

                    <div class="box-login" style="padding-top: 15%;">

                        <span style="font-size: 20px; color: #333;">Olá <?php echo $user_name; ?>!</span>
                        <br><hr><br>
                        <span class="title">Crie sua senha</span>

                        <span class="sub-title margin-t-5">Digite a nova senha abaixo:</span>

                        <div style="margin-top: 60px;">

                            <form id="form-password">

                                <input type="hidden" class="form-control" name="username" value="<?php echo $email_recover; ?>">

                                <div class="form-group">
                                    <label for="new-password" class="label">Nova senha</label>
                                    <div class="margin-t-10">
                                        <input type="password" class="form-control" name="new-password" id="new-password"
                                        value="" placeholder="" style="font-size: 16px; font-weight: 600;">
                                    </div>
                                </div>
                            </form>

                            <div class="margin-t-40">
                                <div class="form-group">
                                    <button id="update-password" class="btn btn-yellow btn-block size-lg">CRIAR NOVA SENHA</button>
                                </div>
                            </div>
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
