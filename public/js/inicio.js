$(function() {


    // Mostrar todas las capacitaciones

    $.post(RUTA + 'inicio/listaProyecto', '', function(data, textStatus, xhr) {

        var tablaProyecto =  `<option value="-1">proyecto</option>`;

        if (data.status == 200) {


            data.contenido.forEach(function(proyecto) {

                tablaProyecto += `<option value="`+proyecto.id+`">`+proyecto.nombre+`</option>`;

            });

            $("#codigo").append(tablaProyecto);

        }

    }, "json");



    /*$('#codigo').on('change', function(event) {
        var nombreProyecto='';
        $( "#codigo option:selected" ).each(function() {
            nombreProyecto += $( this ).text() + " ";
          });

        var codigoProyecto = $(this).val();


        event.preventDefault();
        sessionStorage.setItem("codigoProyecto", codigoProyecto);
        sessionStorage.setItem("nombreProyecto",nombreProyecto);
        window.location.href = RUTA + "administrador";
      });*/


      $('.botonIngresar').on('click', function(event) {
        
        event.preventDefault();

        var nombreProyecto ='';
        var nombreAreaEmpresa = '';

        var codigoProyecto = $('#codigo').val();

        $( "#codigo option:selected" ).each(function() {
            nombreProyecto += $( this ).text() + " ";
          });

        var idAreaEmpresa = $('#area_empresa').val();

        $( "#area_empresa option:selected" ).each(function() {
            nombreAreaEmpresa += $( this ).text() + " ";
          });

        console.log(nombreProyecto);
        sessionStorage.setItem("codigoProyecto", codigoProyecto);
        sessionStorage.setItem("nombreProyecto",nombreProyecto);
        sessionStorage.setItem("idAreaEmpresa",idAreaEmpresa);
        sessionStorage.setItem("nombreAreaEmpresa",nombreAreaEmpresa);

        window.location.href = RUTA + "administrador";
      });

})