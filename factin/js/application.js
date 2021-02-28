$(function(){

	$('#priceMoney').maskMoney();
	$('#priceMoney_Edit').maskMoney();
	$('input[name=CoPrice]').maskMoney();
	$('input[name=CoSub]').maskMoney();
	$('input[name=CoVIva]').maskMoney();
	$('input[name=CoTotal]').maskMoney();
	$('input[name=ClValue]').maskMoney();
    $('input[name=ClQuotaValue]').maskMoney();
	$('input[name=ClValue_Edit]').maskMoney();
    $('input[name=ClQuotaValue_Edit]').maskMoney();
	$('input[name=CoNumero]').mask('000000000000000');
	$('input[name=CoWhat]').mask('0000000000');
	$('input[name=CoTel]').mask('0000000000');
	$('input[name=CoCan]').mask('0000');
	$('input[name=CoIva]').mask('0000');
	$('input[name=ClQuota]').mask('00');
	
    var direccionActual = $('.directionUri').html();
	$('.directionUri').html(seeDirection(direccionActual));
	
	loadDatatables();
	
	var meses = [
		"Enero", "Febrero", "Marzo",
		"Abril", "Mayo", "Junio", "Julio",
		"Agosto", "Septiembre", "Octubre",
		"Noviembre", "Diciembre"
	];

	var date = new Date();
	var dia = date.getDate();
	var mes = date.getMonth();
	var yyy = date.getFullYear();
	var MyDate = dia + ' de ' + meses[mes] + ' de ' + yyy;

	
	$('.NowDate').append(MyDate);
	
	gsap.from(".directionUri",{duration: 10, opacity: 0.1});
	gsap.to(".directionUri",{duration: 10, color:'#0676a4', delay: 6});
	gsap.to(".NowDate",{duration: 7,color:'#0676a4',delay:3});
	
	$('.datepicker').datepicker({
		dateFormat: 'DD, dd-MM-yy',
		showAnim: "blind"
	});

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
		case '/factin/Business-Opportunity':
			return 'Comercial >> Plan de Mercadeo >> Oportunidad de Negocio';
		case '/factin/Business-Tracking':
			return 'Comercial >> Plan de Mercadeo >> Seguimiento de Negocio';
		case '/factin/Business-Archive':
			return 'Comercial >> Plan de Mercadeo >> Archivo de Negocios';
		case '/factin/Success-Indicators':
			return 'Comercial >> Plan de Mercadeo >> Indicadores de Exito';
		case '/factin/Commercial-Proposal':
			return 'Comercial >> Clientes Potenciales >> Propuesta Comercial';
		case '/factin/Commercial-Monitoring':
			return 'Comercial >> Clientes Potenciales >> Seguimiento Comercial';
		case '/factin/Commercial-File':
			return 'Comercial >> Clientes Potenciales >> Archivo Comercial';
		case '/factin/Commercial-Indicator':
			return 'Comercial >> Clientes Potenciales >> Indicadores de Exito';
		case '/factin/Agreement-ClientLegalization':
			return 'Comercial >> Contratación >> Legalización Cliente';
		case '/factin/Agreement-ContractLegalization':
			return 'Comercial >> Contratación >> Legalización Contrato';
		case '/factin/Agreement-ContractsFile':
			return 'Comercial >> Contratación >> Archivo Contrataciones';
		case '/factin/Agreement-SuccessIndicator':
			return 'Comercial >> Contratación >> Indicadores de Exito';
		case '/factin/Request':
			return 'Soporte >> Solicitudes';
		case '/factin/Programming':
			return 'Soporte >> Programación';
		case '/factin/Tracing':
			return 'Soporte >> Seguimiento';
		case '/factin/Qualification':
			return 'Soporte >> Calificación';
		case '/factin/Archive':
			return 'Soporte >> Archivo';
    }
}

function loadDatatables(){
	$('#tableDatatable').css('font-size','15px');
	$('#tableDatatable').DataTable({
		language: {
			processing:     "Procesado...",
			search: 		"Buscar:",
			lengthMenu:    	"Mostrar _MENU_ registros",
			info:           "Mostrando _END_ de _TOTAL_ registros. ",
			infoEmpty:      "Sin registros para mostrar",	
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