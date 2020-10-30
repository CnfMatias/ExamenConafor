<?Php
$date1 = new DateTime(date('Y-m-d H:i:s'));
$date2 = new DateTime($rollos->fecha_termino_potencial);
$hrs = $date1->diff($date2)->h;
$min = $date1->diff($date2)->i;
$seg = $date1->diff($date2)->s;

?>
<div class="row">
    <div class="col-10 offset-md-1">
        <div class="accordion accordion-hover" id="vw_rollos">
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#card_produccion" aria-expanded="false">
                        En Producción
                        <span class="ml-auto">
                            <span class="collapsed-reveal"><i class="fal fa-chevron-up fs-xl"></i></span>
                            <span class="collapsed-hidden"><i class="fal fa-chevron-down fs-xl"></i></span>
                        </span>
                    </a>
                </div>
                <div id="card_produccion" class="collapse show" data-parent="#vw_rollos">
                    <div class="card-body">
                        <div class="row">
                            <div class="row m-t-20">
                                <div class="col-md-3">
                                    <div class="bg-grey" style="margin:5px;padding:40px 20px 20px 20px">
                                        <span>Hilos de Algodon</span>
                                        <input type="input" class="form-control m-t-10 text-center" name="halgodon">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bg-grey" style="margin:5px;padding:40px 20px 20px 20px">
                                        <span>Hilos de Licra</span>
                                        <input type="input" class="form-control m-t-10 text-center" name="hlicra">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bg-grey" style="margin:5px;padding: 10px 20px 15px 20px">
                                        <span>Tiempo de fabricación estimado (hrs)</span>
                                        <input type="input" class="form-control m-t-10 text-center" name="horas_proceso">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bg-grey" style="margin:5px;padding: 30px 20px 15px 20px">
                                        <span>Tiempo Restante (hrs)</span>
                                        <input type="input" class="form-control m-t-10 text-center" name="tiempo_restante">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-md-8">
                                <label for="">Creador:</label>
                                <input type="text" name="operador" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Estatus:</label>
                                <input type="text" name="estatus" class="form-control">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-md-4">
                                <label for="">Fecha Creación:</label>
                                <input type="text" name="fecha_creacion" class="form-control text-center">
                            </div>
                            <div class="col-md-4">
                                <label for="">Fecha Término Potencial:</label>
                                <input type="text" name="fecha_termino_potencial" class="form-control text-center">
                            </div>
                            <div class="col-md-4">
                                <label for="">Fecha Término Real:</label>
                                <input type="text" name="fecha_termino" class="form-control text-center">
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-md-4">
                                <label for="">Hilos de Algodon con Defecto:</label>
                                <input type="text" name="halgodon_defecto" class="form-control text-center">
                            </div>
                            <div class="col-md-4">
                                <label for="">Hilos de Licra con Defecto:</label>
                                <input type="text" name="hlicra_defecto" class="form-control text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#card_crudo" aria-expanded="false">
                        Rollo en Crudo
                        <span class="ml-auto">
                            <span class="collapsed-reveal"><i class="fal fa-chevron-up fs-xl"></i></span>
                            <span class="collapsed-hidden"><i class="fal fa-chevron-down fs-xl"></i></span>
                        </span>
                    </a>
                </div>
                <div id="card_crudo" class="collapse" data-parent="#vw_rollos">
                    <div class="card-body">
                        <div class="row m-t-20">
                            <div class="col-3 offset-3">
                                <label for=""># Carga:</label>
                                <input type="text" name="numero_carga" class="form-control text-center">
                            </div>
                            <div class="col-md-3">
                                <label for="">Peso (Kg):</label>
                                <input type="text" name="peso_crudo" class="form-control text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#card_provee" aria-expanded="false">
                        Con Proveedor
                        <span class="ml-auto">
                            <span class="collapsed-reveal"><i class="fal fa-chevron-up fs-xl"></i></span>
                            <span class="collapsed-hidden"><i class="fal fa-chevron-down fs-xl"></i></span>
                        </span>
                    </a>
                </div>
                <div id="card_provee" class="collapse" data-parent="#vw_rollos">
                    <div class="card-body">
                        <div class="row m-t-20">
                            <div class="col-3 offset-3">
                                <label for=""># Tonga:</label>
                                <input type="text" name="num_tonga" class="form-control text-center">
                            </div>
                            <div class="col-md-3">
                                <label for="">Fecha de Envio:</label>
                                <input type="date" name="fecha_envio_proveedor" class="form-control text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a href="javascript:void(0);" class="card-title collapsed" data-toggle="collapse" data-target="#card_alma" aria-expanded="false">
                        En Almacen
                        <span class="ml-auto">
                            <span class="collapsed-reveal"><i class="fal fa-chevron-up fs-xl"></i></span>
                            <span class="collapsed-hidden"><i class="fal fa-chevron-down fs-xl"></i></span>
                        </span>
                    </a>
                </div>
                <div id="card_alma" class="collapse" data-parent="#vw_rollos">
                    <div class="card-body">
                        <div class="row m-t-20">
                            <div class="col-4">
                                <label for="">Color:</label><br>
                                <span class="m-l-40" style="height: 25px;width: 25px;background-color:<?=$rollos->color_hex_final?>;border-radius: 50%;display: inline-block;"></span> <span class="m-l-10"><?=$rollos->color_final?></span>
                            </div>
                            <div class="col-4">
                                <label for="">Peso de Entrega (kg):</label>
                                <input type="number" name="peso_entregado" class="form-control text-center">
                            </div>
                            <div class="col-4">
                                <label for="">Fecha de Entrada:</label>
                                <input type="date" name="fec_entrega" class="form-control text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        let valores = <?= json_encode($rollos) ?>;
        $('input').each(function() {
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled', true)
        })
        $('textarea').each(function() {
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled', true)
        })

        $('input[name=tiempo_restante]').val('<?= $hrs . ':' . $min . ':' . $seg ?>');

    })
</script>