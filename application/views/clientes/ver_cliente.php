<div class="row">
    <div class="col-md-8" style="padding-left:30px">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Nombre:</label>
                <input type="text"  name="nombre"  class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Telefono/cel:</label>
                <input type="text"  name="telefono"  class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Calle:</label>
                <input type="text"  name="calle" class="form-control mayus" autocomplete="off" placeholder="Max 200 caracteres" maxlength="200">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-3">
                <label for="">Numero Exterior:</label>
                <input type="number"  name="num_ext"  class="form-control mayus" autocomplete="off" placeholder="Max 200 caracteres" maxlength="200">
            </div>
            <div class="col-md-3">
                <label for="">Numero Interior:</label>
                <input type="number"  name="num_int" class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-6">
                <label for="">Entre Calles:</label>
                <input type="text"  name="entre_calles"  class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Codigo Postal:</label>
                <input type="number"  name="codigo_postal"  class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Correo Electronico:</label>
                <input type="text"  name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control mayus" autocomplete="off" placeholder="Max 200 caracteres" maxlength="200">
            </div>
        </div>
    </div>
</div>
<div class="row m-t-20">
    <div class="col-md-12 text-right">
        <button id="btx_cancela_cliente" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-reply m-r-5"></i> Regresar</button>
    </div>
</div>
<script>
    $(document).ready(function(){
        let valores = <?=json_encode($cliente)?>;
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
        /* if(valores['foto_emp'] != ''){
            $('img[name=foto_emp]').attr('src',frontend/emps/'+valores['foto_emp']) */
        
    })
</script>