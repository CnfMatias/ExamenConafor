<?php echo form_open_multipart('Empleados/save');?>
<div class="row">
    <div class="col-md-4" style="border-right:1px solid #BBBBBB;vertical-align:middle; padding-right:30px">
        <div class="row m-t-20">
            <div class="col-md-12">
                <label class="form-label m-t-20">Foto:</label>
                <img src="<?=base_url()?>frontend/images/user.png" name="foto_emp" id="imgSalida" width="330" height="210" class="img img-fluid" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-file">
                    <input type="file" name="foto_empleado" id="foto_empleado"  class="custom-file-input">
                    <label class="custom-file-label" for="customFile">Elegir Archivo</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" style="padding-left:30px">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Nombre:</label>
                <input type="text"  name="nombre" class="form-control mayus" autocomplete="off" maxlength="200">
            </div>
            <div class="col-md-3">
                <label for="">Dirreción:</label>
                <input type="text" class="form-control mayus"  name="direccion" autocomplete="off" maxlength="18">
            </div>
            <div class="col-md-6">
                <label for="">Correo Electronico:</label>
                <input type="text" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="correo" maxlength="18">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Telefono/cel::</label>
                <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" name="tel" class="form-control" autocomplete="off" placeholder="33-1234-1234" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Fecha de nacimiento:</label>   
                <input type="text" name="fecha_nacimiento"  class="form-control" maxlength="50">
            </div>
            <div class="col-md-5">
                <label for="">Tipo de puesto:</label>
                    <select name="perfil_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$perfiles?>
                    </select>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Tipo de Sueldo:</label>
                <select name="tipo_sueldo_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                    <?=$sueldos?>
                </select>
            </div>
            <div class="col-md-4">
                <label for="">Sueldo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="number" step="0.01" name="monto_sueldo"  class="form-control mayus" autocomplete="off"  maxlength="200">
                </div>
            </div>
            
        </div>
    </div>
</div>                
<div class="row m-t-20">
    <div class="col-md-12 text-right">
    <button id="btx_cancela_empleado" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-save m-r-5"></i> Crear Empleado</button>
    </div>
</div>
</form>