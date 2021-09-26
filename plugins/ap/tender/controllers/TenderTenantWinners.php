<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\TenderTenant;
use Backend\Classes\Controller;
use BackendMenu;

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

    public function formAfterSave($model)
    {
        $selected_winner = post('TenderTenantWinner[tender_tenant_winner]');

        foreach ($selected_winner as $winner) {
            $tenderTenant = TenderTenant::find($winner);
            $tenderTenant->is_winner = 1;
            $tenderTenant->save();
        }
    }
}
