<div class="accordion accordion-hover" id="js_demo_accordion-5">
    <div class="card">
        <div class="card-header">
            <a href="javascript:void(0);" class="card-title" data-toggle="collapse" data-target="#js_demo_accordion-5a" aria-expanded="false">
                <i class="fal fa-bullseye width-2 fs-xl"></i>
                Catálogos
                <span class="ml-auto">
                    <span class="collapsed-reveal">
                        <i class="fal fa-chevron-up fs-xl"></i>
                    </span>
                    <span class="collapsed-hidden">
                        <i class="fal fa-chevron-down fs-xl"></i>
                    </span>
                </span>
            </a>
        </div>
        <div id="js_demo_accordion-5a" class="collapse show" data-parent="#js_demo_accordion-5">
            <div class="card-body">
                <div id="div_catalogos">
                    <div class="row">
                        <div class="col col-md-4 offset-md-2">
                            <button tab="vw_perfiles" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de Perfiles</button>
                        </div>
                        <div class="col col-md-4">
                            <button tab="vw_equipos" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de Equipos</button>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col col-md-4 offset-md-2">
                            <button tab="vw_marca" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de Marcas</button>
                        </div>
                        <div class="col col-md-4">
                            <button tab="vw_publicidad" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de publicidad</button>
                        </div>
                    </div>
                    <div class="row m-t-20">
                        <div class="col col-md-4 offset-md-2">
                            <button tab="vw_sueldos" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de Sueldos</button>
                        </div>
                        <div class="col col-md-4">
                            <button tab="vw_horarios" class="btn btn-lg btn-block btn-secondary alto-80 btx_catalogo"> Catálogo de Horarios</button>
                        </div>
                    </div>
                    
                </div>
                <div class="row m-t-30" id="div_tabla" style="display:none;">
                    <div class="col-md-8 offset-md-2">
                        <div class="col-md-12 text-center">
                            <h3 id="titulo"></h3>
                        </div>
                        <div class="col-md-12 m-t-20">
                            <form id="frm_save" method="post" action="">
                                <div id="tabla_elementos"></div>
                            </form>
                        </div>
                        <div class="col-md-12 m-t-20 text-right">
                            <button onclick="location.reload();" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</button>
                            <button class="btn btn-success btx_nuevo"><i class="fa fa-save m-r-5"></i> Nuevo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var table = null;
    var ban_edit = true;
    var texto = null;
    var url = null;
    var row = null;
    var tb_php = null;

    function carga_tabla(texto, tabla, url) {
        $.ajax({
            type: "GET",
            url: url,
            cache: false,
            success: function(data) {
                if (JSON.parse(data).ban) {
                    $("#div_catalogos").hide();
                    $("#div_tabla").fadeIn(500);
                    $("#titulo").html(texto);
                    // let columnas = [
                    // {title:"Opciones", field:"nombre", sorter:"string",align:'center'},
                    // ];
                    let contador = 0;
                    let icons = function(cell, formatterParams) {
                        contador += 1;
                        return "<div row='" + contador + "' class='m-l-10 btn btn-info btn-sm btx_editar' title='Editar' ide='" + cell.getRow().getData().id + "'><i class='fa fa-edit'></i></div><div row='" + contador + "' class='m-l-10 btn btn-success btn-sm btx_save' title='Guardar' style='display:none' ide='" + cell.getRow().getData().id + "'><i class='fa fa-save'></i></div><div class='m-l-10 btn btn-danger btn-sm btx_eliminar' title='Eliminar' ide='" + cell.getRow().getData().id + "'><i class='fa fa-trash'></i></div>";
                    };
                    switch (tabla) {
                        case 'vw_colores':
                            let color = function(cell, formatterParams) {
                                return "<input type='button' val='" + cell.getRow().getData().color_hex + "' style='background-color: " + cell.getRow().getData().color_hex + "'>";
                            };
                            let columnas = [];
                            columnas.push({
                                title: "id",
                                field: "id",
                                width: 10
                            }, {
                                title: "Nombre",
                                field: "nombre"
                            }, {
                                title: "Color",
                                formatter: color,
                                field: "color_hex",
                                width: 80,
                                align: 'center'
                            }, {
                                title: "Estatus",
                                field: "estatus"
                            });
                            table = new Tabulator("#tabla_elementos", {
                                layout: "fitColumns",
                                data: JSON.parse(data).data,
                                columns: columnas
                            });
                            break;
                        default:
                            table = new Tabulator("#tabla_elementos", {
                                layout: "fitColumns",
                                data: JSON.parse(data).data,
                                autoColumns: true
                            });
                            break;
                    }
                    table.addColumn({
                        title: 'Editar',
                        formatter: icons,
                        width: 150
                    }, false, "acciones");
                    $('.tabulator-table > div').each(function(index) {
                        $(this).attr('ide', index + 1)
                    })
                } else
                    alert('', JSON.parse(data).msg, 'error');
            }
        });
    }

    $('body').on('click', '.btx_catalogo', function() {
        texto = $(this).html();
        tabla = $(this).attr('tab');
        url = '<?= base_url() ?>configuraciones/get_cat/' + tabla;
        carga_tabla(texto, tabla, url);
    })

    $('body').on('click', '.btx_editar', function() {
        if (ban_edit) {
            ban_edit = false;
            $(this).hide();
            row = $(this).attr('row');
            $('.btx_save[row=' + row + ']').show();
            $('.tabulator-row[ide=' + row + ']').find('.tabulator-cell').each(function() {
                if ($(this).attr('tabulator-field') !== undefined) {
                    let nombre = $(this).attr('tabulator-field');
                    let valor = $(this).text();
                    //solo para el catalogo de colores
                    let color = $(this).find('input[type=button]').attr('val');
                    if (nombre == 'id')
                        $(this).html('<input style="border:none;background-color:transparent;" readonly type="text class="form-control" name="' + nombre + '" dom="temporal" value="' + valor + '">')
                    else
                    if (nombre == 'color_hex')
                        $(this).html('<input type="color" class="form-control" name="' + nombre + '" dom="temporal" value="' + color + '">')
                    else
                        $(this).html('<input type="text" class="form-control" name="' + nombre + '" dom="temporal" value="' + valor + '">')
                }
            })
        }
    })

    $('body').on('click', '.btx_save', function(e) {
        $('#frm_save').submit();
    })

    $('#frm_save').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: '<?= base_url() ?>configuraciones/save_catalogos/' + tabla,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(data) {
                if (JSON.parse(data).ban) {
                    alert('', JSON.parse(data).msg, 'success');
                    $('.tabulator-row[ide=' + row + ']').attr('style', 'background-color: #38A0E3;');
                    carga_tabla(texto, tabla, url)
                    //$('#frm_save').submit();
                    ban_edit = true;
                } else {
                    alert('', JSON.parse(data).msg, 'error');
                }
            }
        });
    })

    $('body').on('click', '.btx_eliminar', function() {
        let id = $(this).attr('ide');
        confirm('Eliminar Registro', 'Desea eliminar el registro?', 'info')
            .then(function() {
                api.post('<?= base_url() ?>configuraciones/eliminar', {
                        'id': id,
                        'tabla': tabla
                    })
                    .done(function(response) {
                        if (JSON.parse(response).ban) {
                            alert('', JSON.parse(response).msg, 'success');
                            carga_tabla(texto, tabla, url);
                        }
                    })
                    .fail(function(xhr, textStatus, error) {
                        console.error(xhr.statusText);
                    });
            })
    })

    //Modal para formulario del nuevo registro 

    $('body').on('click', '.btx_nuevo', function() {
        let cabecera = '<form id="frm_modal" method="post">';
        let botones = '<div class="row m-t-20 text-right"><div class="col-md-12"><button class="btn btn-danger btx_cancelar_m"><i class="fa fa-reply"></i> Cancelar</button><button class="btn btn-primary btx_save_m m-l-5"><i class="fa fa-save"></i> Guardar</button></div></div></form>';
        let html = '';
        let titulo = '';

        switch (tabla) {
            case 'vw_perfiles':
                tb_php = 'c_perfiles';
                titulo = 'Nuevo Perfil';
                html = '<div class="row text-left"><div class="col-md-12"><label for="">Nombre del Perfil:</label><input required class="form-control" name="nombre" type="text"></div></div>';
                break;
            case 'vw_equipos':
                tb_php = 'c_equipos';
                titulo = 'Tipo de Equipo';
                html = '<div class="row text-left"><div class="col-md-12"><label for="">Nombre del Equipo:</label><input required class="form-control" name="nombre" type="text"></div></div>';
                break;
            case 'vw_marca':
                tb_php = 'c_marca';
                titulo = 'Tipo de Marca';
                html = '<div class="row text-left"><div class="col-md-12"><label for="">Nombre de la Marca:</label><input required class="form-control" name="nombre" type="text"></div></div>';
                break;
            case 'vw_publicidad':
                tb_php = 'c_publicidad';
                titulo = 'Tipo de Publicidad';
                html = '<div class="row text-left"><div class="col-md-12"><label for="">Publicidad:</label><input required class="form-control" name="nombre" type="text"></div></div>';
                break;
            case 'vw_sueldos':
                tb_php = 'c_sueldos';
                titulo = 'Tipo de Sueldo';
                html = '<div class="row text-left"><div class="col-md-12"><label for="">Sueldos:</label><input required class="form-control" name="nombre" type="text"></div></div>';
            break;
            case 'vw_horarios':
                tb_php = 'c_horarios';
                titulo = 'Tipo de Horario';
                html = '<div class="row"> <div class="col-md-8 offset-md-2"> <div class="row"> <div class="col-md-12 text-left"> <label> Nombre: </label> <input type="text" class="form-control" name="nombre" maxlength="200"> </div></div><div class="row m-t-20"> <div class="col-md-6"> <label> Día de inicio: </label> <select class="form-control" name="dia_inicio"> <option value="">Selecciona</option> <option value="0">Domingo</option> <option value="1">lunes</option> <option value="2">Martes</option> <option value="3">Miercoles</option> <option value="4">Jueves</option> <option value="5">Viernes</option> <option value="6">Sabado</option> </select> </div><div class="col-md-6"> <label> Día de Final: </label> <select class="form-control" name="dia_final"> <option value="">Selecciona</option> <option value="0">Domingo</option> <option value="1">lunes</option> <option value="2">Martes</option> <option value="3">Miercoles</option> <option value="4">Jueves</option> <option value="5">Viernes</option> <option value="6">Sabado</option> </select> </div></div><div class="row m-t-20"> <div class="col-md-6"> <label>Hora inicio</label> <input type="time" class="form-control" name="hora_inicio"> </div><div class="col-md-6"> <label>Hora Final</label> <input type="time" class="form-control" name="hora_final"> </div></div></div></div>';
                break;
        }
        modal(titulo, cabecera + html + botones);
    })

    $('body').on('click', '.btx_cancelar_m', function() {
        Swal.close();
    })

    $('body').on('click', '.btx_save_m', function(e) {
        e.preventDefault();
        let elem = document.getElementById('frm_modal');
        if (elem.reportValidity()) {
            var formData = new FormData(elem);
            let uri = '<?= base_url() ?>configuraciones/nuevo_catalogo';
            formData.append('tabla', tb_php);
            $.ajax({
                type: "POST",
                url: uri,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    //console.log(data)
                    if (JSON.parse(data).ban) {
                        alertf('', JSON.parse(data).msg, 'success', function() {
                            carga_tabla(texto, tabla, url);
                        });
                    } else {
                        alert('', JSON.parse(data).msg, 'error');
                    }
                }
            });
        }
        return false;

    })
</script>

