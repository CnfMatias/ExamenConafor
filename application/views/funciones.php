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
            // else{
            //     reject(false);
            // }
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

    var api = { 
        get: function (url) {
            return $.ajax({
                url: url,
                type : 'GET',
            });
        },
        post: function (url,data){
            return $.ajax({
                url: url,
                type : 'POST',
                data: data
            });
        }
    }; 
    

    //inicializa menu
    initApp.buildNavigation($("#js-nav-menu"));
</script>
