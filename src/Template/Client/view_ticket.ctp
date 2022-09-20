<?php
    echo $this->element('loading');

    foreach ($data_tickets as $ticket) {
    }

    $user_id = $ticket->user_id;

    if($ticket->status == 1){ $status = '<div class="status pendente" style="color: #999;"> Pendente</div>'; }
    if($ticket->status == 0){ $status = '<div class="status resolvido" style="color: #a3d30c;"> Resolvido</div>'; }

?>



<!-- Menu Page -->
<div class="menu-page">
  <span class="title-page">Chamado</span>
</div>

<div class="area-actions" style="padding-top: 0px;">

    <!-- QUADROS -->
    <div class="row">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-mobile-b-30" style="padding-left: 0px;">

            <div class="box-white size-xs">

                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">

                        
                        <strong style="font-size: 20px;"><?php echo $ticket->subject; ?></strong>
                        <br>

                        <?php 
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
                        ?>

                        <span style="font-size: 12px;">Área responsável: <?php echo $area_ticket; ?></span>
                        <br>
                        
                        <span style="font-size: 12px;">Enviado <?php echo date_format($ticket->created, 'd/m/Y')."  às ".date_format($ticket->created, 'H:i'); ?></span>
                        <br>

                        
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="text-right">
                            <strong><?php echo $status; ?></strong>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <p>
                            "<?php echo $ticket->text; ?>"
                        </p>

                        <?php
                            foreach ($list_documents as $document) {

                                if($document->ticket_id == $ticket->id && $document->comment_id == 0){
                                    echo '<a href="/webroot/uploads/documents/'.$document->url.'" target="_blank" style="font-size: 14px; font-weight: 600;">Download do anexo</a><br><br>';
                                }
                            }
                        ?>
                    </div>
                </div>

                <hr><br>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                    <?php
                        $x = 0;

                        foreach ($data_comments as $comment) {

                            $x++;

                            $date = date_format($comment->created, 'd/m/Y')."  às ".date_format($comment->created, 'H:i');
                            
                            if($comment_permission[$comment->id] == 1){
                                $color_border = "999";
                            }else{
                                $color_border = "a3d30c";
                            }

                            echo '<div style="padding-left: 10px; border-left: 3px solid #'.$color_border.';">';
                            echo '<p style="font-size: 12px;"><strong>'.$comment_names[$comment->id]." - ".$date.'</strong><br>'.$comment->text.'</p>';
                            echo '</div>';

                            foreach ($list_documents as $document) {

                                if($document->comment_id == $comment->id){
                                    echo '<a href="/webroot/uploads/documents/'.$document->url.'" target="_blank" style="font-size: 14px; font-weight: 600;">Download do anexo</a>';
                                }
                            }

                            echo "<br>";
                        }

                        if($x == 0){
                            echo '<p style="font-size: 12px;">Nenhum comentário...</p>';
                        }
                    ?>

                    </div>
                </div>

                <?php if($ticket->status == 1){ ?>

                    <hr><br>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <span style="font-size: 12px;">Enviar comentário:</span>

                            <form action="/client/tickets/addcomment/<?php echo $ticket->id; ?>" method="post" id="form-add-comment-ticket" enctype="multipart/form-data">

                                <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>">

                                <textarea class="form-control margin-t-20" name="text" rows="6"
                                value="" style="font-size: 14px; background: #f8f8f8; padding: 20px; height: auto !important;"></textarea>

                                <br>

                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                        <span style="font-size: 12px;">Anexar documento:</span>
                                        <br><br>
                                        <input type="file" name="document_file" style="font-size: 12px;">
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 text-right">
                                        <!-- <div style="font-size: 12px; padding: 15px 40px; cursor: pointer;"
                                                class="btn btn-line-gray size-sm margin-t-50" id="btnAddCommentTicket" data-ticket="<?php echo $ticket->id; ?>">ENVIAR COMENTÁRIOS
                                        </div> -->
                                        <button type="submit" style="font-size: 12px; padding: 15px 40px; cursor: pointer;"
                                                class="btn btn-line-gray size-sm margin-t-50">ENVIAR COMENTÁRIOS
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                    <div class="text-center margin-t-50">

                        <div style="font-size: 12px; padding: 15px 40px;"
                                class="btn btn-yellow size-lg" id="btnCloseTicket" data-ticket="<?php echo $ticket->id; ?>">FECHAR CHAMADO
                        </div>
                    </div>

                <?php } ?>
                
            </div>
        </div>
    </div>

</div>

<?php
    echo $this->element('footer_panel');
?>