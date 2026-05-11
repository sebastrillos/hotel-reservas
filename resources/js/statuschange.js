$(document).ready(function() {
    // Inicializar DataTable para example1 si es necesario
    $("#example1").DataTable();

    // Manejar el evento de cambio para cualquier elemento con la clase toggle-class
    $('#example1').on('change', '.toggle-class', function() {
        var isChecked = $(this).prop('checked'); // Verificar si el checkbox está marcado o desmarcado
        var elementType = $(this).data('type'); // Obtener el tipo de elemento (país, departamento, ciudad, etc.)
        var elementId = $(this).attr('data-id'); // Obtener el ID del elemento
        var url; // Determinar la URL y los datos según el tipo de elemento

        // Configurar la URL y los datos según el tipo de elemento
        switch (elementType) {
            case 'pais':
                url = 'cambioestadopais';
                break;
            case 'departamento':
                url = 'cambioestadodepartamento';
                break;
            case 'ciudad':
                url = 'cambioestadociudad';
                break;
			case 'tipodocumento':
                url = 'cambioestadotipodocumento';
                break;
            case 'user':
                url = 'cambioestadouser';
                break;
			case 'estrategia':
                url = 'cambioestadoestrategia';
                break;
			case 'eje':
                url = 'cambioestadoeje';
                break;
			case 'poblacionimpactada':
                url = 'cambioestadopoblacionimpactada';
                break;
			case 'tipoactividad':
                url = 'cambioestadotipoactividad';
                break;
			case 'claseactividad':
                url = 'cambioestadoclaseactividad';
                break;
			case 'tipoparticipante':
                url = 'cambioestadotipoparticipante';
                break;
			case 'actividad':
                url = 'cambioestadoactividad';
                break;
			case 'persona':
                url = 'cambioestadopersona';
                break;
			case 'personaexterna':
                url = 'cambioestadopersonaexterna';
                break;
			case 'areaextension':
                url = 'cambioestadoareaextension';
                break;
			case 'areatrabajo':
                url = 'cambioestadoareatrabajo';
                break;
			case 'ciclovital':
                url = 'cambioestadociclovital';
                break;
			case 'entidadnacional':
                url = 'cambioestadoentidadnacional';
                break;
			case 'fuentenacional':
                url = 'cambioestadofuentenacional';
                break;
			case 'poblacioncondicion':
                url = 'cambioestadopoblacioncondicion';
                break;
			case 'poblaciongrupo':
                url = 'cambioestadopoblaciongrupo';
                break;
			case 'servicio':
                url = 'cambioestadoservicio';
                break;
			case 'universidad':
                url = 'cambioestadouniversidad';
                break;
			case 'programaacademico':
                url = 'cambioestadoprogramaacademico';
                break;
			case 'convenio':
                url = 'cambioestadoconvenio';
                break;
			case 'tipomovilidad':
                url = 'cambioestadotipomovilidad';
                break;
			case 'personaentrantemovilidad':
                url = 'cambioestadopersonaentrantemovilidad';
                break;
			case 'movilidad':
                url = 'cambioestadomovilidad';
                break;
			case 'tipoformacionposgrado':
                url = 'cambioestadotipoformacionposgrado';
                break;
			case 'tipoformacioncomplementaria':
                url = 'cambioestadotipoformacioncomplementaria';
                break;
			case 'estadogrado':
                url = 'cambioestadoestadogrado';
                break;
			case 'formacioncomplementaria':
                url = 'cambioestadoformacioncomplementaria';
                break;
			case 'formacionposgrado':
                url = 'cambioestadoformacionposgrado';
                break;
			case 'tipocontrato':
                url = 'cambioestadotipocontrato';
                break;
			case 'areaprofesional':
                url = 'cambioestadoareaprofesional';
                break;
			case 'empresa':
                url = 'cambioestadoempresa';
                break;
            default:
                return; // Salir de la función si el tipo de elemento no es válido
        }

        // Realizar la solicitud AJAX con la URL y los datos configurados
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            data: {
                'estado': isChecked ? 1 : 0, // Estado (1 para marcado, 0 para desmarcado)
                'id': elementId // ID del elemento
            },
            success: function(data) {
                console.log(`Se ha cambiado el estado del ${elementType} correctamente.`);
                // Realizar acciones adicionales después del éxito de la solicitud AJAX
				console.log('Respuesta del servidor:', data);
            },
            error: function(xhr, status, error) {
                console.error(`Error al cambiar el estado del ${elementType}: ${error}`);
                // Manejar errores de la solicitud AJAX si es necesario
            }
        });
    });
});

