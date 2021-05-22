<?php
    require_once("../../_class/global.php");
?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <form id="formPrincipal">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Dados cadastrais</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Descrição</label>
                                        <input type="text" class="form-control" name="descricao" required></input>
                                        <input type="hidden" class="form-control" name="id" disabled></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Configuração de vencimentos</h3>

                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Forma de pagamento</label>
                                        <select class="form-control" name="formaPagamento" required>
                                            <?=selectFormaPagamento()?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Parcelas</label>
                                        <input type="number" class="form-control" name="parcelas" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Carência</label>
                                        <input type="number" class="form-control" name="carencia" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Intervalo</label>
                                        <input type="number" class="form-control" name="intervalo" required></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>(%) Desconto</label>
                                        <input type="text" class="form-control inputDinheiro" name="desconto"></input>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Dias bloqueados</label>
                                        <input type="button" class="form-control btn-primary" id="diasBloqueados" value="Configurar"></input>
                                        <input type="hidden" name="diasBloqueados"></input>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </div>
                    </div>
                </div>                
                
                <div class="botoesBase">
                    <button type="button" class="btn btn-secondary" onclick="toLastGrid();">Cancelar</button>
                    <button type="submit" class="btn btn-primary submitFormPrincipal">Salvar</button>
                </div>
            </form>
        </div>
    </section>

    <div class="modal fade" id="modalDias">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Configuração de dias</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="1" value="Segunda"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="2" value="Terça"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="3" value="Quarta"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="4" value="Quinta"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="5" value="Sexta"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="6" value="Sábado"></input>
                            <input type="button" class="form-control btn-primary semanaButtons semanaAtivo" id="0" value="Domingo"></input>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <style>
        .semanaButtons{
            margin-bottom:4px;
        }
        .semanaAtivo{
            background-color: #048243 !important;
            border-color: #048243 !important;
        }
        .semanaInativo{
            background-color: #5A6268 !important;
            border-color: #5A6268 !important;
        }
    </style>
    <script>
        $('#modalDias').focusout(function(){
            var semana = '';
            $('.semanaInativo').each(function(){
                semana += $(this).attr('id') + '; ';
            });
            $('input[name="diasBloqueados"]').val(semana.substring(0, semana.length -2));
        });

        function verificaDiasAtivos(){
            var cont = 0;
            $('.semanaAtivo').each(function(){
                cont++;
            });
            if(cont > 1) return true;
        }

        function desativarDias(){
            var dia = $('input[name="diasBloqueados"]').val().split('; ');
            $(dia).each(function(k,v){
                $('#'+v).removeClass('semanaAtivo').addClass('semanaInativo');
            });
        }

        $('.semanaButtons').click(function(){
            if($(this).hasClass('semanaAtivo')){
                if(verificaDiasAtivos()){
                    $(this).removeClass('semanaAtivo').addClass('semanaInativo');
                }else{
                    toast('error', 'Não foi possível desativar o dia, é necessário ter pelo menos um dia da semana ativo.');
                }
            }else{
                $(this).removeClass('semanaInativo').addClass('semanaAtivo');
            }
        });

        $('#diasBloqueados').click(function(){
            $('#modalDias').modal('show');
        });

        $(document).ready(function() {
            verifyURLForm();
            setTimeout(function(){ desativarDias(); }, 100);
        });
    </script>
