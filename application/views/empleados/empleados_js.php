<script>
$(document).ready(function(){

    $("body").on('click',"#btx_cancela_empleado",function(e){
        e.preventDefault();
        location.href = '<?=base_url()?>empleados';
    })
    
    //Botonazo de nuevo empleado
    $("body").on('click','#btn_nvo_empleado',function(){
        location.href = '<?=base_url()?>empleados/nuevo';
    })

    //botonazo de guardar o actualizar empleado
    $("form").submit(function(e){
        e.preventDefault();    
        var formData = new FormData(this);
        let url = '<?=base_url()?>empleados/save';
        if(formData.get('id') !== null){
            url = '<?=base_url()?>empleados/actualizar';
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
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>empleados/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
    })

    //Botonazo de ver enpleado
    $('body').on('click','.btx_ver',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>empleados/ver/'+ide;
    })

    //Botonazo de editar empleado
    $('body').on('click','.btx_editar',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>empleados/editar/'+ide;
    })

    //Botonazo de eliminacion de empleado
    $("body").on('click','.btx_eliminar',function(){
        let id = $(this).attr('ide');
        confirm('Eliminar Registro','Desea eliminar el registro?','info')
        .then(function(){
            api.get('<?=base_url()?>empleados/eliminar/'+id)
            .done(function(response){
                if(JSON.parse(response).ban){
                    alert('',JSON.parse(response).msg,'success','<?=base_url()?>empleados')
                }
            })
            .fail(function(xhr, textStatus, error){
              console.error(xhr.statusText);
            });
        })
    })

    //botonazo de actulizacion de una o varias actualizaciones
    $("body").on('click','.btx_activar',function(){        
        let ide = $(this).attr('ide').split('-');
        let valor = (ide[1] == 3)?2:3;
        let datos = {'condicion':{'id':ide[0]},'datos':{'estatus_general_id':valor}};

        api.post('<?=base_url()?>empleados/activar',datos)
        .done(function(rep){
            alert('',JSON.parse(rep).msg,'success','<?=base_url()?>empleados/');
        })
        .fail(function(res){
            alert('',JSON.parse(res).msg,'error','<?=base_url()?>empleados/');
            console.log(res)
        })
    })

    ////FUNCIONDE CARGA DE IMAGEN
    $('#foto_empleado').change(function(e) {
        addImage(e);
    });

    function addImage(e){
      var file = e.target.files[0],
      imageType = /image.*/;
    
      if (!file.type.match(imageType))
       return;
  
      var reader = new FileReader();
  
      reader.onload = function(e){
         var result=e.target.result;
        $('#imgSalida').attr("src",result);
      }
       
      reader.readAsDataURL(file);
    }

    $('body').on('click','img[name=foto_emp]',function(){
        let src = $(this).attr('src');
        modal('Foto Empleado','<div class="row"><div class="col-md-12"><img style="width:100%" src="'+src+'"></div></div>');
    })

})
</script>