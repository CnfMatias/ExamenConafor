<!-- Falta identificar cuandos es edicion y cuando es un insert -->
<script type="text/javascript" src="<?=base_url()?>frontend/js/jquery.mask.js"></script>
<?php echo form_open_multipart('Empleados/actualizar');?>
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
        <div class="row">
            <div class="col-md-3" >
                <input type="text" name="id" style="display:none">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-6">
                <label for="">Nombre:</label>
                <input type="text"  name="nombre" class="form-control mayus" autocomplete="off" maxlength="200">
            </div>
            <div class="col-md-6">
                <label for="">Dirección:</label>
                <input type="text" class="form-control mayus"  name="direccion" autocomplete="off" maxlength="200">
            </div>
        </div>
        <div class="row m-t-20">
             <div class="col-md-3">
                <label for="">Correo Electronico:</label>
                <input type="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="correo" maxlength="200">
            </div>
            <div class="col-md-3">
                <label for="">Telefono/Cel::</label>
                <input type="tel" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" name="tel" class="form-control" autocomplete="off" placeholder="33-1234-1234" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Fecha de nacimiento:</label>   
                <input type="date" name="fecha_nacimiento"  class="form-control" maxlength="50">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Tipo de puesto:</label>
                    <select name="perfil_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$perfiles?>
                    </select>
            </div>
            <div class="col-md-3">
                    <label for="">Tipo de Sueldo:</label>
                    <select name="tipo_sueldo_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$sueldos?>
                    </select>
            </div>
            <div class="col-md-4">
            <label for="">Sueldo:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="text"  name="monto_sueldo"  class="form-control mayus"  placeholder="0.00" autocomplete="off"  maxlength="7">
            </div>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5">
                    <label for="">Estado:</label>
                    <select name="estado_id" class="form-control mayus" autocomplete="off"  maxlength="200">
                        <?=$estados?>
                    </select>
            </div>
        </div>
        <div id="v_tecnico" style="display:none;">
            <div class="row m-t-20">
                <h5>Datos del técnico</h5>
            </div>
            <div class="row m-t-20">
                <div class="col-md-4">
                <label for="">Limite Credito</label>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text"  name="limite_credito"  class="form-control mayus"  placeholder="0.00" autocomplete="off"  maxlength="7">
                </div>
                </div>
                <div class="col-md-4">
                <label for="">Maximo de servicios activos</label>
                <input type="number"  name="max_servicios"  class="form-control mayus"   autocomplete="off"  maxlength="2">
                </div>
            </div>
        </div>
    </div>
</div>                
<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_empleado" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-0 m-r-5"></i> Guardar Cambios</button>
    </div>
</div>

<script>

        $("input[name=tel]").mask('00-0000-0000');
        $("input[name=monto_sueldo]").mask('000,000.00',{reverse:true});
        $("input[name=limite_credito]").mask('000,000.00',{reverse:true});

    
   
    $(document).ready(function(){
        let valores = <?=json_encode($empleado)?>;
        $('input').each(function(){
            $(this).val(valores[$(this).attr('name')])
        })
        $('select').each(function(){
            $(this).val(valores[$(this).attr('name')]);
            //alert($(this).attr('name'))
            if($(this).attr('name') == 'perfil_id' && $(this).val() == 4)
                 $("#v_tecnico").show();
        })
        $('textarea').each(function(){
            $(this).val(valores[$(this).attr('name')])
        })
        if(valores['foto_emp'] != ''){
            $('img[name=foto_emp]').attr('src','<?=base_url()?>frontend/emps/'+valores['foto_emp'])
        }

        $('select[name=perfil_id]').change(function(){
            let id = $(this).val();
            if(id == 4)
                $("#v_tecnico").show();
            else
                $("#v_tecnico").hide();
        })
    })
</script>