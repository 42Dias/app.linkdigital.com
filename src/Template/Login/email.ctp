
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
                        <span class="title">Adicionar conta</span>
                        <span class="sub-title margin-t-5">
                            Preencha os seus dados abaixo e adicione sua conta da Link Contabilidade
                        </span>

                        <div style="margin-top: 70px;">

                            <form id="form-email" method="POST">
                                <div class="form-group">
                                    <label for="username" class="label">E-mail</label>
                                    <div class="margin-t-10">
                                        <input type="email" class="form-control" name="username" id="username" value=""  placeholder="">
                                    </div>
                                </div>
                            </form>

                            <div class="margin-t-40">
                                <div class="form-group">
                                    <button id="validate-email" class="btn btn-yellow btn-block size-lg">ADICIONAR CONTA</button>
                                </div>
                            </div>

                            <!-- <div class="text-center" style="margin-top: 10px;">
                                <a href="/cadastro" class="btn btn-link link-primary">
                                    Criar uma nova conta
                                </a>
                            </div> -->

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
