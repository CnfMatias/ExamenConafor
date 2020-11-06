<?php echo form_open_multipart('clientes/save');?>
<div class="row">
    
    <div class="col-md-8" style="padding-left:30px">
        <div class="row m-t-20">
            <h5>Datos Personales</h5>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Nombre:</label>
                <input type="text"  name="nombre" class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-4">
                <label for="">Telefono/Cel:</label>
                <input type="tel"  name="telefono"  class="form-control mayus" pattern="[0-9]{2}-[0-9]{4}-[0-9]{4}" autocomplete="off" placeholder="33-1234-1234" maxlength="200">
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
                <input type="text"  name="entre_calles"  class="form-control mayus" autocomplete="off" placeholder="Max 250 caracteres" maxlength="250">
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-4">
                <label for="">Codigo Postal:</label>
                <input type="number"  name="codigo_postal"  class="form-control mayus" autocomplete="off" placeholder="Max 150 caracteres" maxlength="200">
            </div>
            <div class="col-md-6">
                <label for="">Correo Electronico:</label>
                <input type="email"  name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control mayus" autocomplete="off" placeholder="Max 200 caracteres" maxlength="200">
            </div>
        </div>
    </div>
</div>                
<div class="row m-t-20">
    <div class="col-md-12 text-right">
    <button id="btx_cancela_cliente" class="btn btn-danger waves-effect waves-themed"><i class="fa fa-ban m-r-5"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary waves-effect waves-themed"><i class="fa fa-save m-r-5"></i> Crear Cliente</button>
    </div>
</div>
</form>