$(document).ready(function(){


    $('#select-proceso').on('change', onChangeProceso);

    function onChangeProceso(){
        let proceso_id = $(this).val();

        if(!proceso_id){
            $("#select-proceso").html('<option value="" >Selecciona un proceso</option>');
            return;
        }

        $.get('/api/procesos/'+proceso_id+'/procesospersonales', (data)=>{
            let html_select = "" 

            for(let i=0; i<data.length; i++){
                html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
            }

            if(html_select == ""){
                $('#select-subProceso').prop('disabled', 'disabled');
                html_select = '<option>No tienes ningun sub proceso registrado</option>';

            }else{
                $('#select-subProceso').prop('disabled', false);
            }

            $('#select-subProceso').html(html_select);



        });

    }

});