<div class="row">
    <div class="col col-md-12 text-right">
        <button class="btn btn-primary" id="btn_nvo_usuario" ><i class="fa fa-plus"></i> Nuevo Usuario</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div id="tabla_usuarios"></div>
    </div>
</div>
<br>

<script>
    let columnas = [
        {title:"Usuario", field:"usuario", width:120, headerFilter:"input"},
        {title:"Rol", field:"rol", width:180, headerFilter:"input"},
        {title:"Nombre", field:"nombre", width:180,headerFilter:"input"},
        {title:"Email", field:"email",width:160, headerFilter:"input"},
        {title:"Estatus", field:"estatus",width:100, headerFilter:"input", align:'center'},
    ];

    let icons = function(cell, formatterParams){
        let color = (cell.getRow().getData().estatus_general == 1)? 'btn-sky':'btn-secondary';
        return "<div class='m-l-10 btn btn-warning btn-sm btx_pass' title='Cambio de Contraseña' ide='"+cell.getRow().getData().id+"-"+cell.getRow().getData().usuario+"'><i class='fa fa-key'></i></div>" +
        "<div class='m-l-10 btn "+color+" btn-sm btx_activar' title='Activar' ide='"+cell.getRow().getData().id+"-"+cell.getRow().getData().estatus_general+"'><i class='fa fa-power-off'></i></div>" + 
        "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='"+cell.getRow().getData().id+"'><i class='fa fa-eye'></i></div>" +
        "<div class='m-l-10 btn btn-danger btn-sm btx_eliminar' title='Eliminar Articulo' ide='"+cell.getRow().getData().id+"'><i class='fa fa-trash'></i></div>";
    };

    columnas.push({title:'Acciones', formatter:icons,align:'center'});
    var table = new Tabulator("#tabla_usuarios", {
        layout:"fitColumns",
        reactiveData:true,
        data:<?=$usuarios?>,
        columns:columnas
    });
</script>