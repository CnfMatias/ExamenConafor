<div class="row">
    <div class="col col-md-12 text-right">
        <button class="btn btn-primary" id="btn_nvo_poliza" ><i class="fa fa-plus"></i> Nueva Poliza</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div id="tabla_polizas"></div>
    </div>
</div>
<script>
    let columnas = [
        {title:"Cliente", field:"cliente_nom", sorter:"String",width:200,headerFilter:"input"},
        {title:"Costo", field:"costo", sorter:"string", align:'center',width:150,headerFilter:"input"},
        {title:"Fecha inició", field:"fecha_inicio", sorter:"string",align:'center',width:120, headerFilter:"input"},
        {title:"Fecha final", field:"fecha_fin", sorter:"string",align:'center',width:180, headerFilter:"input"}
    ];

    let icons = function(cell, formatterParams){
        let color = (cell.getRow().getData().estatus_general_id == 3)? 'btn-sky':'btn-secondary';
        return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='"+cell.getRow().getData().id+"'><i class='fa fa-eye'></i></div>" +
        "<div class='m-l-10 btn "+color+" btn-sm btx_activar' title='Activar' ide='"+cell.getRow().getData().id+"-"+cell.getRow().getData().estatus_general_id+"'><i class='fa fa-power-off'></i></div>" + 
        "<div class='m-l-10 btn btn-green btn-sm btx_editar' title='Editar' ide='"+cell.getRow().getData().id+"'><i class='fa fa-edit'></i></div>" +
        "<div class='m-l-10 btn btn-danger btn-sm btx_eliminar' title='Eliminar Articulo' ide='"+cell.getRow().getData().id+"'><i class='fa fa-trash'></i></div>";
    };

    columnas.push({title:'Acciones', formatter:icons,align:'center'});
    var table = new Tabulator("#tabla_polizas", {
        layout:"fitColumns",
        reactiveData:true,
        data:<?=$polizas?>,
        columns:columnas
    });
</script>