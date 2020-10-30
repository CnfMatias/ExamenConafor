<div class="row">
    <div class="col-md-4" style="border-right:1px solid #BBBBBB;vertical-align:middle; padding-right:30px">
        <div class="row m-t-20">
            <div class="col-md-12">
            <label class="form-label m-t-20">Foto:</label>
                <img name="foto_emp" src="<?=base_url()?>frontend/images/user.png" class="img img-fluid img-thumbnail" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="custom-file">
                    <input type="file"  class="custom-file-input" id="archivo">
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
                <input type="text"  name="nombre" class="form-control mayus" autocomplete="off" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">CURP:</label>
                <input type="text" class="form-control mayus"  name="curp" autocomplete="off" maxlength="18">
            </div>
            <div class="col-md-2">
                <label for="">Edad:</label>
                <input type="text" class="form-control"  name="edad" maxlength="2">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Fecha de Nacimiento:</label>
                <input type="text" name="fecha_nacimiento"  class="form-control">
            </div>
            <div class="col-md-4">
                <label for="">Escolaridad:</label>   
                <input type="text" name="escolaridad"  class="form-control" maxlength="50">
            </div>
            <div class="col-md-5">
                <label for="">Especialidad:</label>   
                <input type="text" name="especialidad"  class="form-control" maxlength="100">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <label for="">Domicilio:</label>
                <input type="text" name="domicilio"  class="form-control" autocomplete="off" maxlength="250">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Teléfono Celular:</label>
                <input type="text" name="celular" class="form-control telefono" autocomplete="off">
            </div>
            <div class="col-md-4">
                <label for="">E-mail:</label>
                <input type="text" name="email"  class="form-control" autocomplete="off" maxlength="100">
            </div>
        </div>
        <div class="row m-t-20">
            <h5>Experiendia Laboral</h5>
            <div class="col-md-12">
                <textarea name="experiencia" cols="30" rows="5" class="form-control" maxlength="500"></textarea>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-9">
                <label for="">Puesto a Ocupar:</label>
                <select name="puesto" class="form-control"><?=$puestos?></select>
            </div>
            <div class="col-md-3">
                <label for="">Fecha de Ingreso:</label>
                <input type="text"  name="fecha_ingreso" class="form-control">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <label for="">Descripción de Actividades:</label>
                <textarea name="actividades" cols="30" rows="5" class="form-control" maxlength="600"></textarea>
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
    $(document).ready(function(){
        let valores = <?=json_encode($empleado)?>;
        $('input').each(function(){
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled',true)
        })
        $('select').each(function(){
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled',true)
        })
        $('textarea').each(function(){
            $(this).val(valores[$(this).attr('name')])
            $(this).attr('disabled',true)
        })
        if(valores['foto_emp'] != ''){
            $('img[name=foto_emp]').attr('src','<?=base_url()?>frontend/emps/'+valores['foto_emp'])
        }
    })
</script>