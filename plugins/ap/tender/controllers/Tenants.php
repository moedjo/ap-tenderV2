<?php

namespace Ap\Tender\Controllers;

use Ap\Tender\Models\Tenant;
use Backend\Classes\Controller;
use Backend\Models\BrandSetting;
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

       
        // trace_log( $tenant->toArray()['verifications']);


        $data = $tenant->toArray();


        $data['logo'] = BrandSetting::getDefaultLogo();



        PDF::loadTemplate('ap.tender::pdf.tenant-reject',$data)
            ->setDpi(300)
            ->setDefaultFont('sans-serif')
            ->save(storage_path('temp/test.pdf'));



      

        Mail::queue('ap.tender::mail.tenant-reject', $tenant->toArray(), function ($message) use ($tenant) {
            $message->to($tenant->email, $tenant->name);

            $message->attach(storage_path('temp/test.pdf'));
        });


        $test = trans('Test :makan',['makan'=> 'indomie']);

        trace_log($test);
    }
}
