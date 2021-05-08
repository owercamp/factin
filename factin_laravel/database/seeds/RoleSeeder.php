<?php

use App\User;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // creación de mis roles
        // $roleAdmin = Role::create(['name' => 'ADMINISTRADOR']);
        // $roleComercial = Role::create(['name' => 'COMERCIAL']);
        // $roleSoporte = Role::create(['name' => 'SOPORTE']);
        // $roleFinanciero = Role::create(['name' => 'FINANCIERO']);

        // // creacion de mis permisos para las rutas
        // // permisos ACCESO
        // Permission::create(['name' => 'access.roles']);
        // Permission::create(['name' => 'access.save']);
        // Permission::create(['name' => 'access.update']);
        // Permission::create(['name' => 'access.dalete']);
        // Permission::create(['name' => 'access.permission']);
        // Permission::create(['name' => 'access.users']);
        // // permisos de UBICACION
        // Permission::create(['name' => 'location.located']);
        // Permission::create(['name' => 'location.save']);
        // Permission::create(['name' => 'location.update']);
        // Permission::create(['name' => 'location.delete']);

        // Permission::create(['name' => 'municipalities.municipality']);
        // Permission::create(['name' => 'municipalities.save']);
        // Permission::create(['name' => 'municipalities.update']);
        // Permission::create(['name' => 'municipalities.delete']);
        // // permisos CORPORATIVOS
        // Permission::create(['name' => 'company.information']);
        // Permission::create(['name' => 'company.save']);
        // Permission::create(['name' => 'company.update']);
        // Permission::create(['name' => 'company.delete']);
        // // permisos IMAGEN
        // Permission::create(['name' => 'company.image']);
        // Permission::create(['name' => 'image.save']);
        // Permission::create(['name' => 'image.update.code']);
        // Permission::create(['name' => 'image.update.image']);
        // Permission::create(['name' => 'image.delete']);
        // // permisos COLABORADORES
        // Permission::create(['name' => 'collaborator.index']);
        // Permission::create(['name' => 'collaborator.save']);
        // Permission::create(['name' => 'collaborator.update']);
        // Permission::create(['name' => 'collaborator.delete']);
        // // permisos USUARIOS - CLIENTES
        // Permission::create(['name' => 'usersclient.index']);
        // Permission::create(['name' => 'usersclient.save']);
        // Permission::create(['name' => 'usersclient.edit']);
        // Permission::create(['name' => 'usersclient.delete']);
        // Permission::create(['name' => 'usersclient.printer']);
        // // permisos PRODUCTOS
        // Permission::create(['name' => 'product.index']);
        // Permission::create(['name' => 'product.save']);
        // Permission::create(['name' => 'product.update']);
        // Permission::create(['name' => 'product.delete']);
        // // permisos MODULOS PRODUCTOS
        // Permission::create(['name' => 'module.index']);
        // Permission::create(['name' => 'module.save']);
        // Permission::create(['name' => 'module.update']);
        // Permission::create(['name' => 'module.delete']);
        // // permisos CONFIGURACION MODULOS PRODUCTOS
        // Permission::create(['name' => 'config.index']);
        // Permission::create(['name' => 'config.save']);
        // Permission::create(['name' => 'config.update']);
        // Permission::create(['name' => 'config.delete']);
        // // permisos SERVICIOS
        // Permission::create(['name' => 'services.index']);
        // Permission::create(['name' => 'services.save']);
        // Permission::create(['name' => 'services.update']);
        // Permission::create(['name' => 'services.delete']);
        // // permisos FACTIN
        // Permission::create(['name' => 'factin.index']);
        // Permission::create(['name' => 'factin.save']);
        // Permission::create(['name' => 'factin.update']);
        // Permission::create(['name' => 'factin.delete']);
        // // permisos SOFTWARE
        // Permission::create(['name' => 'software.index']);
        // Permission::create(['name' => 'software.save']);
        // Permission::create(['name' => 'software.update']);
        // Permission::create(['name' => 'software.delete']);
        // // permisos HARDWARE
        // Permission::create(['name' => 'hardware.index']);
        // Permission::create(['name' => 'hardware.save']);
        // Permission::create(['name' => 'hardware.update']);
        // Permission::create(['name' => 'hardware.delete']);
        // // permisos SOPORTE TECNICO
        // Permission::create(['name' => 'support.index']);
        // Permission::create(['name' => 'support.save']);
        // Permission::create(['name' => 'support.update']);
        // Permission::create(['name' => 'support.delete']);
        // // permisos OPRTUNIDADES DE NEGOCIO
        // Permission::create(['name' => 'oportunity.index']);
        // Permission::create(['name' => 'oportunity.new']);
        // // permisos SEGUIMIENTO OPRTINUDAD NEGOCIO
        // Permission::create(['name' => 'tracking.index']);
        // Permission::create(['name' => 'tracking.update']);
        // // permisos BITACORAS
        // Permission::create(['name' => 'teken.index']);
        // Permission::create(['name' => 'status.approved']);
        // Permission::create(['name' => 'status.non-approved']);
        // // permisos INDICADORES
        // Permission::create(['name' => 'indicators.index']);
        // Permission::create(['name' => 'archive.index']);
        // // permisos COMERCIAL
        // Permission::create(['name' => 'proposal.index']);
        // Permission::create(['name' => 'proposal.save']);
        // Permission::create(['name' => 'proposal.update']);
        // // permisos MONITOREO COMERCIAL
        // Permission::create(['name' => 'monitoring.index']);
        // Permission::create(['name' => 'tekencommercial.index']);
        // Permission::create(['name' => 'status.approvedcommercial']);
        // Permission::create(['name' => 'status.non-approvedcommercial']);
        // Permission::create(['name' => 'file.index']);
        // Permission::create(['name' => 'indic.index']);
        // Permission::create(['name' => 'commercial.pdf']);
        // Permission::create(['name' => 'commercialstatus.pdf']);
        // // permisos CONTRATACION CLIENTE
        // Permission::create(['name' => 'ClientLegalization.index']);
        // Permission::create(['name' => 'ClientLegalization.save']);
        // Permission::create(['name' => 'ClientLegalization.update']);
        // Permission::create(['name' => 'ClientLegalization.delete']);
        // // permisos CONTRATACIÓN LEGALIZACION|
        // Permission::create(['name' => 'ContractLegalization.index']);
        // Permission::create(['name' => 'ContractLegalization.save']);
        // Permission::create(['name' => 'ContractLegalization.update']);
        // Permission::create(['name' => 'ContractLegalization.delete']);
        // Permission::create(['name' => 'contract.printer']);
        // Permission::create(['name' => 'contract.fail']);
        // Permission::create(['name' => 'ContractsFile.index']);
        // Permission::create(['name' => 'SuccessIndicator.index']);
        // // permisos SOLICITUDES
        // Permission::create(['name' => 'request.index']);
        // Permission::create(['name' => 'request.save']);
        // Permission::create(['name' => 'request.print']);
        // // permisos PROGRAMACION
        // Permission::create(['name' => 'programming.index']);
        // Permission::create(['name' => 'programming.save']);
        // Permission::create(['name' => 'programming.assign']);
        // // permisos SEGUIMIENTO
        // Permission::create(['name' => 'tracing.index']);
        // Permission::create(['name' => 'tracing.save']);
        // Permission::create(['name' => 'Edit.lead']);
        // Permission::create(['name' => 'tracing.close']);
        // // permisos CALIFICACION
        // Permission::create(['name' => 'qualification.index']);
        // // permisos ARCHIVOS
        // Permission::create(['name' => 'user.rating']);
        // // PERMISOS CORREOS ENVIADOS
        // Permission::create(['name' => 'archiverequest.index']);
        // Permission::create(['name' => 'archive.print']);
        // Permission::create(['name' => 'responsetorequest.response']);
        // // permisos ESTADOS DE CUENTAS
        // Permission::create(['name' => 'account.index']);
        // Permission::create(['name' => 'account.fact']);
        // // permisos FINANCIERA
        // Permission::create(['name' => 'billingorder.finance']);
        // Permission::create(['name' => 'billing.order']);
        // Permission::create(['name' => 'comission.finance']);
        // Permission::create(['name' => 'commission.save']);
        // Permission::create(['name' => 'commission.pdf']);
        // Permission::create(['name' => 'sales.index']);
        // Permission::create(['name' => 'commission.index']);

        // $iUser = User::where('id',2)->first();

        // $iUser->syncPermissions(['access.roles', 'access.save','access.update','access.dalete','access.permission','access.users','location.located','location.save','location.update','location.delete','municipalities.municipality','municipalities.save','municipalities.update','municipalities.delete','company.information','company.save','company.update','company.delete','company.image','image.save','image.update.code','image.update.image','image.delete','collaborator.index','collaborator.save','collaborator.update','collaborator.delete','usersclient.index','usersclient.save','usersclient.edit','usersclient.delete','usersclient.printer','product.index','product.save','product.update','product.delete','module.index','module.save','module.update','module.delete','config.index','config.save','config.update','config.delete','services.index','services.save','services.update','services.delete','factin.index','factin.save','factin.update','factin.delete','software.index','software.save','software.update','software.delete','hardware.index','hardware.save','hardware.update','hardware.delete','support.index','support.save','support.update','support.delete','oportunity.index','oportunity.new','tracking.index','tracking.update','teken.index','status.approved','status.non-approved','indicators.index','archive.index','proposal.index','proposal.save','proposal.update','monitoring.index','tekencommercial.index','status.approvedcommercial','status.non-approvedcommercial','file.index','indic.index','commercial.pdf','commercialstatus.pdf','ClientLegalization.index','ClientLegalization.save','ClientLegalization.update','ClientLegalization.delete','ContractLegalization.index','ContractLegalization.save','ContractLegalization.update','ContractLegalization.delete','contract.printer','contract.fail','ContractsFile.index','SuccessIndicator.index','request.index','request.save','request.print','programming.index','programming.save','programming.assign','tracing.index','tracing.save','Edit.lead','tracing.close','qualification.index','user.rating','archiverequest.index','archive.print','responsetorequest.response','account.index','account.fact','billingorder.finance','billing.order','comission.finance','commission.save','commission.pdf','sales.index','commission.index']);
    }
}
