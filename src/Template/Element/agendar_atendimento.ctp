
<div class="modal fade" id="agendar_atendimento" tabindex="-1" role="dialog" aria-labelledby="alert_modalLabel" aria-hidden="true">
    <div class="modal-dialog size-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="btn-close-modal" data-dismiss="modal" aria-label="Close">
                    <span class="icon ion-ios-close-empty"></span>
                </div>
                <h3 style="font-weight: 500; color: #666;">Preencha o formulário abaixo:</h3>
            </div>
            <div class="modal-body">

                <p class="text" style="font-size: 14px;" id="modal_text">

                    <form id="form-contact" style="padding: 10px;">

                        <input type="hidden" name="type_send" value="normal">

                        <h5 style="color: #999;">Nome</h5>
                        <input type="text" name="name" class="form-control active required" value=""
                        style="width: 100%; margin-top: 0px;">

                        <h5 style="color: #999;" class="margin-t-20">E-mail</h5>
                        <input type="email" name="email" class="form-control active required" value=""
                        style="width: 100%; margin-top: 0px;">

                        <h5 style="color: #999;" class="margin-t-20">Telefone</h5>
                        <input type="text" name="phone" class="form-control active mask-phone" value=""
                        style="width: 100%; margin-top: 0px;">

                        <input type="hidden" name="message" class="form-control active" value="Agendamento de ligação" rows="5" style="width: 100%; margin-top: 0px; height: auto !important;" />

                        <div class="btn btn-yellow margin-t-50 size-lg" id="btnSendContact" data-type="auto">
                            AGENDAR LIGAÇÃO
                        </div>
                        <a class="btn btn-yellow margin-t-50 size-lg" href="https://api.whatsapp.com/send?phone=5512981473602">
                            VIA WHATSAPP
                        </a>

                    </form>
                </p>

            </div>
        </div>
    </div>
</div>
