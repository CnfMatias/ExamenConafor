<?Php
    $date1 = new DateTime(date('Y-m-d H:i:s'));
    $date2 = new DateTime($rollos->fecha_termino_potencial);
    $hrs = $date1->diff($date2)->h;
    $min = $date1->diff($date2)->i;
    $seg = $date1->diff($date2)->s;    
?>
<form id="frm_editar" method="post">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                    <h2>Nueva Fabricación de Rollo</h2>
                    <div class="row m-t-20">
                        <div class="col-md-3">
                            <div class="bg-grey" style="margin:5px;padding:40px 20px 20px 20px">
                            <span>Hilos de Algodon</span>
                            <input type="number" min="0" class="form-control m-t-10 text-center" name="halgodon">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="bg-grey" style="margin:5px;padding:40px 20px 20px 20px">
                            <span>Hilos de Licra</span>
                            <input type="number" min="0" class="form-control m-t-10 text-center" name="hlicra">
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
                    <input type="text" name="operador" class="form-control input2">
                </div>
                <div class="col-md-4">
                    <label for="">Estatus:</label>
                    <input type="text" name="estatus" class="form-control">
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-4">
                    <label for="">Fecha Creación:</label>
                    <input type="text" name="fecha_creacion" class="form-control input2 text-center">
                </div>
                <div class="col-md-4">
                    <label for="">Fecha Término Potencial:</label>
                    <input type="text" name="fecha_termino_potencial" class="form-control input2 text-center">
                </div>
                <div class="col-md-4">
                    <label for="">Fecha Término Real:</label>
                    <input type="text" name="fecha_termino" class="form-control input2 text-center">
                </div>
            </div>
            <div class="row m-t-20">            
                <div class="col-md-4">
                    <label for="">Hilos de Algodon con Defecto:</label>
                    <input type="number" min="0" name="halgodon_defecto" class="form-control text-center">
                </div>
                <div class="col-md-4">
                    <label for="">Hilos de Licra con Defecto:</label>
                    <input type="number" min="0" name="hlicra_defecto" class="form-control text-center">
                </div>
            </div>
            <div class="row m-t-20">
                <label for="">Observaciones:</label>
                <textarea name="observaciones" rows="5" class="form-control" maxlenght="255"></textarea>
            </div>
            <div class="row m-t-20">
                <div class="col-md-12 text-right">
                    <button class="btn btn-danger" id="btx_cancelar"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
                    <button class="btn btn-primary" type="submit" ide="<?=$rollos->id?>"><i class="fa fa-save m-r-5"></i> Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){
        let valores = <?=json_encode($rollos)?>;
        $('input').each(function(){
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled',true)
        })
        $('textarea').each(function(){
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled',true)
        })

        $('input[name=halgodon]').attr('disabled',false)
        $('input[name=hlicra]').attr('disabled',false)
        $('input[name=halgodon_defecto]').attr('disabled',false)
        $('input[name=hlicra_defecto]').attr('disabled',false)
        $('textarea[name=observaciones]').attr('disabled',false)
        $('input[name=tiempo_restante]').val('<?=$hrs.':'.$min.':'.$seg?>');
        
    })
</script>