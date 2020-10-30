<?Php
function separa_fecha($val){
    return explode(" ",$val)[0];
}

function separa_hora($val){
    return explode(":",explode(" ",$val)[1])[0].":".explode(":",explode(" ",$val)[1])[1];
}

function hora_actual(){
    return date('H:i');
}
?>

<form id="frm_fin" method="post">
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="row text-center"><div class="col-md-12"><h3>Finalizar Producción de Rollo</h3></div></div>
        <div class="row m-t-20">
            <div class="col-md-3 text-right m-t-15"><label for=""># Carga:</label></div>
            <div class="col-md-2 text-left"><input type="number" class="form-control" name="numero_carga" required></div>
            <div class="col-md-3 text-right m-t-15"><label for="">Peso (Kg):</label></div>
            <div class="col-md-2 text-left"><input type="number" class="form-control" name="peso_crudo" required step=".01"></div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-3 text-right m-t-15"><label for=""># de Rollo:</label></div>
            <div class="col-md-2 text-left"><input type="number" class="form-control" disabled name="numero_rollo" value="<?=$rollos->id?>"></div>
            <div class="col-md-3 text-right m-t-15"><label for="">Fecha de Fabricación:</label></div>
            <div class="col-md-3 text-left"><input type="date" class="form-control" disabled name="fecha_fabricacion" value="<?=separa_fecha($rollos->fecha_creacion)?>"></div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-3 text-right m-t-15">Hora Inicio:</div>
            <div class="col-md-3"><input type="time" class="form-control" disabled name="hora_inicio" value="<?=separa_hora($rollos->fecha_creacion)?>"></div>
            <div class="col-md-2 text-right m-t-15">Hora Fin:</div>
            <div class="col-md-2"><input type="time" class="form-control" name="fecha_termino" value="<?=hora_actual()?>"></div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-3 text-right m-t-15"><label for="">Nombre del Operador:</label></div>
            <div class="col-md-4 text-left"><input type="text" class="form-control" disabled name="operador" value="<?=$rollos->operador?>"></div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-12 m-t-15">
                <label for="">Observaciones:</label>
                <textarea name="observaciones" class="form-control" rows="5"><?=$rollos->observaciones?></textarea>
            </div>
        </div>
        <div class="row m-t-20">
        <div class="col-md-12 text-right">
        <button class="btn btn-danger" id="btx_cancelar"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" ide="<?=$rollos->id?>" class="btn btn-primary"><i class="fa fa-check m-r-5"></i> Finalizar</button>
        </div>
    </div>
    </div>
</div>
</form>