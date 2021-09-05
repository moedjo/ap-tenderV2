<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

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
        BackendMenu::setContext('Ap.Tender', 'tender', 'open-tender');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {

            
        } 

        if ($context == 'create') {
           
        } 
    }

    public function formAfterSave($model)
    {
        // $model->status = 'registration';

        $user = $this->user;
        $tenant = Tenant::where('user_id', $user->id)->first();


        $tender_tenant = new TenderTenant();
        $tender_tenant->tender = $model;
        $tender_tenant->tenant = $tenant;
        $tender_tenant->status = 'registration';

        $tender_tenant->save();
 
    }


    // public function index_onDelete()
    // {
    //     return Response::make(View::make('backend::access_denied'), 403);
    // }
    // public function update_onDelete($recordId = null)
    // {
    //     return Response::make(View::make('backend::access_denied'), 403);
    // }

    // public function create($context = null)
    // {
    //     return Response::make(View::make('backend::access_denied'), 403);
    // }

    // public function preview($recordId = null, $context = null)
    // {
    //     return Response::make(View::make('backend::access_denied'), 403);
    // }

}
