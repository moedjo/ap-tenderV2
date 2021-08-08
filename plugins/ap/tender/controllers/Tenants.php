<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;

use Backend\Classes\Controller;
use BackendMenu;
use Mail;
use Renatio\DynamicPDF\Classes\PDF;

class Tenants extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
    ];

    public $listConfig = 'config_list.yaml';

    public $requiredPermissions = [
        'ap_tender_access_tenants'
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ap.Tender', 'tenant', 'tenants');
    }

    public function test()
    {

        $tenant = Tenant::findOrFail(1);
        $tenant->load('verifications');
        $tenant->load('business_entity');
        $data = $tenant->toArray();
        return PDF::loadTemplate('ap.tender::pdf.tenant-reject', $data)
            ->stream();
    }
}