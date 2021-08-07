<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Company;
use Ap\Tender\Models\Verification;
use Backend\Classes\Controller;
use Backend\Facades\Backend;
use Backend\Facades\BackendMenu;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Response;

class OnVerificationTenants extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController'
    ];

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'ap_tender_is_legal',
        'ap_tender_is_commercial',
        'ap_tender_is_finance',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'verification-tenants', 'on-verification-tenants');
    }

    public function index_onDelete()
    {
        return Response::make(View::make('backend::access_denied'), 403);
    }

    public function extendQuery($query)
    {
        $user = $this->user;
        return $query->whereIn('status', ['register', 'pre_evaluated']);
    }

    public function listExtendQuery($query)
    {
        return $this->extendQuery($query);
    }


    public function listOverrideRecordUrl($record, $definition = null)
    {

        $user = $this->user;

        if ($record->status == 'pre_evaluated') {
            if ($user->hasPermission('ap_tender_is_commercial')) {
                return 'ap/tender/onverificationlasts/update/' . $record->id;
            }
        }

        if ($record->status == 'register') {
            if ($user->hasPermission('ap_tender_is_legal')) {
                return 'ap/tender/onverificationlegals/update/' . $record->id;
            }
            if ($user->hasPermission('ap_tender_is_finance')) {
                return 'ap/tender/onverificationfinances/update/' . $record->id;
            }
            if ($user->hasPermission('ap_tender_is_commercial')) {

                return 'ap/tender/onverificationcommercials/update/' . $record->id;
            }
        }

        return ['clickable' => false];
    }
}
