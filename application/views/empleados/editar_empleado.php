<?php echo form_open_multipart('Empleados/save'); ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row">
            <h5>Datos Personales</h5>
            <hr class="style">
        </div>
        <div class="row">
            <input type="text" name="id" style="display:none">

            <div class="col-md-4">
                <label for="">Nombre:</label>
                <input type="text" name="nombre" class="form-control" autocomplete="off" placeholder="Nombre del empleado" maxlength="150" required>
            </div>
            <div class="col-md-4">
                <label for="">Apellido:</label>
                <input type="text" name="apellido" class="form-control" autocomplete="off" placeholder="Apellidos" maxlength="150" required>
            </div>
            <div class="col-md-4">
                <label for="">Estado del Empleo</label>
                <select name="estado_empleo_id" class="form-control" autocomplete="off">
                    <?= $estado_empleo ?>
                </select>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Nombre del Supervisor:</label>
                <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Nombre del Supervisor" maxlength="150" required>
            </div>
            <div class="col-md-4">
                <label for="">Titulo del Trabajo:</label>
                <select name="titulo_trabajo_id" class="form-control" autocomplete="off" maxlength="200">
                    <?= $titulo_trabajo ?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">Sub-Unidad:</label>
                <select name="sub_unidad_id" class="form-control" autocomplete="off" maxlength="200">
                    <?= $sub_unidad ?>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button type="button" id="btx_cancela_empleado" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-save m-r-5"></i> Actualizar Empleado</button>
    </div>
</div>

</form>

<script>
    $(document).ready(function() {
        let valores = <?= json_encode($empleado) ?>;
        $('input').each(function() {
            $(this).val(valores[$(this).attr('name')])
        })
        $('select').each(function() {
            $(this).val(valores[$(this).attr('name')])
        })
    })
</script>