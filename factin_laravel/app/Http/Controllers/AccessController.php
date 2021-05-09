<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* ===============================================================================================
			MODULO CREACION DE ROLES (CONFIGURACION)
    =============================================================================================== */

    function accessindex()
    {
        $rol = Role::all();
        return view('partials.Access.access', compact('rol'));
    }
    function accesssave(Request $request)
    {
        $validate = Role::where('name', $this::upper($request->rolename))->first();
        if ($validate == null) {
            Role::create([
                'name' => $this::upper($request->rolename)
            ]);
            return redirect()->route('access.roles')->with('SuccessCreation', 'Rol ' . $this::upper($request->rolename) . ' creado ');
        }
    }
    function accessupdate(Request $request)
    {
        $validateData = Role::where('name', $this::upper($request->rolename_Edit))
            ->where('id', '!=', trim($request->roleid_Edit))
            ->first();
        if ($validateData == null) {
            $valida = Role::find($request->roleid_Edit);
            if ($valida != null) {
                $valida->name = $this::upper($request->rolename_Edit);
                $valida->save();
                return redirect()->route('access.roles')->with('PrimaryCreation', 'Rol ' . $this::upper($request->rolename_Edit) . ' actualizado');
            } else {
                return redirect()->route('access.roles')->with('SecondaryCreation', 'NoEncontrado');
            }
        } else {
            return redirect()->route('access.roles')->with('SecondaryCreation', 'Rol ' . $request->rolename_edit . ' existente');
        }
    }
    function accessdelete(Request $request)
    {
        $validate = Role::where(trim($request->roleid_Delete));
        if ($validate != null) {
            Role::findOrFail($request->roleid_Delete)->delete();
            return redirect()->route('access.roles')->with('WarningCreation', 'Rol eliminado');
        } else {
            return redirect()->route('access.roles')->with('SecondDelete', 'NoEncontrado');
        }
    }

    /* ===============================================================================================
			MODULO CREACION DE PERMISOS (CONFIGURACION)
    =============================================================================================== */

    function permissionindex()
    {
        $role = Role::all();
        return view('partials.Access.permission', compact('role'));
    }

    function permissionaddrole(Request $request)
    {
        $role = Role::where('id',$request->rol)->first();

        // return $request;

        if ($request->access == 'on') {
            $role->givePermissionTo('access.roles');
            $role->givePermissionTo('access.save');
            $role->givePermissionTo('access.update');
            $role->givePermissionTo('access.dalete');
            $role->givePermissionTo('access.permission');
            $role->givePermissionTo('access.users');
            $role->givePermissionTo('permission.add');
        }else{
            $role->revokePermissionTo('access.roles');
            $role->revokePermissionTo('access.save');
            $role->revokePermissionTo('access.update');
            $role->revokePermissionTo('access.dalete');
            $role->revokePermissionTo('access.permission');
            $role->revokePermissionTo('access.users');
            $role->revokePermissionTo('permission.add');
        }
        if ($request->location == 'on') {
            $role->givePermissionTo('location.located');
            $role->givePermissionTo('location.save');
            $role->givePermissionTo('location.update');
            $role->givePermissionTo('location.delete');
            $role->givePermissionTo('municipalities.municipality');
            $role->givePermissionTo('municipalities.save');
            $role->givePermissionTo('municipalities.update');
            $role->givePermissionTo('municipalities.delete');            
        }else{
            $role->revokePermissionTo('location.located');
            $role->revokePermissionTo('location.save');
            $role->revokePermissionTo('location.update');
            $role->revokePermissionTo('location.delete');
            $role->revokePermissionTo('municipalities.municipality');
            $role->revokePermissionTo('municipalities.save');
            $role->revokePermissionTo('municipalities.update');
            $role->revokePermissionTo('municipalities.delete');
        }
        if ($request->company == 'on') {
            $role->givePermissionTo('company.information');
            $role->givePermissionTo('company.save');
            $role->givePermissionTo('company.update');
            $role->givePermissionTo('company.delete');
            $role->givePermissionTo('company.image');
            $role->givePermissionTo('image.save');
            $role->givePermissionTo('image.update.code');
            $role->givePermissionTo('image.update.image');
            $role->givePermissionTo('image.delete');
        }else{
            $role->revokePermissionTo('company.information');
            $role->revokePermissionTo('company.save');
            $role->revokePermissionTo('company.update');
            $role->revokePermissionTo('company.delete');
            $role->revokePermissionTo('company.image');
            $role->revokePermissionTo('image.save');
            $role->revokePermissionTo('image.update.code');
            $role->revokePermissionTo('image.update.image');
            $role->revokePermissionTo('image.delete');
        }
        if ($request->humanResources == 'on') {
            $role->givePermissionTo('collaborator.index');
            $role->givePermissionTo('collaborator.save');
            $role->givePermissionTo('collaborator.update');
            $role->givePermissionTo('collaborator.delete');
            $role->givePermissionTo('usersclient.index');
            $role->givePermissionTo('usersclient.save');
            $role->givePermissionTo('usersclient.edit');
            $role->givePermissionTo('usersclient.delete');
            $role->givePermissionTo('usersclient.printer');            
        }else{
            $role->revokePermissionTo('collaborator.index');
            $role->revokePermissionTo('collaborator.save');
            $role->revokePermissionTo('collaborator.update');
            $role->revokePermissionTo('collaborator.delete');
            $role->revokePermissionTo('usersclient.index');
            $role->revokePermissionTo('usersclient.save');
            $role->revokePermissionTo('usersclient.edit');
            $role->revokePermissionTo('usersclient.delete');
            $role->revokePermissionTo('usersclient.printer');
        }
        if ($request->typeProducts == 'on') {
            $role->givePermissionTo('product.index'); 
            $role->givePermissionTo('product.save'); 
            $role->givePermissionTo('product.update'); 
            $role->givePermissionTo('product.delete'); 
            $role->givePermissionTo('module.index'); 
            $role->givePermissionTo('module.save'); 
            $role->givePermissionTo('module.update'); 
            $role->givePermissionTo('module.delete'); 
            $role->givePermissionTo('config.index'); 
            $role->givePermissionTo('config.save'); 
            $role->givePermissionTo('config.update'); 
            $role->givePermissionTo('config.delete'); 
        }else{
            $role->revokePermissionTo('product.index'); 
            $role->revokePermissionTo('product.save'); 
            $role->revokePermissionTo('product.update'); 
            $role->revokePermissionTo('product.delete'); 
            $role->revokePermissionTo('module.index'); 
            $role->revokePermissionTo('module.save'); 
            $role->revokePermissionTo('module.update'); 
            $role->revokePermissionTo('module.delete'); 
            $role->revokePermissionTo('config.index'); 
            $role->revokePermissionTo('config.save'); 
            $role->revokePermissionTo('config.update'); 
            $role->revokePermissionTo('config.delete');
        }
        if ($request->typeServices == 'on') {
            $role->givePermissionTo('services.index');
            $role->givePermissionTo('services.save');
            $role->givePermissionTo('services.update');
            $role->givePermissionTo('services.delete');
        }else{
            $role->revokePermissionTo('services.index');
            $role->revokePermissionTo('services.save');
            $role->revokePermissionTo('services.update');
            $role->revokePermissionTo('services.delete');
        }
        if ($request->statusFinance == 'on') {
            $role->givePermissionTo('account.index');
            $role->givePermissionTo('account.fact');
        }else{
            $role->revokePermissionTo('account.index');
            $role->revokePermissionTo('account.fact');
        }
        if ($request->commercialTrade == 'on') {
            $role->givePermissionTo('billingorder.finance');
            $role->givePermissionTo('billing.order');
            $role->givePermissionTo('comission.finance');
            $role->givePermissionTo('commission.save');
            $role->givePermissionTo('commission.pdf');
            $role->givePermissionTo('sales.index');
            $role->givePermissionTo('commission.index');
        }else{
            $role->revokePermissionTo('billingorder.finance');
            $role->revokePermissionTo('billing.order');
            $role->revokePermissionTo('comission.finance');
            $role->revokePermissionTo('commission.save');
            $role->revokePermissionTo('commission.pdf');
            $role->revokePermissionTo('sales.index');
            $role->revokePermissionTo('commission.index');
        }
        if ($request->requests == 'on') {
            $role->givePermissionTo('request.index');
            $role->givePermissionTo('request.save');
            $role->givePermissionTo('request.print');
        }else{
            $role->revokePermissionTo('request.index');
            $role->revokePermissionTo('request.save');
            $role->revokePermissionTo('request.print');
        }
        if ($request->programing == 'on') {
            $role->givePermissionTo('programming.index');
            $role->givePermissionTo('programming.save');
            $role->givePermissionTo('programming.assign');
        }else{
            $role->revokePermissionTo('programming.index');
            $role->revokePermissionTo('programming.save');
            $role->revokePermissionTo('programming.assign');
        }
        if ($request->monitoring == 'on') {
            $role->givePermissionTo('tracing.index');
            $role->givePermissionTo('tracing.save');
            $role->givePermissionTo('Edit.lead');
            $role->givePermissionTo('tracing.close');
        }else{
            $role->revokePermissionTo('tracing.index');
            $role->revokePermissionTo('tracing.save');
            $role->revokePermissionTo('Edit.lead');
            $role->revokePermissionTo('tracing.close');
        }
        if ($request->qualities == 'on') {
            $role->givePermissionTo('qualification.index');
        }else{
            $role->revokePermissionTo('qualification.index');
        }
        if ($request->archive == 'on') {
            $role->givePermissionTo('user.rating');
        }else{
            $role->revokePermissionTo('user.rating');
        }
        if ($request->portfolio == 'on') {
            $role->givePermissionTo('factin.index');
            $role->givePermissionTo('factin.save');
            $role->givePermissionTo('factin.update');
            $role->givePermissionTo('factin.delete');
            $role->givePermissionTo('software.index');
            $role->givePermissionTo('software.save');
            $role->givePermissionTo('software.update');
            $role->givePermissionTo('software.delete');
            $role->givePermissionTo('hardware.index');
            $role->givePermissionTo('hardware.save');
            $role->givePermissionTo('hardware.update');
            $role->givePermissionTo('hardware.delete');
            $role->givePermissionTo('support.index');
            $role->givePermissionTo('support.save');
            $role->givePermissionTo('support.update');
            $role->givePermissionTo('support.delete');
        }else{
            $role->revokePermissionTo('factin.index');
            $role->revokePermissionTo('factin.save');
            $role->revokePermissionTo('factin.update');
            $role->revokePermissionTo('factin.delete');
            $role->revokePermissionTo('software.index');
            $role->revokePermissionTo('software.save');
            $role->revokePermissionTo('software.update');
            $role->revokePermissionTo('software.delete');
            $role->revokePermissionTo('hardware.index');
            $role->revokePermissionTo('hardware.save');
            $role->revokePermissionTo('hardware.update');
            $role->revokePermissionTo('hardware.delete');
            $role->revokePermissionTo('support.index');
            $role->revokePermissionTo('support.save');
            $role->revokePermissionTo('support.update');
            $role->revokePermissionTo('support.delete');
        }
        if ($request->marketingPlan == 'on') {
            $role->givePermissionTo('oportunity.index');
            $role->givePermissionTo('oportunity.new');
            $role->givePermissionTo('tracking.index');
            $role->givePermissionTo('tracking.update');
            $role->givePermissionTo('teken.index');
            $role->givePermissionTo('status.approved');
            $role->givePermissionTo('status.non-approved');
            $role->givePermissionTo('indicators.index');
            $role->givePermissionTo('archive.index');
        }else{
            $role->revokePermissionTo('oportunity.index');
            $role->revokePermissionTo('oportunity.new');
            $role->revokePermissionTo('tracking.index');
            $role->revokePermissionTo('tracking.update');
            $role->revokePermissionTo('teken.index');
            $role->revokePermissionTo('status.approved');
            $role->revokePermissionTo('status.non-approved');
            $role->revokePermissionTo('indicators.index');
            $role->revokePermissionTo('archive.index');
        }
        if ($request->potentialCustomer == 'on') {
            $role->givePermissionTo('proposal.index');
            $role->givePermissionTo('proposal.save');
            $role->givePermissionTo('proposal.update');
            $role->givePermissionTo('monitoring.index');
            $role->givePermissionTo('tekencommercial.index');
            $role->givePermissionTo('status.approvedcommercial');
            $role->givePermissionTo('status.non-approvedcommercial');
            $role->givePermissionTo('file.index');
            $role->givePermissionTo('indic.index');
            $role->givePermissionTo('commercial.pdf');
            $role->givePermissionTo('commercialstatus.pdf');
        }else{
            $role->revokePermissionTo('proposal.index');
            $role->revokePermissionTo('proposal.save');
            $role->revokePermissionTo('proposal.update');
            $role->revokePermissionTo('monitoring.index');
            $role->revokePermissionTo('tekencommercial.index');
            $role->revokePermissionTo('status.approvedcommercial');
            $role->revokePermissionTo('status.non-approvedcommercial');
            $role->revokePermissionTo('file.index');
            $role->revokePermissionTo('indic.index');
            $role->revokePermissionTo('commercial.pdf');
            $role->revokePermissionTo('commercialstatus.pdf');
        }
        if ($request->contract == 'on') {
            $role->givePermissionTo('ClientLegalization.index');
            $role->givePermissionTo('ClientLegalization.save');
            $role->givePermissionTo('ClientLegalization.update');
            $role->givePermissionTo('ClientLegalization.delete');
            $role->givePermissionTo('ContractLegalization.index');
            $role->givePermissionTo('ContractLegalization.save');
            $role->givePermissionTo('ContractLegalization.update');
            $role->givePermissionTo('ContractLegalization.delete');
            $role->givePermissionTo('contract.printer');
            $role->givePermissionTo('contract.fail');
            $role->givePermissionTo('ContractsFile.index');
            $role->givePermissionTo('SuccessIndicator.index');
        }else{
            $role->revokePermissionTo('ClientLegalization.index');
            $role->revokePermissionTo('ClientLegalization.save');
            $role->revokePermissionTo('ClientLegalization.update');
            $role->revokePermissionTo('ClientLegalization.delete');
            $role->revokePermissionTo('ContractLegalization.index');
            $role->revokePermissionTo('ContractLegalization.save');
            $role->revokePermissionTo('ContractLegalization.update');
            $role->revokePermissionTo('ContractLegalization.delete');
            $role->revokePermissionTo('contract.printer');
            $role->revokePermissionTo('contract.fail');
            $role->revokePermissionTo('ContractsFile.index');
            $role->revokePermissionTo('SuccessIndicator.index');
        }

        return \redirect()->route('access.permission')->with("SuccessCreation",'permisos actualizados');
    }

    /* ===============================================================================================
			MODULO CREACION DE USUARIOS (CONFIGURACION)
    =============================================================================================== */

    function usersindex()
    {
        $users = User::all();
        $roles = Role::all();        
        return view('partials.Access.users', compact('users','roles'));
    }
}
