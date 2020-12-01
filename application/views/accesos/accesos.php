<div class="row">
    <div class="col-md-12">
        <div id="tabla_accesos"></div>
    </div>
</div>
<script>
    let columnas = [
        {title:"IP", field:"ip", sorter:"string",width:200,headerFilter:"input"},
        {title:"Agente", field:"agente", sorter:"string",align:'center',width:180, headerFilter:"input"},
        {title:"usuario_id", field:"usuario_id", sorter:"string", align:'center',width:150,headerFilter:"input"},
        {title:"Entrada", field:"entrada", sorter:"string",align:'center',width:120, headerFilter:"input"},
        {title:"Salida", field:"salida", sorter:"string",align:'center',width:180, headerFilter:"input"}

    ];

    
    var table = new Tabulator("#tabla_accesos", {
        layout:"fitColumns",
        reactiveData:true,
        data:<?=$accesos?>,
        columns:columnas
    });
    
</script>