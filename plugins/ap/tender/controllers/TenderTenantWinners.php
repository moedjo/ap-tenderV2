<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Classes\MailHelper;
use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;
use Validator;
use Illuminate\Support\Facades\Redirect;
use October\Rain\Support\Facades\Flash;

class TenderTenantWinners extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'ap_tender_access_tenders'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tender', 'tender-tenantwinner');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;
        if ($context == 'update') {
            if ($model->status == 'closed') {
                $fields['tenant_winner']->disabled = true;
                $fields['doc_spk']->disabled = true;
                $fields['doc_winner_support']->disabled = true;
                
            }
        }
    }

    public function extendQuery($query)
    {

        return $query->whereIn('status', ['winner_selection', 'closed']);
    }

    public function listExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formBeforeSave($model)
    {
        $model->status = 'closed';
    }

    public function formAfterSave($model)
    {
    }
}
