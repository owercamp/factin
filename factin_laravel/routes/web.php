<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//

use App\Http\Controllers\AccessController;
use App\Http\Controllers\TradeController;
use App\Mail\response_to_request;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('auth.login');
});

//Authentication Routes
Auth::routes();

//Ruta Home
Route::get('/home', 'HomeController@index')->name('home');

//ruta Accesos
Route::get('/access', 'AccessController@accessindex')->name('access.roles');
Route::post('/access/save', 'AccessController@accesssave')->name('access.save');
Route::post('/access/update', 'AccessController@accessupdate')->name('access.update');
Route::post('/access/delete', 'AccessController@accessdelete')->name('access.delete');

//ruta Permisos
Route::get('/permission', 'AccessController@permissionindex')->name('access.permission');
Route::post('/permission/add', 'AccessController@permissionaddrole')->name('permmission.add');

//ruta usuarios
Route::get('/users', 'AccessController@usersindex')->name('access.users');
Route::post('/users/assignRole', 'AccessController@assignrole')->name('role.assign');

//ruta Ubicaciones
Route::get('/locations', 'LocationController@locationindex')->name('location.located');
Route::post('/locations/save', 'LocationController@locationsave')->name('location.save');
Route::post('/locations/update', 'LocationController@locationupdate')->name('location.update');
Route::post('/locations/delete', 'LocationController@locationdelete')->name('location.delete');
//ruta Permisos
Route::get('/municipalities', 'LocationController@municipalityindex')->name('municipalities.municipality');
Route::post('/municipalities/save', 'LocationController@municipalitysave')->name('municipalities.save');
Route::post('/municipalities/update', 'LocationController@municipalityupdate')->name('municipalities.update');
Route::post('/municipalities/delete', 'LocationController@municipalitydelete')->name('municipalities.delete');
//ruta información coporativa
Route::get('/corporate-information', 'CompanyController@companyinfoindex')->name('company.information');
Route::post('/corporate-information/save', 'CompanyController@companyinfosave')->name('company.save');
Route::post('/corporate-information/update', 'CompanyController@companyinfoupdate')->name('company.update');
Route::post('/corporate-information/delete', 'CompanyController@companyinfodelete')->name('company.delete');
//ruta imagen coporativa
Route::get('/corporate-image', 'CompanyController@companyimaindex')->name('company.image');
Route::post('/corporate-image/save', 'CompanyController@companyimasave')->name('image.save');
Route::post('/corporate-image/updatecode', 'CompanyController@companyimaupdatecode')->name('image.update.code');
Route::post('/corporate-image/updateimage', 'CompanyController@companyimaupdateimage')->name('image.update.image');
Route::post('/corporate-image/delete', 'CompanyController@companyimadelete')->name('image.delete');
//rutas colaboradores
Route::get('/collaborator', 'CollaboratorController@collaboratorindex')->name('collaborator.index');
Route::post('/collaborator/save', 'CollaboratorController@collaboratorsave')->name('collaborator.save');
Route::post('/collaborator/update', 'CollaboratorController@collaboratorupdate')->name('collaborator.update');
Route::post('/collaborator/delete', 'CollaboratorController@collaboratordelete')->name('collaborator.delete');
//rutas usuarios clientes
Route::get('/users-clients', 'CollaboratorController@usersclientindex')->name('usersclient.index');
Route::post('users-clients/save', 'CollaboratorController@usersclientsave')->name('usersclient.save');
Route::post('users-clients/edit', 'CollaboratorController@usersclientedit')->name('usersclient.edit');
Route::post('users-clients/delete', 'CollaboratorController@usersclientdelete')->name('usersclient.delete');
Route::post('users-clients/printer', 'CollaboratorController@usersclientprinter')->name('userclient.printer');
//rutas productos
Route::get('/product', 'ProductController@productindex')->name('product.index');
Route::post('/product/save', 'ProductController@productsave')->name('product.save');
Route::post('/product/update', 'ProductController@productupdate')->name('product.update');
Route::post('/product/delete', 'ProductController@productdelete')->name('product.delete');
//rutas modulos productos
Route::get('/module-product', 'ProductController@moduleproductindex')->name('module.index');
Route::post('/module-product/save', 'ProductController@moduleproductsave')->name('module.save');
Route::post('/module-product/update', 'ProductController@moduleproductupdate')->name('module.update');
Route::post('/module-product/delete', 'ProductController@moduleproductdelete')->name('module.delete');
//rutas configuracion modulos producto
Route::get('/config-module-product', 'ProductConfigController@configmoduleproductindex')->name('config.index');
Route::post('/config-module-product/save', 'ProductConfigController@configmoduleproductsave')->name('config.save');
Route::post('/config-module-product/update', 'ProductConfigController@configmoduleproductupdate')->name('config.update');
Route::post('/config-module-product/delete', 'ProductConfigController@configmoduleproductdelete')->name('config.delete');
//rutas servicios
Route::get('/services-type', 'TypeServiceController@typeserviceindex')->name('services.index');
Route::post('/services-type/save', 'TypeServiceController@typeservicesave')->name('services.save');
Route::post('/services-type/update', 'TypeServiceController@typeserviceupdate')->name('services.update');
Route::post('/services-type/delete', 'TypeServiceController@typeservicedelete')->name('services.delete');
//rutas Factin web
Route::get('/Factin-Web', 'PortfolioController@factinwebindex')->name('factin.index');
Route::post('/Factin-Web/save', 'PortfolioController@factinwebsave')->name('factin.save');
Route::post('/Factin-Web/update', 'PortfolioController@factinwebupdate')->name('factin.update');
Route::post('/Factin-Web/delete', 'PortfolioController@factinwebdelete')->name('factin.delete');
//rutas Software
Route::get('/Software', 'PortfolioController@softwareindex')->name('software.index');
Route::post('/Software/save', 'PortfolioController@softwaresave')->name('software.save');
Route::post('/Software/update', 'PortfolioController@softwareupdate')->name('software.update');
Route::post('/Software/delete', 'PortfolioController@softwaredelete')->name('software.delete');
//rutas Hardware
Route::get('/Hardware', 'PortfolioController@hardwareindex')->name('hardware.index');
Route::post('/Hardware/save', 'PortfolioController@hardwaresave')->name('hardware.save');
Route::post('/Hardware/update', 'PortfolioController@hardwareupdate')->name('hardware.update');
Route::post('/Hardware/delete', 'PortfolioController@hardwaredelete')->name('hardware.delete');
//rutas Soporte Tecnico
Route::get('/Technical-Support', 'PortfolioController@technicalsupportindex')->name('support.index');
Route::post('/Technical-Support/save', 'PortfolioController@technicalsupportsave')->name('support.save');
Route::post('/Technical-Support/update', 'PortfolioController@technicalsupportupdate')->name('support.update');
Route::post('/Technical-Support/delete', 'PortfolioController@technicalsupportdelete')->name('support.delete');
// rutas oprtunidad de negocio
Route::get('/Business-Opportunity', 'BusinessController@businessoportunityindex')->name('oportunity.index');
route::post('/Business-Opportunity/New', 'BusinessController@businessoportunitynew')->name('oportunity.new');
// rutas seguimiento de negocios
Route::get('/Business-Tracking', 'BusinessController@businesstrackingindex')->name('tracking.index');
Route::post('/Business-Tracking/update', 'BusinessController@businesstrackingapdate')->name('tracking.update');
Route::post('/Business-Teken', 'BusinessController@tekensindex')->name('teken.index');
Route::post('/Bussiness-Tracking/status-approved', 'BusinessController@tekenupdatestatusapproved')->name('status.approved');
Route::post('/Bussiness-Tracking/status-non-approved', 'BusinessController@tekenupdatestatusnonapproved')->name('status.non-approved');
// rutas indicadores de exito
Route::get('/Success-Indicators', 'BusinessController@businessindicatorsindex')->name('indicators.index');
// rutas archivos de negocios
Route::get('/Business-Archive', 'BusinessController@businessarchiveindex')->name('archive.index');
// rutas comercial
Route::get('/Commercial-Proposal', 'TradeController@commercialproposalindex')->name('proposal.index');
Route::post('/Commercial-Proposal/save', 'TradeController@commercialproposalsave')->name('proposal.save');
Route::post('/Commercial-Proposal/update', 'TradeController@commercialproposalupdate')->name('proposal.update');
//rutas  monitoreo comercial
Route::get('/Commercial-Monitoring', 'TradeController@commercialmonitoringindex')->name('monitoring.index');
Route::post('/Commercial-Monitoring/teken', 'TradeController@commercialmonitoringteken')->name('tekencommercial.index');
Route::post('/Commercial-Monitoring/status-approved', 'TradeController@commercialmonitoringapproved')->name('status.approvedcommercial');
Route::post('/Commercial-Monitoring/status-nonapproved', 'TradeController@commercialmonitoringnonapproved')->name('status.non-approvedcommercial');
Route::get('/Commercial-File', 'TradeController@commercialfileindex')->name('file.index');
Route::get('/Commercial-Indicator', 'TradeController@commercialindicatorsindex')->name('indic.index');
//pdf
Route::post('/Commercial-Monitoring/PDF', 'TradeController@CommercialPDF')->name('commercial.pdf');
Route::post('/Commercial-Monitoring/StatusPDF', 'TradeController@CommercialstatusPDF')->name('commercialstatus.pdf');
//contratación cliente
Route::get('/Agreement-ClientLegalization', 'AgreementController@ClienteLegalization')->name('ClientLegalization.index');
Route::post('/Agreement-ClientLegalization/save', 'AgreementController@ClientLegalizationSave')->name('ClientLegalization.save');
Route::post('/Agreement-ClientLegalization/update', 'AgreementController@ClientLegalizationUpdate')->name('ClientLegalization.update');
Route::post('/Agreement-ClientLegalization/delete', 'AgreementController@ClientLegalizationDelete')->name('ClientLegalization.delete');
// contratación legalizacion
Route::get('/Agreement-ContractLegalization', 'AgreementController@ContractLegalization')->name('ContractLegalization.index');
Route::post('/Agreement-ContractLegalization/save', 'AgreementController@ContractLegalizationSave')->name('ContractLegalization.save');
Route::post('/Agreement-ContractLegalization/update', 'AgreementController@ContractLegalizationUpdate')->name('ContractLegalization.update');
Route::post('/Agreement-ContractLegalization/delete', 'AgreementController@ContractLegalizationDelete')->name('ContractLegalization.delete');
Route::post('/Agreement-ContractLegalization/printer', 'AgreementController@ContractLegalizationPrinter')->name('contract.printer');
Route::post('/Agreement-ContractLegalization/fail', 'AgreementController@ContractLegalizationFail')->name('contract.fail');
// contratación archivos
Route::get('/Agreement-ContractsFile', 'AgreementController@ContractsFile')->name('ContractsFile.index');
// contrataciones indicadores
Route::get('/Agreement-SuccessIndicator', 'AgreementController@SuccessIndicator')->name('SuccessIndicator.index');
// rutas solicitudes
Route::get('/Request', 'RequestController@requestindex')->name('request.index');
Route::post('/Request/save', 'RequestController@requestsave')->name('request.save');
Route::post('/Request/printer', 'RequestController@requestprinter')->name('request.print');
// rutas programacion
Route::get('/Programming', 'RequestController@programmingindex')->name('programming.index');
Route::post('/Programming/update', 'RequestController@programmingupdate')->name('programming.update');
Route::post('/Programming/assing', 'RequestController@programmingassign')->name('programming.assign');
// rutas seguimiento
Route::get('/Tracing', 'RequestController@tracingindex')->name('tracing.index');
Route::post('/Tracing/save', 'RequestController@tracingsave')->name('tracing.save');
Route::post('/Tracing/editlead', 'RequestController@tracingeditlead')->name('Edit.lead');
Route::post('/Tracing/close', 'RequestController@tracingclose')->name('tracing.close');
// rutas calificativo
Route::get('/Qualification', 'RequestController@qualificationindex')->name('qualification.index');
// ruta calificación cliente
Route::post('/Qualification/user-rating', 'RequestController@qualificationuser')->name('user.rating');
// rutas archivo
Route::get('/Archive', 'RequestController@archiveindex')->name('archiverequest.index');
Route::post('/Archive/follow', 'RequestController@archivePDF')->name('archive.print');
// ruta de correo envio
Route::post('/Emails', 'RequestController@responsetorequest')->name('responsetorequest.response');
//ruta estado de cuentas
Route::get('/AccountStatus', 'AccountstatusController@Accountindex')->name('account.index');
Route::post('/AccountStatus/factura', 'AccountstatusController@accountfact')->name('account.fact');
//rutas financiera
Route::get('/BillingOrder', 'FinanceController@billingorderindex')->name('billingorder.finance');
Route::post('/BillingOrder/PrinterOrder', 'FinanceController@billingorderpdf')->name('billing.order');
Route::get('/Commissions', 'FinanceController@comissionsindex')->name('comission.finance');
Route::post('/Commissions/save', 'FinanceController@commissionsave')->name('commission.save');
Route::post('/Commissions/PrinterCommission', 'FinanceController@commissionpdf')->name('commission.pdf');
// rutas de mis graficas con chard js
Route::get('/YearSales', 'FinanceController@salesindex')->name('sales.index');
Route::get('/YearCommissions', 'FinanceController@commissionindex')->name('commission.index');
