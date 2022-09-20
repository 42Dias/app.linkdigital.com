<?php
    echo $this->element('loading');
    echo $this->element('add_ticket_client');

    $tab_select = "";

    if(isset($_GET["tab_select"])){
        $tab_select = $_GET["tab_select"];
    }
?>

<!-- Menu Page -->
<div class="menu-page">
  <span class="title-page">Chamados</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs">

                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">

                        <div class="box-filter-tabs admin">

                            <a href="/client/tickets?tab_select=0" class="item-tab <?php if($tab_select == "" || $tab_select == 0){ echo "active"; } ?>">
                                Pendentes
                            </a>

                            <a href="/client/tickets?tab_select=1" class="item-tab <?php if($tab_select == 1){ echo "active"; } ?>">
                                Resolvidos
                            </a>

                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <div style="font-size: 12px; padding: 15px 40px;"
                                class="btn btn-yellow size-lg"  data-toggle="modal" data-target="#addTicket">NOVO CHAMADO
                        </div>
                    </div>
                </div>

                <br><br>

                <?php

                    if($tab_select == 0){

                        $x = 0;

                        foreach ($list_tickets as $ticket) {

                            $area_ticket = '';
                            if($ticket->area == "fiscal"){ $area_ticket = "Fiscal"; }
                            if($ticket->area == "pessoal"){ $area_ticket = "Pessoal"; }
                            if($ticket->area == "financeiro"){ $area_ticket = "Financeiro"; }
                            if($ticket->area == "contabil"){ $area_ticket = "Contábil"; }
                            if($ticket->area == "administracao"){ $area_ticket = "Administração"; }
                            if($ticket->area == "legalizacao"){ $area_ticket = "Legalização"; }
                            if($ticket->area == "atendimento"){ $area_ticket = "Atendimento"; }
                            if($ticket->area == "treinamento"){ $area_ticket = "Treinamento"; }
                            if($ticket->area == "comercial"){ $area_ticket = "Comercial"; }
                            if($ticket->area == "marketing"){ $area_ticket = "Marketing"; }

                            $status_border = 'border-left: 5px solid #999;';
                            $status_ticket = '<div class="status pendente"> '.$area_ticket.'</div>';

                            if($ticket->status == 1){

                                $x++;

                ?>

                        <a href="/client/tickets/<?php echo $ticket->id; ?>/view" class="box-ticket admin" style="<?php echo $status_border; ?>">

                            <?php echo $status_ticket; ?>

                            <strong class=""><?php echo $ticket->subject; ?></strong>
                            <span class="text">Enviado <?php echo date_format($ticket->created, 'd/m/Y')."  às ".date_format($ticket->created, 'H:i'); ?></span>

                            <span class="text margin-t-10" style="font-weight: 500; color: #000;">
                                <?php echo $ticket->text; ?>
                            </span>
                        </a>

                        <?php } ?>
                    <?php } ?>

                    <?php if($x == 0){ ?>

                        <div class="text-center">
                            <div class="box-empty">
                                <span style="font-size: 14px;">Você não possui nenhum chamado pendente.</span>
                            </div>
                        </div>

                        <br><br>

                    <?php } ?>

                <?php }else{ ?>

                <?php
                        $y = 0;

                        foreach ($list_tickets as $ticket) {

                            $status_border = 'border-left: 5px solid #a3d30c;';
                            $status_ticket = '<div class="status resolvido"> Resolvido</div>';

                            if($ticket->status == 0){

                                $y++;

                ?>

                            <a href="/client/tickets/<?php echo $ticket->id; ?>/view" class="box-ticket admin" style="<?php echo $status_border; ?>">

                                <?php echo $status_ticket; ?>

                                <strong class=""><?php echo $ticket->subject; ?></strong>
                                <span class="text">Enviado <?php echo date_format($ticket->created, 'd/m/Y')."  às ".date_format($ticket->created, 'H:i'); ?></span>

                                <span class="text margin-t-10" style="font-weight: 500; color: #000;">
                                    <?php echo $ticket->text; ?>
                                </span>
                            </a>

                        <?php } ?>
                    <?php } ?>

                    <?php if($y == 0){ ?>

                        <div class="text-center">
                            <div class="box-empty">
                                <span style="font-size: 14px;">Você não possui nenhum chamado resolvido.</span>
                            </div>
                        </div>

                        <br><br>

                    <?php } ?>

                <?php } ?>
                
            </div>
        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>