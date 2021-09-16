<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Mail;

class TenderTenants extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'ap_tender_is_tenant'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'tender-registration');


    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            
            $user = $this->user;
            $tenant = $user->tenant;
            $tender_tenant = TenderTenant::where('tender_id',$model->id)
                ->where('tenant_id', $tenant->id)->first();


            $this->vars['is_registered']= $tender_tenant ? true : false;

        } 

        if ($context == 'create') {
           
        } 
    }

    public function extendQuery($query)
    {
        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();
        $business_field_ids = $tenant->business_fields->pluck('id');
    
        return $query->whereIn('business_field_id',  $business_field_ids)->where('status', 'registration');
    }

    public function listExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formAfterSave($model)
    {
        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();
        if($tenant->status == 'short_listed') {
            $tender_tenant = new TenderTenant();
            $tender_tenant->tender = $model;
            $tender_tenant->tenant = $tenant;
            $tender_tenant->status = 'pre_registration';

            $tender_tenant->save();
        }
 
    }


    public function index_onDelete()
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }
    public function update_onDelete($recordId = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function create($context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function preview($recordId = null, $context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function listOverrideRecordUrl($record, $definition = null)
    {
        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();
        if ($tenant->status != 'short_listed') {
            return ['clickable' => false];
        }
    }

}
