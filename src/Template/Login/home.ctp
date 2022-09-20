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

                        <h1 class="title">Acesse sua conta</h1>

                        <?php
                            if (!empty($users_logged)){
                        ?>

                            <span class="sub-title margin-t-5">
                                Preencha os seus dados abaixo e acesse a sua conta da Link Contabilidade
                            </span>

                            <div style="margin-top: 50px;">
                                <?php
                                    $i = 0;
                                    foreach ($users_logged as $user) {
                                        $i++;
                                ?>

                                <div class="card-user" style="position: relative;">
                                    <?php echo '<span class="icon ion-ios-close-empty btn-delete-user" data-id="'.$users_logged[$i]['id'].'"></span>'; ?>

                                    <a class="box-user" href="/login/password/<?php echo $users_logged[$i]['id']; ?>">
                                    <?php
                                        // echo '<div class="image" style="background-image: url(/img/users/'.$users_logged[$i]['id'].'.jpg);"></div>';
                                        echo '<div class="image" style="background-image: url(/img/users/'.$users_logged[$i]['image'].'.jpg);"></div>';
                                        echo '<span class="name" style="font-weight: 600; color: #606060;">'.$users_logged[$i]['name'].'</span>';
                                        echo '<span class="email" style="font-weight: 600;">'.$users_logged[$i]['username'].'</span>';
                                    ?>
                                    </a>
                                </div>

                                <?php
                                    }
                                 ?>

                                <!-- <div class="card-user" style="margin-top: 30px;">
                                    <div class="box-user active" data-id="0" data-redirect="/login/email">
                                        <span class="name">ADICIONAR CONTA</span>
                                    </div>
                                </div> -->

                                <div class="margin-t-40">
                                    <div class="form-group">
                                        <a href="/login/email" class="btn btn-yellow btn-block size-lg">ADICIONAR CONTA</a>
                                    </div>
                                </div>

                            </div>

                        <?php
                            }else{
                        ?>

                            <span class="sub-title margin-t-5">
                                Preencha os seus dados abaixo e acesse a sua conta da Link Contabilidade
                            </span>

                            <div style="margin-top: 50px;">

                                <form id="form-email">
                                    <div class="form-group">
                                        <label for="username" class="label">E-mail</label>
                                        <div class="margin-t-10">
                                            <input type="email" class="form-control" name="username" id="username" value=""  placeholder="">
                                        </div>
                                    </div>
                                </form>

                                <div class="margin-t-40">
                                    <div class="form-group">
                                        <button id="validate-email" class="btn btn-yellow btn-block size-lg">CONTINUAR</button>
                                    </div>
                                </div>

                                <!-- <div class="text-center" style="margin-top: 40px;">
                                    <a href="/entrar/esqueci-minha-senha" class="btn btn-link link-primary">
                                        Esqueci minha senha
                                    </a>
                                </div> -->
                            </div>

                            <script>
                                $(function(){
                                    $("#username").focus();
                                });
                            </script>

                        <?php
                            }
                        ?>

                    </div>

                </div>
            </div>

            <?php
                //echo $this->element('banner_login');
            ?>

        </div>
    </div>
</div>
