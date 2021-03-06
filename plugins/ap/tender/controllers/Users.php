<?php

namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendAuth;
use Backend\Models\UserRole;
use BackendMenu;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use October\Rain\Support\Facades\Flash;

class Users extends Controller
{
    public $implement = ['Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $bodyClass = 'compact-container';

    public $requiredPermissions = [
        'ap_tender_access_users'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'master-data', 'users');
    }


    public function formExtendModel($model)
    {
        $context = $this->formGetContext();
        $user = $this->user;
        $branch = $user->branch;
        if ($context == 'create') {
            if ($user->isSuperUser()) {
                
            } else if (isset($branch)) {
                $model->branch = $branch;
            }
        }
    }


    /**
     * Extends the list query to hide superusers if the current user is not a superuser themselves
     */
    public function listExtendQuery($query)
    {
        $query->where('id', '!=', $this->user->id);
        if (!$this->user->isSuperUser()) {
            $query->where('is_superuser', false);
            if ($this->user->hasPermission([
                'is_supervisor'
            ])) {
                $query->whereHas('role', function ($query) {
                    $query->whereIn('code', ['operator', 'courier']);
                });
            }
        }
    }

    /**
     * Prevents non-superusers from even seeing the is_superuser filter
     */
    public function listFilterExtendScopes($filterWidget)
    {
    }

    /**
     * Strike out deleted records
     */
    public function listInjectRowClass($record, $definition = null)
    {
        if ($record->trashed()) {
            return 'strike';
        }
    }

    /**
     * Extends the form query to prevent non-superusers from accessing superusers at all
     */
    public function formExtendQuery($query)
    {

        $query->where('id', '!=', $this->user->id);
        if (!$this->user->isSuperUser()) {
            $query->where('is_superuser', false);

            if ($this->user->hasPermission([
                'is_supervisor'
            ])) {
                $query->whereHas('role', function ($query) {
                    $query->whereIn('code', ['operator', 'courier']);
                });
            }
        }
        // Ensure soft-deleted records can still be managed
        $query->withTrashed();
    }

    /**
     * Handle restoring users
     */
    public function update_onRestore($recordId)
    {
        $this->formFindModelObject($recordId)->restore();

        Flash::success(Lang::get('backend::lang.form.restore_success', ['name' => Lang::get('backend::lang.user.name')]));

        return Redirect::refresh();
    }


    /**
     * Unsuspend this user
     */
    public function update_onUnsuspendUser($recordId)
    {
        $model = $this->formFindModelObject($recordId);

        $model->unsuspend();

        Flash::success(Lang::get('backend::lang.account.unsuspend_success'));

        return Redirect::refresh();
    }

    /**
     * Impersonate this user
     */
    public function update_onImpersonateUser($recordId)
    {
        if (!$this->user->hasAccess('backend.impersonate_users')) {
            return Response::make(Lang::get('backend::lang.page.access_denied.label'), 403);
        }

        $model = $this->formFindModelObject($recordId);

        BackendAuth::impersonate($model);

        Flash::success(Lang::get('backend::lang.account.impersonate_success'));

        return Backend::redirect('backend/users/myaccount');
    }

    public function formExtendFields($host, $fields)
    {
        $user = $this->user;
        $context = $host->getContext();
        $model = $host->model;

        if (!$user->isSuperUser()) {
            $fields['branch']->disabled = true;
        }

        if ($context == 'create') {

        }

        if ($context == 'update') {
   
        }
    }
}
