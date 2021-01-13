$(function(){

    var direccionActual = $('.directionUri').html();
	$('.directionUri').html(seeDirection(direccionActual));
	
	loadDatatables();
	
	gsap.from(".directionUri",{duration: 8, opacity: 0.1, delay: 1});

});

function seeDirection($urls ='/home')
{
    switch($urls)
    {
        case '/factin/home':
            return 'Inicio';
            break;
        case '/factin/access':
            return 'Configuración >> Acceso >> Roles';
			break;
		case '/factin/permission':
			return 'Configuración >> Acceso >> Permisos';
			break;
		case '/factin/users':
			return 'Configuración >> Acceso >> Usuarios';
			break;
		case '/factin/locations':
			return 'Configuración >> Ubicaciones >> Departamentos';
			break;
		case '/factin/municipalities':
			return 'Configuración >> Ubicaciones >> Municipios';
			break;
		case '/factin/corporate-information':
			return 'Configuración >> Empresa >> Información Corporativa';
			break;
		case '/factin/corporate-image':
			return 'Configuración >> Empresa >> Imagen Corporativa';
			break;
		case '/factin/collaborator':
			return 'Administración >> Recursos Humanos >> Colaboradores';
		case '/factin/users-clients':
			return 'Administración >> Recursos Humanos >> Usuarios Clientes';
		case '/factin/product':
			return 'Administración >> Tipos de Productos >> Productos';
		case '/factin/module-product':
			return 'Administración >> Tipos de Productos >> Modulos Productos';
		case '/factin/config-module-product':
			return 'Administración >> Tipos de Productos >> Configuración Modulos Productos';
		case '/factin/services-type':
			return 'Administración >> Tipos de Servicios >> Servicios';
		case '/factin/Factin-Web':
			return 'Comercial >> Portafolio >> Factin Web';
		case '/factin/Software':
			return 'Comercial >> Portafolio >> Software';
		case '/factin/Hardware':
			return 'Comercial >> Portafolio >> Hardware';
		case '/factin/Technical-Support':
			return 'Comercial >> Portafolio >> Soporte Técnico';
    }
}

function loadDatatables(){
	$('#tableDatatable').css('font-size','15px');
	$('#tableDatatable').DataTable({
		language: {
			processing:     "Procesamiento en curso...",
			search: 		"Buscar:",
			lengthMenu:    	"Mostrar _MENU_ registros",
			info:           "Mostrando _START_ a _END_ de _TOTAL_ registros. ",
			infoEmpty:      "Mostrando dato 0 a 0 de 0 registros",	
			emptyTable:     "No hay registros disponibles",
			infoFiltered:   "Filtrado de _MAX_ elementos totales",
			infoPostFix:    "",
			loadingRecords: "Cargando...",
			zeroRecords:    "No hay registros para mostrar",
			infoFiltered:   "Filtrado de _MAX_ registros",
			paginate: {
				first:      "|<",
				previous:   "<",
				next:       ">",
				last:       ">|"
			}
		},
	});
}