<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Event;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use October\Rain\Support\Facades\Flash;

class PublicTenantShortForms extends Controller
{
    public $implement = [
        'Backend\Behaviors\FormController'
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

    public function success()
    {
        $this->pageTitle = 'ap.tender::lang.tenant.short_form';
    }

    public function validate()
    {
        $this->pageTitle = 'ap.tender::lang.tenant.token_activation';
    }

    public function formBeforeCreate($model)
    {
        $model->token = Str::random(8);
        $model->token_url = Backend::url('ap/tender/publictenantshortforms/validate');
        $model->status = 'short_form';
    }

    public function onValidate()
    {
        $token = input('token');
        $tenant = Tenant::where('token', $token)
                ->orderBy('updated_at', 'DESC')
                ->first();
        if (isset($tenant)) {
            if ($tenant->status == 'short_form') {
                $last_update = strtotime(date('Y-m-d', strtotime($tenant->updated_at)));
                $exp_date = strtotime("+1days", $last_update);

                if ($exp_date >= strtotime(date('Y-m-d'))) {
                    Session::put('tenant_id', $tenant->id);
                    Flash::success(e(trans('ap.tender::lang.tenant.token_activation_success')));
                    return Redirect::to("backend/ap/tender/publictenantlegals/update/$tenant->id");
                }  else {
                    Flash::error(e(trans('ap.tender::lang.global.invalid_token')));
                }
            } else {
                Flash::error(e(trans('ap.tender::lang.global.invalid_token')));
            }
        } else {
            Flash::error(e(trans('ap.tender::lang.global.invalid_token')));
        }
    }

    public function formAfterCreate($model)
    {
        Event::fire('tenant.short_form', [$model]);
    }
}
