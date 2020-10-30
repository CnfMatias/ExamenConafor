<?php echo form_open_multipart('Empleados/save');?>
<div class="row">
    <div class="col-md-4" style="border-right:1px solid #BBBBBB;vertical-align:middle; padding-right:30px">
        <div class="row m-t-20">
            <div class="col-md-12">
                <label class="form-label m-t-20">Foto:</label>
                <img src="<?=base_url()?>frontend/images/user.png" id="imgSalida" width="330" height="210" class="img img-fluid" alt="">
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
            <div class="col-md-6">
                <label for="">Nombre:</label>
                <input type="text"  name="nombre" class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">CURP: <a class="m-l-40 btn btn-xs btn-primary" target="_blank" href="https://www.gob.mx/curp/"> Obtener  CURP</a></label>
                <input type="text" class="form-control mayus"  name="curp" autocomplete="off" placeholder="Max 18 caracteres" maxlength="18">
            </div>
            <div class="col-md-2">
                <label for="">Edad:</label>
                <input type="text" class="form-control"  name="edad" maxlength="2" placeholder="Max 2">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento"  class="form-control">
            </div>
            <div class="col-md-4">
                <label for="">Escolaridad:</label>   
                <input type="text" name="escolaridad"  class="form-control" maxlength="50" placeholder="Max 50 caracteres">
            </div>
            <div class="col-md-5">
                <label for="">Especialidad:</label>   
                <input type="text" name="especialidad"  class="form-control" maxlength="100" placeholder="Max 100 caracteres">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <label for="">Domicilio:</label>
                <input type="text" name="domicilio"  class="form-control" autocomplete="off" placeholder="Max 250 caracteres" maxlength="250">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Teléfono Celular:</label>
                <input type="tel" placeholder="55-1234-1234" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" name="celular" class="form-control telefono" maxlength="12" autocomplete="off" placeholder="Max 10 caracteres">
            </div>
            <div class="col-md-4">
                <label for="">E-mail:</label>
                <input type="text" name="email"  class="form-control" autocomplete="off" placeholder="Max 100 caracteres" maxlength="100">
            </div>
        </div>
        <div class="row m-t-20">
            <h5>Experiendia Laboral</h5>
            <div class="col-md-12">
                <textarea name="experiencia" cols="30" rows="5" class="form-control" placeholder="Max 500 caracteres" maxlength="500"></textarea>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-9">
                <label for="">Puesto a Ocupar:</label>
                <select name="puesto" class="form-control"><?=$puestos?></select>
            </div>
            <div class="col-md-3">
                <label for="">Fecha de Ingreso:</label>
                <input type="date"  name="fecha_ingreso" class="form-control">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <label for="">Descripción de Actividades:</label>
                <textarea name="actividades" cols="30" rows="5" class="form-control" placeholder="Max 600 caracteres" maxlength="600"></textarea>
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