<div id="div_empleados_grid" style="display:none;">
    <br>
    <div class="row">
        <div class="col-md-12">
            <h3>Empleados SIN Usuario asignado:</h3>
            <div id="tabla_empleados"></div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <button id="btx_asignar_empleado" class="btn btn-primary"><i class="fa fa-user m-r-5"></i> Asignar Empleado</button>
    </div>
</div><br>
<hr class="style m-b-20">
<div id="div_empleado" style="display:none">
    <div class="row">
        <div class="col-md-12">
            <h2>Empleado Asignado</h2>
        </div>
    </div>
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
                <h5>Datos Personales</h5>
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
        
        </div>
    </div>
    <hr class="style m-b-20">              
</div>
<br>
<h2>Datos de Usuario:</h2>
<form id="frm_usr" action="usuarios/save">
<div class="row">
    <div class="col-md-3">
        <label for="">Usuario de Acceso:</label>
        <input type="text" name="usuario" required class="form-control" maxlength="50">
    </div>
    <div class="col-md-3">
        <label for="">Contraseña:</label>
        <input type="password" name="password" required class="form-control" maxlength="20">
    </div>
    <div class="col-md-3">
        <label for="">Confirmación de Contraseña:</label>
        <input type="password" name="pass_conf" required class="form-control" maxlength="20">
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_usuario" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-save m-r-5"></i> Crear Usuario</button>
    </div>
</div>
</form>


