$(function() {


    const DNI_TRABAJADOR = sessionStorage.getItem('dniTrabajador');

    contenidoEstatico();

    function contenidoEstatico() {

        document.getElementById('header').innerHTML = `
            
            <div class="bordes">
                    <h5>Nombres y Apellidos</h5>
                    <p name="nombresApellidos" id="nombresApellidos"> ${sessionStorage.getItem("nombresApellidosTrabajador")}
                    </p>
                    <h5>DNI</h5>
                    <p name="dni" id="dni"> ${sessionStorage.getItem("dniTrabajador")} </p>
                    <h5>Cargo</h5>
                    <p name="cargo" id="cargo"> ${sessionStorage.getItem("cargoTrabajador")} </p>
                </div>
        
        `;
    }

    // Mostrar todas las capacitaciones

    $.post(RUTA + 'dashboard/listaActasReuniones', { dniTrabajador : DNI_TRABAJADOR}, function(data, textStatus, xhr) {

        var tablaExamenes = "";


        if (data.status == 200) {

            //                    <td> ${estadoExamen(examen.estadoFirma)} </td>


            data.contenido.forEach(function(examen) {
                
                tablaExamenes +=  ` <tr> 
                    <td> ${examen.id} </td>
                    <td> ${examen.motivo} </td>
                    <td>  ${examen.fecha} </td>
                    </tr> `;


            });

            $("#listaExamen").append(tablaExamenes);

        }

        vistaPrevia();

    }, "json");

    function estadoExamen(notaExamen){
        var htmlEstado = `<div class='estadoExamenListo'>Completado</div>`;
        if(notaExamen == 0 ){
            htmlEstado = `<div class='estadoExamenPendiente'>Pendiente</div>`;
        }
        return htmlEstado;
    }


    function vistaPrevia() {


        $("#listaExamen tr").on("click", function (event) {
            event.preventDefault();

            sessionStorage.setItem("idExamen", $(this).find('td').eq(0).text());
            sessionStorage.setItem("nombreExamen", $(this).find('td').eq(1).text());
            sessionStorage.setItem("fechaExamen", $(this).find('td').eq(2).text());
            window.location.href = RUTA + "registro";

        });
    }






})