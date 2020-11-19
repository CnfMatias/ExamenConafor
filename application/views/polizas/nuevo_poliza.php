<script type="text/javascript" src="<?=base_url()?>frontend/js/jquery.mask.js"></script>
<?php echo form_open_multipart('Tecnicos/save');?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
            <hr class="style">
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="">Cliente:</label>
                <select name="cliente_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$cliente_nom?>
                    </select>
            </div>
            <div class="col-md-4">
            <label for="">Costó:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="text"  name="costo"  class="form-control mayus"  placeholder="0.00" autocomplete="off"  maxlength="7">
            </div>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Fecha de inició:</label>
                <input type="date"  name="fecha_inicio" class="form-control" autocomplete="off">
            </div>
            <div class="col-md-4">
                <label for="">Fecha final:</label>
                <input type="date" class="form-control" autocomplete="off" name="fecha_fin" maxlength="18">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Empleado:</label>
                <select name="empleado_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$emp_nom?>
                    </select>
            </div>
        </div>
    </div>
</div>
</form>                
<div class="row m-t-20">
    <div class="col-md-12 text-right">
    <button id="btx_cancela_poliza" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-save m-r-5"></i> Crear Técnico</button>
    </div>
</div>
</form>


<script>

        $("input[name=costo]").mask('000,000.00',{reverse:true});


</script>