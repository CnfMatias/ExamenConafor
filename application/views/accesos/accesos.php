<div class="row">
    <div class="col-md-12">
        <div id="tabla_accesos"></div>
    </div>
</div>
<script>

    var table = new Tabulator("#tabla_accesos", {
        layout:"fitColumns",
        reactiveData:true,
        data:<?=$accesos?>,
        columns:columnas
    });
    
</script>