<div class="row">
    <div class="col-md-8" style="padding-left:30px">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Cliente:</label>
                <input name="cliente_nom" class="form-control mayus" autocomplete="off"  >
                
            </div>
            <div class="col-md-4">
            <label for="">Costó:</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" step="0.01" name="costo"  class="form-control mayus" autocomplete="off"  maxlength="200">
            </div>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Fecha de inició:</label>
                <input type="date"  name="fecha_inicio" class="form-control" autocomplete="off"  maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Fecha final:</label>
                <input type="date" class="form-control" autocomplete="off" name="fecha_fin" maxlength="18">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Empleado:</label>
                <input name="emp_nom" class="form-control mayus" autocomplete="off"  maxlength="200">
            </div>
        </div>
    </div>
</div>  


<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_poliza" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-reply m-r-5"></i> Regresar</button>
    </div>
</div>
<script>
    $(document).ready(function(){
        let valores = <?=json_encode($poliza)?>;
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

    })
</script>