<?php echo form_open_multipart('Tecnicos/actualizar');?> 
<div class="row">
    <div class="col-md-8" style="padding-left:30px">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
        </div>
        <div class="row m-t-20">
            <input type="number" name="id" style="display:none">
            <div class="col-md-3">
                <label for="">Cliente:</label>
                <select name="cliente_id" class="form-control mayus" autocomplete="off"  maxlength="15">
                        <?=$cliente_nom?>
                    </select>
            </div>
            <div class="col-md-4">
            <label for="">Costó:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" step="0.01" name="costo"  class="form-control mayus" autocomplete="off"  maxlength="200">
            </div>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Fecha de inició:</label>
                <input type="date"  name="fecha_inicio" class="form-control" autocomplete="off"  maxlength="18">
            </div>
            <div class="col-md-4">
                <label for="">Fecha final:</label>
                <input type="date" class="form-control" autocomplete="off" name="fecha_fin" maxlength="18">
            </div>
        </div>
        <!-- <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Empleado:</label>
                <select name="empleado_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                      
                    </select>
            </div>
        </div> -->
    </div>
</div>
<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_poliza" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-0 m-r-5"></i> Guardar Cambios</button>
    </div>
</div>

<script>
   
    $(document).ready(function(){
        let valores = <?=json_encode($poliza)?>;
        $('input').each(function(){
            $(this).val(valores[$(this).attr('name')])
        })
        $('select').each(function(){
            $(this).val(valores[$(this).attr('name')])
        })
        $('textarea').each(function(){
            $(this).val(valores[$(this).attr('name')])
        })
    })
</script>