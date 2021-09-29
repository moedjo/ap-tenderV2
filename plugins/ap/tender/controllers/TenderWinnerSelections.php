<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;

class TenderWinnerSelections extends Controller
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
        BackendMenu::setContext('Ap.Tender', 'tender', 'tender-winnerselection');
    }

    public function formExtendFields($host, $fields)
    {
        $context = $host->getContext();
        $model = $host->model;
        if ($context == 'update') {
            if ($model->status == 'winner_selection') {
                // $fields['tenant_winners']->disabled = true;
            }
        }
    }

    public function extendQuery($query)
    {
   
        return $query->whereIn('status', ['aanwijzing','winner_selection']);
    }

    public function listExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formExtendQuery($query)
    {
        return $this->extendQuery($query);
    }

    public function formBeforeSave($model){
        $model->status = 'winner_selection';
    }
}
