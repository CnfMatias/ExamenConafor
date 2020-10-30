<script>
    var rollos_a_entintado = [];

    function recorrer_check(){
        let arr = [];
        $(".btx_check_rollo").each(function( index ) {
            let id = $(this).attr('ide');
            if ($(this).is(':checked')){
                arr.push(id)
            };
        });
        return arr;
    }

    function recorrer_check2(){
        let arr = [];
        $(".btx_check_rollo2").each(function( index ) {
            if ($(this).is(':checked')){
                let id = $(this).attr('ide');
                let val = $(this).attr('vl');
                arr.push({'id':id,'num_tonga':val})
            };
        });
        return (arr);
    }

    function dibujar_tabla(arr){
        let tab = '<table class="table table-border text-center"><thead style="background-color:#000;color:white"><tr><td># de Rollo</td></tr></thead><tbody>';
        arr.forEach(element => {
            <?Php if(isset($colores)){?>
            tab += "<tr><td>"+element+"</td></tr>";
            <?Php } ?>
        });
        tab+= '<td style="background-color:#000;color:white">Total de rollos seleccionados: <b style="font-size:20px;margin-left:20px">'+arr.length+'</b></td></tbody></table>';
        return tab;
    }

    function dibujar_tabla2(arr){
        let tab = '<table class="table table-border text-center"><thead style="background-color:#000;color:white"><tr><td>#</td><td># de Tonga</td><td colspan="2">Color Entregado</td><td>Peso Actual</td></tr></thead><tbody>';
        arr.forEach(element => {
            <?Php if(isset($colores)){?>
            tab += "<tr><td>"+element.id+"</td><td>"+element.num_tonga+"</td><td class='back_color' ide='"+element.id+"'></td><td><select ide='"+element.id+"' class='form-control select_color' required><?=$colores;?></select></td><td><input ide='"+element.id+"' type='number' class='form-control text-center' name='peso_entregado' required step='.01'></td></tr>";
            <?Php } ?>
        });
        tab+= '</tbody></table>';
        return tab;
    }

    function recorrer_selects2(){
        let arr2 = [];
        $(".select_color").each(function( index ) {
            let id = $(this).attr('ide');
            let peso = $("input[name=peso_entregado][ide="+id+"]").val();
            let color = $(this).children("option:selected").val();
            arr2.push({'id':id,'color':color,'peso':peso})
        });
        return JSON.stringify(arr2);
    }

    $('body').on('click','#btn_nvo_rollo',function(e){
        e.preventDefault();
        location.href = '<?=base_url()?>rollos/nuevo/';
    })

    $("body").on('click',"#btx_cancelar",function(e){
        e.preventDefault();
        location.href = '<?=base_url()?>rollos';
    })

    $("#frm_nuevo").submit(function(e){
        e.preventDefault();   
        var formData = new FormData(this);
        let url = '<?=base_url()?>rollos/save';
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false,
            cache: false,
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>rollos/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
    })

    $('body').on('click','.btx_ver',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>rollos/ver/'+ide;
    })

    $('body').on('click','.btx_mod',function(){
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>rollos/editar/'+ide;
    })

    $("#frm_editar").submit(function(e){
        e.preventDefault();
        let ide = $('button[type=submit]').attr('ide');
        var formData = new FormData(this);
        let url = '<?=base_url()?>rollos/actualizar/'+ide;
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false,
            cache: false,
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>rollos/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
    })

    $("body").on('click',".btx_fin",function(e){
        e.preventDefault();
        let ide = $(this).attr('ide');
        location.href = '<?=base_url()?>rollos/finalizar/'+ide;
    })

    $("#frm_fin").submit(function(e){
        e.preventDefault();   
        let ide = $('button[type=submit]').attr('ide');
        var formData = new FormData(this);
        let url = '<?=base_url()?>rollos/terminar/'+ide;
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false,
            cache: false,
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>rollos/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
    })

    $('body').on('click','.btx_check_rollo',function(){
        rollos_a_entintado =  recorrer_check();
    })

    $("body").on('click','#btn_nvo_entintado',function(e){
        e.preventDefault();
        $("#div_tabla_crudo").hide();
        $("#div_tabla_colores").show();
        $("#tabla_asig").html(dibujar_tabla(rollos_a_entintado));
    })

    $('body').on('click','#btn_corr_color',function(e){
        e.preventDefault();
        $("#div_tabla_crudo").show();
        $("#div_tabla_colores").hide();
    })

    $('body').on('change','.select_color',function(e){
        e.preventDefault();
        let valor = $(this).attr('ide');
        let color = $(this).children("option:selected").attr('rel');
        $(".back_color[ide="+valor+"]").html('<span style="height: 25px;width: 25px;background-color: '+color+';border-radius: 50%;display: inline-block;"></span>')
    })

    $("body").on('click','#btx_envia_pro',function(e){
        e.preventDefault();
        $("#frm_save_envio").submit();
    })

    $("#frm_save_envio").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        let url = '<?=base_url()?>rollos/save_envio/';
        formData.append('rollos' ,rollos_a_entintado);
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false, //this is requireded please see answers above
            processData: false,
            cache: false,
            success: function (data) {
                console.log(data);
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>rollos/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
        
    })

    $('body').on('click','.btx_check_rollo2',function(){
        rollos_a_entintado =  recorrer_check2();
    })

    $('body').on('change','.btx_check_ent_alm',function(e){
        e.preventDefault();
        let valor = $(this).attr('ide');
        let color = $(this).children("option:selected").attr('rel');
        $(".back_color[ide="+valor+"]").html('<span style="height: 25px;width: 25px;background-color: '+color+';border-radius: 50%;display: inline-block;"></span>')
    })

    $("body").on('click',"#btn_entrada_almacen",function(e){
        e.preventDefault();
        $("#tabla_rollos_color").hide();
        $("#div_tabla_entrada").show();
        $("#tabla_asig_entrada").html(dibujar_tabla2(rollos_a_entintado));
    })

    $('body').on('click','#btn_corr_entrada',function(e){
        e.preventDefault();
        $("#tabla_rollos_color").show();
        $("#div_tabla_entrada").hide();
    })

    $("body").on('click','#btx_asig_entrada',function(e){
        e.preventDefault();
        $("#frm_save_entrada").submit();
    })

    $("#frm_save_entrada").submit(function(e){
        e.preventDefault();
        let colores = recorrer_selects2();
        var formData = new FormData(this);
        let url = '<?=base_url()?>rollos/save_entrada/';
        formData.append('colores' ,colores);
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function (data) {
                if(JSON.parse(data).ban){
                    alert('',JSON.parse(data).msg,'success','<?=base_url()?>rollos/');
                }
                else{
                    alert('',JSON.parse(data).msg,'error');
                }
            }
        });
        
    })

</script>