<?php namespace Ap\Tender\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Revisions extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController'    ];
    
    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'ap_tender_audit_logs' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'audit-log');
    }
}
