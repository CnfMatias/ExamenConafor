<div class="row">
    <div class="col col-md-12 text-right">
        <button class="btn btn-primary" id="btn_nvo_cliente" ><i class="fa fa-plus"></i> Nuevo Cliente</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div id="tabla_clientes"></div>
    </div>
</div>
<script>
    let columnas = [
        {title:"Nombre", field:"nombre", sorter:"string",width:200,headerFilter:"input"},
        {title:"Calle", field:"calle", sorter:"string", align:'center',width:150,headerFilter:"input"},
        {title:"Correo", field:"email", sorter:"string",align:'center',width:120, headerFilter:"input"},
        {title:"Telefono", field:"tel", sorter:"string",align:'center',width:120, headerFilter:"input"},
        {title:"Celular", field:"cel", sorter:"string",align:'center',width:120, headerFilter:"input"}
    ];

    let icons = function(cell, formatterParams){
        let color = (cell.getRow().getData().activo == 1)? 'btn-sky':'btn-secondary';
        return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='"+cell.getRow().getData().id+"'><i class='fa fa-eye'></i></div>" +
        "<div class='m-l-10 btn "+color+" btn-sm btx_activar' title='Activar' ide='"+cell.getRow().getData().id+"-"+cell.getRow().getData().activo+"'><i class='fa fa-power-off'></i></div>" + 
        "<div class='m-l-10 btn btn-green btn-sm btx_editar' title='Editar' ide='"+cell.getRow().getData().id+"'><i class='fa fa-edit'></i></div>" +
        "<div class='m-l-10 btn btn-danger btn-sm btx_eliminar' title='Eliminar Articulo' ide='"+cell.getRow().getData().id+"'><i class='fa fa-trash'></i></div>";
    };

    /* columnas.push({title:'Acciones', formatter:icons,align:'center',width:250});
    var table = new Tabulator("#tabla_clientes", {
        layout:"fitData",
        pagination:"local", //enable local pagination.
        paginationSize:10,
        data:<?=$clientes?>,
        columns:columnas
    }); */

    columnas.push({title:'Acciones', formatter:icons,align:'center'});
    var table = new Tabulator("#tabla_clientes", {
        layout:"fitColumns",
        reactiveData:true,
        pagination:"local", //enable local pagination.
        paginationSize:10,
        data:<?=$clientes?>,
        columns:columnas
    }); 
</script>