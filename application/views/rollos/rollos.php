<ul class="nav nav-pills" role="tablist">
    <li class="nav-item"><a class="nav-link btn_rollo_produccion active" data-toggle="pill" href="#nav_pills_default-1">1. En Producción</a></li>
    <li class="nav-item"><a class="nav-link btn_rollo_crudo" data-toggle="pill" href="#nav_pills_default-2">2. Rollos en Crudo</a></li>
    <li class="nav-item"><a class="nav-link btn_rollo_color" data-toggle="pill" href="#nav_pills_default-3">3. Con Proveedor</a></li>
    <li class="nav-item"><a class="nav-link btn_rollo_almacen" data-toggle="pill" href="#nav_pills_default-4">4. En Almacen</a></li>
</ul>
<div class="tab m-t-20" id="nav_pills_default-1">
    <div class="row">
        <div class="col col-md-12 text-right">
            <button class="btn btn-dark" id="btn_nvo_rollo"><i class="fa fa-plus m-r-5"></i> Iniciar Producción</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div id="tabla_rollos"></div>
            <script>
                let columnas = [{
                        field: "id",
                        width: 10
                    },
                    {
                        title: "Maquina",
                        field: "maquina",
                        align: 'center',
                        headerFilter: "input",
                        width: 130
                    },
                    {
                        title: "F.Creacion",
                        field: "fecha_creacion",
                        sorter: "string",
                        width: 150,
                        headerFilter: "input"
                    },
                    {
                        title: "F.Termino",
                        field: "fecha_termino",
                        sorter: "number",
                        align: 'center',
                        width: 150,
                        headerFilter: "input"
                    },
                    {
                        title: "H.Algodon",
                        field: "halgodon",
                        sorter: "string",
                        align: 'center',
                        width: 120,
                        headerFilter: "input"
                    },
                    {
                        title: "H.Licra",
                        field: "hlicra",
                        sorter: "number",
                        align: 'center',
                        width: 91,
                        headerFilter: "input"
                    },
                    {
                        title: "Creador",
                        field: "operador",
                        sorter: "number",
                        align: 'center',
                        width: 150,
                        headerFilter: "input"
                    }
                ];
                let icons = function(cell, formatterParams) {
                    return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='" + cell.getRow().getData().id + "'><i class='fa fa-eye'></i></div> " +
                        "<div class='m-l-10 btn btn-green btn-sm btx_mod' title='Editar' ide='" + cell.getRow().getData().id + "'><i class='fa fa-pencil'></i></div>" +
                        "<div class='m-l-10 btn btn-dark btn-sm btx_fin' title='Finalizar' ide='" + cell.getRow().getData().id + "'><i class='fa fa-check'></i></div>";
                };
                columnas.push({
                    title: 'Acciones',
                    formatter: icons,
                    align: 'center'
                });
                let table = new Tabulator("#tabla_rollos", {
                    layout: "fitColumns",
                    data: <?= $rollos ?>,
                    columns: columnas
                });
                table.setFilter("estatus", "=", "En Producción");

                $('#nav_pills_default-1').hide();
            </script>
        </div>
    </div>
</div>
<div class="tab m-t-20" id="nav_pills_default-2">
    <div id="div_tabla_crudo">
        <div class="row">
            <div class="col col-md-12 text-right">
                <button class="btn btn-dark" id="btn_nvo_entintado"><i class="fa fa-paint-brush m-r-5"></i> Enviar con Proveedor</button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div id="tabla_rollos_crudo"></div>
                <script>
                    let columnas2 = [];
                    let sel = function(cell, formatterParams) {
                        return "<input type='checkbox' class='btx_check_rollo' ide='" + cell.getRow().getData().id + "'>";
                    };
                    columnas2.push({
                        title: 'Selecciona',
                        formatter: sel,
                        align: 'center',
                        width: 120
                    });

                    columnas2.push({
                        title: "#",
                        field: "id",
                        width: 10
                    }, {
                        title: "# Carga",
                        field: "numero_carga",
                        sorter: "string",
                        width: 100,
                        headerFilter: "input"
                    }, {
                        title: "F.Creacion",
                        field: "fecha_creacion",
                        sorter: "string",
                        width: 130,
                        headerFilter: "input"
                    }, {
                        title: "F.Termino",
                        field: "fecha_termino",
                        sorter: "number",
                        align: 'center',
                        width: 130,
                        headerFilter: "input"
                    }, {
                        title: "Creador",
                        field: "operador",
                        sorter: "number",
                        align: 'center',
                        headerFilter: "input",
                        width: 150
                    }, {
                        title: "Estatus",
                        field: "estatus",
                        align: 'center',
                        headerFilter: "input",
                        width: 130
                    });
                    let icons2 = function(cell, formatterParams) {
                        return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='" + cell.getRow().getData().id + "'><i class='fa fa-eye'></i></div> ";
                    };
                    columnas2.push({
                        title: 'Acciones',
                        formatter: icons2,
                        align: 'center',
                        width: 230
                    });
                    let table2 = new Tabulator("#tabla_rollos_crudo", {
                        layout: "fitColumns",
                        data: <?= $rollos ?>,
                        columns: columnas2
                    });
                    table2.setFilter("estatus", "=", "Rollo Crudo");

                    $('#nav_pills_default-2').hide();
                </script>
            </div>
        </div>
    </div>
    <div id="div_tabla_colores" style="display:none">
        <form id="frm_save_envio">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <button class="btn btn-dark" id="btn_corr_color"><i class="fa fa-pencil m-r-5"></i> Editar Selección</button>
                </div>
            </div>
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="row">
                        <div class="col-6 m-t-15 text-center">
                            <div class="bg-grey" style="margin:10px;padding: 10px 20px 15px 20px">
                                <span>Fecha de Envío a Proveedor</span>
                                <input class="form-control text-center" required type="date" name="fec_envio_prov">
                            </div>
                        </div>
                        <div class="col-6 m-t-15 text-center">
                            <div class="bg-grey" style="margin:10px;padding: 10px 20px 15px 20px">
                                <span># de Tonga</span>
                                <input class="form-control text-center" required type="number" name="num_tonga">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <div id="tabla_asig" class="text-center"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-6 offset-md-3 text-right">
                    <button class="btn btn-info" id="btx_envia_pro"><i class="fa fa-save m-r-5"></i> Guardar Envío</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab m-t-20" id="nav_pills_default-3">
    <div id="tabla_rollos_color">
        <div class="row">
            <div class="col col-md-12 text-right">
                <button class="btn btn-dark" id="btn_entrada_almacen"><i class="fa fa-arrow-circle-down m-r-5"></i> Dar entrada en almacen</button>
            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-12">
                <div id="tabla_rollos_prov"></div>
                <script>
                    let columnas3 = [];
                    let color = function(cell, formatterParams) {
                        return '<span style="height: 25px;width: 25px;background-color: ' + cell.getRow().getData().color_hex + ';border-radius: 50%;display: inline-block;"></span> <span class="m-l-10">' + cell.getRow().getData().color + '</span>';
                    };
                    let sel2 = function(cell, formatterParams) {
                        return "<input type='checkbox' class='btx_check_rollo2' vl='" + cell.getRow().getData().num_tonga + "' ide='" + cell.getRow().getData().id + "'>";
                    };
                    columnas3.push({
                        title: 'Selecciona',
                        formatter: sel2,
                        align: 'center',
                        width: 120
                    });
                    columnas3.push({
                        title: "#",
                        field: "id",
                        sorter: "string",
                        width: 55
                    },{
                        title: "# Tonga",
                        field: "num_tonga",
                        sorter: "string",
                        width: 100,
                        headerFilter: "input"
                    }, {
                        title: "F. envío a proveedor",
                        field: "fecha_envio_proveedor",
                        sorter: "number",
                        align: 'center',
                        width: 200,
                        headerFilter: "input"
                    }, {
                        title: "Operador",
                        field: "operador",
                        sorter: "number",
                        align: 'center',
                        headerFilter: "input",
                        width: 250
                    }, {
                        title: "Maquina",
                        field: "maquina",
                        align: 'center',
                        headerFilter: "input",
                        width: 130
                    });
                    let icons3 = function(cell, formatterParams) {
                        return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='" + cell.getRow().getData().id + "'><i class='fa fa-eye'></i></div> ";
                    };
                    columnas3.push({
                        title: 'Acciones',
                        formatter: icons3,
                        align: 'center',
                        width: 230
                    });
                    let table3 = new Tabulator("#tabla_rollos_prov", {
                        layout: "fitColumns",
                        data: <?= $rollos ?>,
                        columns: columnas3
                    });
                    table3.setFilter("estatus", "=", "En Entintado");
                    $('#nav_pills_default-3').hide();
                </script>
            </div>
        </div>
    </div>
    <div id="div_tabla_entrada" style="display:none">
        <form id="frm_save_entrada">
            <div class="row">
                <div class="col col-md-12 text-right">
                    <button class="btn btn-dark" id="btn_corr_entrada"><i class="fa fa-pencil m-r-5"></i> Editar Selección</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 offset-md-3 m-t-10 text-right"><label for="">Fecha de Entrega:</label></div>
                <div class="col-md-3"><input class="form-control" required type="date" name="fec_entrega"></div>
            </div>
            <div class="row m-t-20">
                <div class="col-md-6 offset-md-3">
                    <div id="tabla_asig_entrada"></div>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-6 offset-md-3 text-right">
                    <button class="btn btn-info" id="btx_asig_entrada"><i class="fa fa-save m-r-5"></i> Dar entrada</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab m-t-20" id="nav_pills_default-4">
    <div class="row m-t-20">
        <div class="col-md-12">
            <div id="tabla_rollos_almacen"></div>
            <script>
                let columnas4 = [];
                let color2 = function(cell, formatterParams) {
                    return '<span style="height: 25px;width: 25px;background-color: ' + cell.getRow().getData().color_hex_final + ';border-radius: 50%;display: inline-block;"></span> <span class="m-l-10">' + cell.getRow().getData().color_final + '</span>';
                };
                let sel3 = function(cell, formatterParams) {
                    return "<input type='checkbox' class='btx_check_rollo2' vl='" + cell.getRow().getData().color + "' ide='" + cell.getRow().getData().id + "'>";
                };
                columnas4.push({
                    title: "# de Tonga",
                    field: "num_tonga",
                    align: 'center',
                    width: 125,
                    headerFilter: "input"
                }, {
                    title: "Color",
                    field: "color_fin",
                    formatter: color2,
                    sorter: "string",
                    width: 150,
                    headerFilter: "input"
                }, {
                    title: "Peso(Kg)",
                    field: "peso_entregado",
                    sorter: "number",
                    align: 'center',
                    width: 110,
                    headerFilter: "input"
                }, {
                    title: "F. Entrega",
                    field: "fec_entrega",
                    sorter: "number",
                    align: 'center',
                    width: 120,
                    headerFilter: "input"
                }, {
                    title: "Recibio",
                    field: "receptor",
                    sorter: "number",
                    align: 'center',
                    headerFilter: "input",
                    width: 250
                });
                let icons4 = function(cell, formatterParams) {
                    return "<div class='m-l-10 btn btn-info btn-sm btx_ver' title='Ver' ide='" + cell.getRow().getData().id + "'><i class='fa fa-eye'></i></div> ";
                };
                columnas4.push({
                    title: 'Acciones',
                    formatter: icons4,
                    align: 'center'
                });
                let table4 = new Tabulator("#tabla_rollos_almacen", {
                    layout: "fitColumns",
                    data: <?= $rollos ?>,
                    columns: columnas4
                });
                table4.setFilter("estatus", "=", "En Almacen");
                $('#nav_pills_default-4').hide();
            </script>
        </div>
    </div>
</div>
<script>
    $("#nav_pills_default-1").show();

    $('body').on('click', '.nav-link', function() {
        let href = $(this).attr('href');
        $('.tab').hide();
        $(href).show();
    })
</script>