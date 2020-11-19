<div class="row">
    <div class="col-md-12">
        <div id="tabla_accesos"></div>
    </div>
</div>
<script>
    let columnas = [
        {title:"Nombre", field:"nombre", sorter:"string",width:200,headerFilter:"input"},
        {title:"Estado", field:"estado", sorter:"string", align:'center',width:150,headerFilter:"input"},
        {title:"Correo", field:"correo", sorter:"string",align:'center',width:120, headerFilter:"input"},
        {title:"Telefono/cel", field:"tel", sorter:"number",align:'center',width:180, headerFilter:"input"},
        {title:"Perfil", field:"perfil", sorter:"string",align:'center',width:180, headerFilter:"input"}

    ];

    
    var table = new Tabulator("#tabla_accesos", {
        layout:"fitColumns",
        reactiveData:true,
        data:<?=$accesos?>,
        columns:columnas
    });
    
</script>