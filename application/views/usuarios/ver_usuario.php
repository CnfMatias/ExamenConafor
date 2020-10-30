<?php echo form_open_multipart('Usuarios/actualizar');?>
<div id="div_empleado">
    <div class="row">
        <div class="col-md-4" style="border-right:1px solid #BBBBBB;vertical-align:middle; padding-right:30px">
            <div class="row m-t-20">
                <div class="col-md-12">
                <label class="form-label m-t-20">Foto:</label>
                    <img name="foto_emp" src="<?=base_url()?>frontend/images/user.png" class="img img-fluid" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-8" style="padding-left:30px">
            <div class="row m-t-20">
                <h3>Datos de Empleado</h3>
            </div>
            <div class="row m-t-20">
                <div class="col-md-2">
                    <label for=""># de Empleado:</label>
                    <input type="text" class="form-control"  name="id" maxlength="2" disabled>
                </div>
                <div class="col-md-8">
                    <label for="">Nombre:</label>
                    <input type="text"  name="nombre" class="form-control mayus" disabled autocomplete="off" maxlength="200">
                </div>
                <div class="col-md-2">
                    <label for="">Edad:</label>
                    <input type="text" class="form-control"  name="edad" maxlength="2" disabled>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-4">
                    <label for="">Teléfono Casa:</label>
                    <input type="text" name="telefono" class="form-control telefono" autocomplete="off" disabled>
                </div>
                <div class="col-md-4">
                    <label for="">Teléfono Celular:</label>
                    <input type="text" name="celular" class="form-control telefono" autocomplete="off" disabled>
                </div>
                <div class="col-md-4">
                    <label for="">E-mail:</label>
                    <input type="text" name="email"  class="form-control" autocomplete="off" maxlength="100" disabled>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-6">
                    <label for="">Dirección:</label>
                    <input name="domicilio" class="form-control" value="" disabled>
                </div>
                <div class="col-md-6">
                    <label for="">Puesto:</label>
                    <input name="puesto" class="form-control" value="" disabled>
                </div>
            </div>
            <div class="row m-t-20">
                <h3>Datos de Usuario:</h3>
            </div>
            <div class="row m-t-20">
                <div class="col-md-6">
                    <label for="">Usuario de Acceso:</label>
                    <input type="text" name="usuario" required class="form-control" maxlength="50" readonly>
                </div>
            </div>
        
        </div>
    </div>
    <hr class="style m-b-20">              
</div>

<div class="row">
   
</div>
<br>
<div class="row">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_usuario" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
    </div>
</div>
</form>
<script>

    let valores = <?=json_encode($usuario)?>;

    $('input').each(function(){
        $(this).val(valores[$(this).attr('name')])
    })
    $('select').each(function(){
        $(this).val(valores[$(this).attr('name')])
    })
    $('textarea').each(function(){
        $(this).val(valores[$(this).attr('name')])
    })
    if(valores['foto_emp'] != ''){
        $('img[name=foto_emp]').attr('src','<?=base_url()?>frontend/emps/'+valores['foto_emp'])
    }
</script>