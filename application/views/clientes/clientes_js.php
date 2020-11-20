<script>
$(document).ready(function(){

    $("body").on('click',"#btx_cancela_cliente",function(e){
        e.preventDefault();
        location.href = '<?=base_url()?>clientes';
    })
    
    //Botonazo de nuevo cliente
    $("body").on('click','#btn_nvo_cliente',function(){
        location.href = '<?=base_url()?>clientes/nuevo';
    })

    //botonazo de guardar o actualizar cliente
    $("form").submit(function(e){
        e.preventDefault();    
        var formData = new FormData(this);
        let url = '<?=base_url()?>clientes/save';
        if(formData.get('id') !== null){
            url = '<?=base_url()?>clientes/actualizar';
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
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>clientes/');
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
        location.href = '<?=base_url()?>clientes/ver/'+ide;
    })

    //Botonazo de editar cliente
    $('body').on('click','.btx_editar',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>clientes/editar/'+ide;
    })

    //Botonazo de eliminacion de cliente
    $("body").on('click','.btx_eliminar',function(){
        let id = $(this).attr('ide');
        confirm('Eliminar Registro','Desea eliminar el registro?','info')
        .then(function(){
            api.get('<?=base_url()?>clientes/eliminar/'+id)
            .done(function(response){
                if(JSON.parse(response).ban){
                    alert('',JSON.parse(response).msg,'success','<?=base_url()?>clientes')
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
        let valor = (ide[1] == 1)?0:1;
        let datos = {'condicion':{'id':ide[0]},'datos':{'activo':valor}};

        api.post('<?=base_url()?>clientes/activar',datos)
        .done(function(rep){
            alert('',JSON.parse(rep).msg,'success','<?=base_url()?>clientes/');
        })
        .fail(function(res){
            alert('',JSON.parse(res).msg,'error','<?=base_url()?>clientes/');
            console.log(res)
        })
    })

    ////FUNCIONDE CARGA DE IMAGEN
    $('#foto_cliente').change(function(e) {
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
        modal('Foto cliente','<div class="row"><div class="col-md-12"><img style="width:100%" src="'+src+'"></div></div>');
    })

    $("body").on('click','#btn_previo_mapa',function(){
        // limpiar mapa
        $("#map").html('');
        //Geocoding para envio de direccion
        let calle = $('input[name=calle]').val();
        let num_ext = $('input[name=num_ext]').val();
        let mun = $('select[name=municipio_id]').text();
        let est = $('select[name=estado_id]').text();
        $.ajax({
            url: 'http://api.positionstack.com/v1/forward',
            data: {
            access_key: 'de898282bbee9da9fac2d447c4dc88c9',
            query: ''+calle+' '+num_ext+', '+mun+', '+est+', México',
            country: 'MX',
            region: 'Jalisco',
            locality: 'Tala',
            //limit: 1
            }
        }).done(function(data) {
            let latitud = data.data[0].latitude;
            let longitud = data.data[0].longitude;
            console.log(data)
            //funcion paa buscar regios y localidad en los resultados de un array y mostrar las cordenadas encontradas 
            carga_mapa('map',longitud,latitud);
        });        
    })

    function carga_mapa(id,latitud,longitud){
        let coordenadas = '';
        mapboxgl.accessToken =
        "pk.eyJ1IjoiYnVtYXBlIiwiYSI6ImNrMnNuMzlrYTEyZTAzZG13M25rYTVtbDUifQ.NMLhM4WbjCNL0W3PCMTgDA";
        var map = new mapboxgl.Map({
        container: id,
        style: "mapbox://styles/mapbox/streets-v11",
        zoom: 11,
        center: [latitud,longitud]
        });

        let auxiliar = []
        auxiliar.push({
            'type': 'Feature',
            'geometry': {
                'type': 'Point',
                'coordinates': [latitud,longitud]
            }
        })
        
        var geojson = {
            'type': 'FeatureCollection',
            'features': auxiliar
        };

        map.on("load", function() {
            map.addSource('point', {
                'type': 'geojson',
                'data': geojson
            });
            map.addLayer({
                'id': 'point',
                'type': 'circle',
                'source': 'point',
                'paint': {
                    'circle-radius': 7,
                    'circle-color': '#ff1414'
                }
            });
        });
        $('canvas.mapboxgl-canvas').removeAttr('style');
        $('canvas.mapboxgl-canvas').css('height','100%');
        $('canvas.mapboxgl-canvas').css('width','100%');
    }

})
</script>