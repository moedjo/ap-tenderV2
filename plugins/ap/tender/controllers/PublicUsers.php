<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use Backend\Models\UserRole;
use Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Response;
use October\Rain\Support\Facades\Flash;

class PublicUsers extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController',
    ];

    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [];

    public $publicActions = [
        'create', 'success', 'validate'
    ];

    public function __construct()
    {
        $this->layout = 'public/default';
        parent::__construct();
    }


    public function index_onDelete()
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }
    public function update_onDelete($recordId = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function update($context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function preview($recordId = null, $context = null)
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }


    public function formExtendModel($model)
    {

        $tenant_id = Session::get('tenant_id');

        $tenant = Tenant::findOrFail($tenant_id);

        $context = $this->formGetContext();
        if ($context == 'create') {
            $model->email = $tenant->email;

            $parts = explode(" ", $tenant->contact_full_name);
            $lastname = array_pop($parts);
            $firstname = implode(" ", $parts);

            $model->name = $tenant->name;
            $model->first_name = $firstname;
            $model->last_name = $lastname;
        }
    }

    public function create($context = null)
    {

        $token = input('token');
        $tenant = Tenant::where('token', $token)
            ->orderBy('updated_at', 'DESC')
            ->first();

        if (isset($tenant)) {
            if ($tenant->status == 'pre_register') {
                Session::put('tenant_id', $tenant->id);
                Flash::success(e(trans('ap.tender::lang.tenant.token_activation_success')));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }

        return $this->asExtension('FormController')->create($context);
    }

    public function formBeforeCreate($model)
    {
        $role = UserRole::where('code', 'tenant')->first();
        $model->role()->associate($role);

    }


    public function formAfterCreate($model)
    {

        $tenant_id = Session::get('tenant_id');
        $tenant = Tenant::findOrFail($tenant_id);

        $tenant->token = null;
        $tenant->token_url = null;
        $tenant->status = 'register';
        $tenant->user()->associate($model);
        $tenant->save();

        Event::fire('tenant.register', [$tenant]);
        Session::forget('tenant_id');
    }

    public function success()
    {
        $this->pageTitle = 'ap.tender::lang.tenant.user_registration';
    }
}
