<script>
$(document).ready(function() {

    //botonazo de cancelar
    $("body").on('click',"#btx_cancela_usuario",function(e){
        e.preventDefault();
        location.href = '<?=base_url()?>usuarios';
    })

    //Botonazo de nuevo empleado
    $("body").on('click','#btn_nvo_usuario',function(){
        location.href = '<?=base_url()?>usuarios/nuevo';
    })

    //Boton para mostrar tabla de empleados
    $("body").on('click','#btx_asignar_empleado',function(e){
        e.preventDefault();
        $("#div_empleados_grid").toggle();
        $("#div_empleado").hide();
        let columnas = [
            {title:"Nombre", field:"nombre", sorter:"string",width:200,headerFilter:"input"},
            {title:"Puesto", field:"puesto", sorter:"number", align:'center',width:150,headerFilter:"input"},
            {title:"Email", field:"email", sorter:"number",align:'center',width:120,headerFilter:"input"},
            {title:"Telefono", field:"telefono", sorter:"number",align:'center',width:120,headerFilter:"input"},
            {title:"Celular", field:"celular", sorter:"number",align:'center',width:120,headerFilter:"input"}
        ];
        let icons = function(cell, formatterParams){
            let color = (cell.getRow().getData().activo == 1)? 'btn-success':'btn-secondary';
            return "<input name='asignar' type='button' value='Asignar' class='btn btn-sm btn-success' ide='"+cell.getRow().getData().id+"'>";
        };
        columnas.push({title:'Asignar', formatter:icons,align:'center',width:'50px'});
        var table = new Tabulator("#tabla_empleados", {
            layout:"fitColumns",
            movableRows: true,
            reactiveData:true,
            data:<?=$empleados?>,
            columns:columnas
        });
    })

    //botonazo para signar un empleado al usuario
    $("body").on('click','input[name=asignar]',function(e){
        e.preventDefault();
        let ide = $(this).attr('ide');
        $.ajax({
            type: "POST",
            data: {'condicion':'id='+ide},
            url: '<?=base_url()?>usuarios/buscar_empleado/'+ide,
            success: function(res){
                let valores = JSON.parse(res).empleado;
                $('input').each(function(){
                    $(this).val(valores[$(this).attr('name')])
                })
                $('select').each(function(){
                    $(this).val(valores[$(this).attr('name')])
                })
                $('textarea').each(function(){
                    $(this).val(valores[$(this).attr('name')])
                })
                if(valores['foto_emp'] != ''){
                    $('img[name=foto_emp]').attr('src','<?=base_url()?>frontend/emps/'+valores['foto_emp'])
                }
                let email = $('input[name=email]').val();
                if(email != ''){
                    $('input[name=usuario]').val(email.split('@')[0])
                    alert('','Empleado Asignado, se agrego sugerencia para usuario, similar a su email','success');
                }
                else
                    alert('','Empleado Asignado','success');
                $("#div_empleados_grid").toggle();
                $("#div_empleado").toggle();
            }
        });
    })

    //funcion para validar contraseñas iguales
    function validacion_password(){
        let p1 = $('input[name=password]').val();
        let p2 = $('input[name=pass_conf]').val();
        if(p1 != '' && p2 != ''){
            if(p1 != p2){
                alert('','Tus contraseñas no coincide!','error')
                $('input[name=password]').val('');
                $('input[name=pass_conf]').val('');
            }
            else{
                $('#btx_cambiar_pass').toggle();
            }
                
        }
    }
    //evento de cambio de contraseña 1
    $('body').on('change','input[name=password]',function(e){
        e.preventDefault();
        validacion_password();
    })
    //evento de cambio de contraseña 2
    $('body').on('change','input[name=pass_conf]',function(e){
        e.preventDefault();
        validacion_password();
    })

    //botonazo de guardar o actualizar empleado
    $("#frm_usr").submit(function(e){
        e.preventDefault();    
        var formData = new FormData(this);
        let num_emp = $('input[name=id]').val();
        let url = '<?=base_url()?>usuarios/save/'+num_emp;
        if(formData.get('id') !== null){
            url = '<?=base_url()?>usuarios/actualizar';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false,
            cache: false,
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>usuarios/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert('','No se pudo crear el usuario','error'); 
            }  
        });
    })

    //botonazo de actulizacion de la contraseña
    $("body").on('click','.btx_pass',function(){      
        let ide = $(this).attr('ide')
        let usuario = ide.split('-')[1]
        modal('Cambiar Contraseñas','<div class="row text-left"><div class="col-md-12"><label for="">Usuario:</label><input class="form-control" type="text" name="usuario" readonly value="'+usuario+'"></div><br><div class="col-md-12 m-t-10"><label for="">Contraseña:</label><input class="form-control" type="password" name="password"></div><br><div class="col-md-12 m-t-10"><label for="">Confirmar Contraseña:</label><input class="form-control" type="password" name="pass_conf"></div><div class="col-md-12 text-right m-t-20"><button class="btn btn-success"><i class="fa fa-check"></i> Validar</button><button id="btx_cancela_usuario" class="btn btn-danger waves-effect waves-themed m-l-5"><i class="fa fa-ban m-r-5"></i> Cancelar</button><button style="display:none;" id="btx_cambiar_pass" class="btn btn-primary waves-effect waves-themed m-l-5"><i class="fa fa-save m-r-5"></i> Actualizar</button></div></div>');
    })

    //Botonazo cambio de contraseña
    $("body").on('click','#btx_cambiar_pass',function(){
        let usuario = $('input[name=usuario]').val();
        let pass = $('input[name=password]').val();
        $.ajax({
            type: "POST",
            url: '<?=base_url()?>usuarios/actualizar',
            data: {'usuario':usuario,'password':pass},
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>usuarios/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert('','No se pudo crear el usuario','error'); 
            }  
        });
    })

    //botonazo de actulizacion de una o varias actualizaciones
    $("body").on('click','.btx_activar',function(){        
        let ide = $(this).attr('ide').split('-');
        let valor = (ide[1] == 1)?2:1;
        let datos = {'condicion':{'id':ide[0]},'datos':{'estatus_general':valor}};

        api.post('<?=base_url()?>usuarios/activar',datos)
        .done(function(rep){
            alert('',JSON.parse(rep).msg,'success','<?=base_url()?>usuarios/');
        })
        .fail(function(res){
            alert('',JSON.parse(res).msg,'error','<?=base_url()?>usuarios/');
            console.log(res)
        })
    })

    //Botonazo de editar empleado
    $('body').on('click','.btx_ver',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>usuarios/ver/'+ide;
    })

    //Botonazo de eliminacion de empleado
    $("body").on('click','.btx_eliminar',function(){
        let id = $(this).attr('ide');
        confirm('Eliminar Registro','Desea eliminar el registro?','info')
        .then(function(){
            api.get('<?=base_url()?>usuarios/eliminar/'+id)
            .done(function(response){
                if(JSON.parse(response).ban){
                    alert('',JSON.parse(response).msg,'success','<?=base_url()?>usuarios')
                }
            })
            .fail(function(xhr, textStatus, error){
              console.error(xhr.statusText);
            });
        })
    })

});
</script>
