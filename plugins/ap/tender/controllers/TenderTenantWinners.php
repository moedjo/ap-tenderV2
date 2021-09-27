<?php

namespace Ap\Tender\Controllers;

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
        if ($context == 'update') {
            $id = $host->model->id;
            $tenderTenant = TenderTenant::where('tender_id', $id)->where('is_candidate_winner', 1)->where('is_winner', 1)->first();
            $this->vars['is_winner_selected'] = 0;
            if ($tenderTenant !== null) {
                $host->addFields([
                    'tender_tenant_winner' => [
                        'label' => 'Pemenang Tender',
                        'type'  => 'dropdown',
                        'options' => [
                            $tenderTenant->id => $tenderTenant->tenant->name
                        ],
                        'disabled' => true
                    ]
                ]);

                if ($host->model->doc_spk !== null) {
                    $tenderTenant = TenderTenant::where('tender_id', $id)->where('is_candidate_winner', 1)->where('is_winner', 1)->where('is_winner_publish', 1)->first();

                    if ($tenderTenant !== null) {
                        $this->vars['is_winner_selected'] = 2;
                    } else {
                        $this->vars['is_winner_selected'] = 1;
                    }
                }
            }
        }
    }

    public function formAfterSave($model)
    {
        $selected_winner = post('TenderTenantWinner[tender_tenant_winner]');
        foreach ($selected_winner as $winner) {
            $tenderTenant = TenderTenant::find($winner);
      
            if (!empty($selected_winner)) {
                $tenderTenant = TenderTenant::find($selected_winner);
                $tenderTenant->status = 'winner';
                $tenderTenant->is_winner = 1;
                $tenderTenant->save();
            } else {
                $tenderTenant = TenderTenant::where('tender_id', $model->id)->where('is_candidate_winner', 1)->where('is_winner', 1)->first();
                $tenderTenant->status = 'winner_publish';
                $tenderTenant->is_winner_publish = 1;
                $tenderTenant->save();
            }
        }
    }
}
