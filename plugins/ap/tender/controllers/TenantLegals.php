<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\View;
use Redirect;
use Response;

class TenantLegals extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
    ];

    public $formConfig = 'config_form.yaml';


    public $requiredPermissions = [
        'ap_tender_is_tenant',
        'ap_tender_access_tenants'
    ];


    public function __construct()
    {
        parent::__construct();


        $user = $this->user;
        $sub_menu = 'tenants';
        if ($user->hasPermission('ap_tender_is_tenant')) {
            $sub_menu = 'my-tenant';
        }

        if ($user->is_superuser) {
            $sub_menu = 'tenants';
        }

        BackendMenu::setContext('Ap.Tender', 'tenant', $sub_menu);



        $this->addCss('/plugins/ap/tender/assets/css/custom.css', 'Ap.Tender');
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


    public function extendQuery($query)
    {

        $user = $this->user;
        if ($user->hasPermission('ap_tender_is_tenant')) {
            return $query->where('user_id', $user->id);
        }

        return $query;
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }


    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;

        if ($context == 'update') {


            $reject_fields = [];

            if ($model->status == 'register' && $model->on_legal_status == 'reject') {
                $verifications = $model->verification_legals;
                foreach ($verifications as $verification) {
                    if (!$verification->pivot->on_check) {
                        $v_fields = explode(",", $verification->fields);
                        foreach ($v_fields as $v_field) {
                            $reject_fields[] =  $v_field;
                        }
                    }
                }
            }


            if ($model->status == 'request_update_approved') {
                $updates = $model->updates;
                foreach ($updates as $update) {
                    $reject_fields[] =  $update->field;
                }
            }



            $reject_fields = array_unique($reject_fields);
            foreach ($fields as $field) {
                $this->vars['disabled_' . $field->fieldName] = false;
                if (!in_array($field->fieldName, $reject_fields)) {
                    $field->disabled = true;
                    $field->config['disabled'] = true;
                    $this->vars['disabled_' . $field->fieldName] = true;
                }
            };
        }
    }


    public function update($recordId = null)
    {

        $user = $this->user;

        if (isset($recordId)) {
            return $this->asExtension('FormController')->update($recordId);
        }

        if ($user->hasPermission('ap_tender_is_tenant')) {
            $tenant = Tenant::where('user_id', $user->id)->first();

            if (empty($tenant)) {
                return Redirect::to(Backend::url('ap/tender/tenants'));
            }


            return Redirect::to(Backend::url('ap/tender/tenantlegals/update/' . $tenant->id));
        }

        return Redirect::to(Backend::url('backend'));
    }
}
