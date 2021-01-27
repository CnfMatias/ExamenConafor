<?php echo form_open_multipart('Empleados/save'); ?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row">
            <h5>Datos Personales</h5>
            <hr class="style">
        </div>
        <div class="row">
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
                <input name="estado_empleo_id" class="form-control" autocomplete="off" maxlength="200">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Nombre del Supervisor:</label>
                <input type="text" name="nombre_supervisor" class="form-control" autocomplete="off" placeholder="Nombre del Supervisor" maxlength="150" required>
            </div>
            <div class="col-md-4">
                <label for="">Titulo del Trabajo:</label>
                <input name="titulo_trabajo_id" class="form-control" autocomplete="off" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Sub-Unidad:</label>
                <input name="sub_unidad_id" class="form-control" autocomplete="off" maxlength="200">
            </div>
        </div>
    </div>
</div>

<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_empleado" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-reply m-r-5"></i> Regresar</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        let valores = <?= json_encode($empleado) ?>;
        $('input').each(function() {
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled', true)
        })
        $('select').each(function() {
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled', true)
        })
    })
</script>