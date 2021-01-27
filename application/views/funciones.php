<script>
    function alert(titulo,texto,icono,salida=null){
        Swal.fire({
        icon: icono,
        title: titulo,
        text: texto
        })
        .then(() => {
            if(salida != null)
                location.href = salida
        })
    }

    function alertf(titulo,texto,icono,fn=function(){}){
        Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        onClose: () => {
            fn();
        }
        })
    }

    function confirm(titulo,texto,icono,salida=null){
        return new Promise(function(resolve, reject) {
        Swal.fire({
            icon: icono,
            title: titulo,
            text: texto,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Confirmar'
        })
        .then(function(result){
            if(result.value){
                resolve(true);
            }
        })
        });
    }

    function modal(titulo,codigo){
        Swal.fire({
        width: 750,
        allowOutsideClick: false,
        position: 'top',
        title: titulo,
        html:codigo,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true
        })
    }
    //Api para el funcionamiento de las funciones GET Y POST
    var api = { 
        get: function (url) {
    
            return $.ajax({
                url: url,
                type : 'GET',
                contentType: false,
                processData: false,
                cache: false
            }).done(function(){ swal.close()});
        },
        post: function (url,data,activo=false){
            if(activo){

                return $.ajax({
                    url: url,
                    type : 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false
                }).done(function(){ swal.close()});
            }
            else{
         
                return $.ajax({
                    url: url,
                    type : 'POST',
                    data: data
                }).done(function(){ swal.close()});
            }
        }
    }; 
    

    //inicializa menu
    initApp.buildNavigation($("#js-nav-menu"));
</script>


