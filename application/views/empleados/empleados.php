<div class="row">
    <div class="col col-md-12 text-right">
        <button class="btn btn-primary" id="btn_nvo_empleado"><i class="fa fa-plus"></i> Nuevo Empleado </button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div id="tabla_empleados"></div>
    </div>
</div>
<script>
    let columnas = [{
            title: "Nombre",
            field: "nombre",
            sorter: "string",
            width: 200,
            headerFilter: "input",
        },
        {
            title: "Apellido",
            field: "apellido",
            sorter: "string",
            width: 200,
            headerFilter: "input"
        },
        {
            title: "Titulo del Trabajo",
            field: "titulo_trabajo_id",
            sorter: "string",
            align: 'center',
            width: 200,
            headerFilter: "input"
        },
        {
            title: "Estado de Empleo",
            field: "estado_empleo_id",
            sorter: "string",
            align: 'center',
            width: 150,
            headerFilter: "input"
        },
        {
            title: "Sub-Unidad",
            field: "sub_unidad_id",
            sorter: "string",
            align: 'center',
            width: 150,
            headerFilter: "input"
        }
    ];

    let icons = function(cell, formatterParams) {
        return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='" + cell.getRow().getData().id + "'><i class='fa fa-eye'></i></div>" +
            "<div class='m-l-10 btn btn-green btn-sm btx_editar' title='Editar' ide='" + cell.getRow().getData().id + "'><i class='fa fa-edit'></i></div>" +
            "<div class='m-l-10 btn btn-danger btn-sm btx_eliminar' title='Eliminar Articulo' ide='" + cell.getRow().getData().id + "'><i class='fa fa-trash'></i></div>";
    };

    columnas.push({
        title: 'Acciones',
        formatter: icons,
        align: 'center'
    });
    var table = new Tabulator("#tabla_empleados", {
        layout: "fitColumns",
        reactiveData: true,
        pagination: "local", //enable local pagination.
        paginationSize: 10,
        data: <?= $empleados ?>,
        columns: columnas
    });
</script>