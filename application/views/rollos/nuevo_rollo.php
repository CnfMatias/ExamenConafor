<form id="frm_nuevo" method="post">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col text-center">
                    <h2>Nueva Fabricación de Rollo</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="accordion accordion-hover" id="js_demo_accordion-5">
                        <div class="card">
                            <div class="card-header">
                                <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#js_demo_accordion-5a" aria-expanded="false">
                                    <i class="fal fa-bullseye width-2 fs-xl"></i>
                                    ¿Se requieren más bobinas de hilo?
                                    <span class="ml-auto">
                                        <span class="collapsed-reveal">
                                            <i class="fal fa-chevron-up fs-xl"></i>
                                        </span>
                                        <span class="collapsed-hidden">
                                            <i class="fal fa-chevron-down fs-xl"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div id="js_demo_accordion-5a" class="collapse" data-parent="#js_demo_accordion-5">
                                <div class="card-body">
                                    <div class="row m-t-20">
                                        <div class="col text-center">
                                            <div class="bg-grey" style="margin:10px;padding:20px">
                                                <span>Bobinas de Algodon</span>
                                                <input type="number" min="0" class="form-control m-t-10 text-center" name="halgodon" value="0">
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <div class="bg-grey" style="margin:10px;padding:20px">
                                                <span>Bobinas de Licra</span>
                                                <input type="number" min="0" class="form-control m-t-10 text-center" name="hlicra" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-6 m-t-15 text-center">
                    <div class="bg-grey" style="margin:10px;padding: 10px 20px 15px 20px">
                        <span>Máquina a utilizar</span>
                        <input type="text" class="form-control m-t-10 text-center" name="maquina" placeholder="Max 100 caracteres" required>
                    </div>
                </div>
                <div class="col-6 m-t-15 text-center">
                    <div class="bg-grey" style="margin:10px;padding: 10px 20px 15px 20px">
                        <span>Tiempo de fabricación estimado en Horas</span>
                        <input type="time" class="form-control m-t-10 text-center" name="horas_proceso" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <label for="">Observaciones:</label>
                    <textarea name="observaciones" rows="5" class="form-control" maxlenght="255"></textarea>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col text-right">
                    <button class="btn btn-danger" id="btx_cancelar"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-play m-r-5"></i> Iniciar Producción</button>
                </div>
            </div>
        </div>
    </div>
</form>
