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

                        <span class="title">Começar agora</span>

                        <span class="sub-title margin-t-5">
                            Preencha os seus dados abaixo e crie sua conta na Link Contabilidade
                        </span>

                        <div style="margin-top: 50px;">

                            <form id="form-register">

                                <input type="hidden" name="register-origin" value="cadastro">

                                <div class="form-group">
                                    <!-- <label for="username" class="label">Tipo de cadastro</label> -->
                                    <div class="margin-t-10">
                                        <select type="text" class="form-control required" name="register-type" id="input-register-type" style="font-size: 14px; background-color: #fff;">
                                            <option value="pj">Pessoa jurídica</option>
                                            <option value="pf">Pessoa física</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="display: none;" id="input-register-document-cpf">
                                    <label for="username" class="label">CPF</label>
                                    <div class="margin-t-10">
                                        <input type="text" name="register-cpf" class="form-control mask-cpf" id="register-cpf" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group" id="input-register-document-cnpj">
                                    <label for="username" class="label">CNPJ</label>
                                    <div class="margin-t-10">
                                        <input type="text" name="register-cnpj" class="form-control mask-cnpj" id="register-cnpj" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="label">Nome</label>
                                    <div class="margin-t-5">
                                        <input type="text" name="register-name" class="form-control" id="register-name" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="label">E-mail</label>
                                    <div class="margin-t-5">
                                        <input type="email" name="register-username" class="form-control" id="register-username" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="label">Telefone</label>
                                    <div class="margin-t-5">
                                        <input type="text" name="register-phone" class="form-control mask-phone" id="register-phone" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="label">Senha</label>
                                    <div class="margin-t-5">
                                        <input type="password" name="register-password" class="form-control" id="register-password" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="label">Confirmar senha</label>
                                    <div class="margin-t-5">
                                        <input type="password" name="register-password-confirm" class="form-control" id="register-password-confirm" placeholder="">
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="btn btn-block btn-yellow size-lg margin-t-50" id="add-register">
                            Criar minha conta
                        </div>

                        <!-- Campo 1 -->
                        <div class="row" style="margin-top: 30px; margin-bottom: 0px;">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left" style="float: left;">

                                </div>

                                <div class="clear"></div>
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
