<?php namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Finance extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenant_finances';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'year' => 'required|numeric|between:1970,2022',
        // 'total_income' => 'required|numeric',
        'doc_finance' => 'required',
    ];


    public $attachOne = [
        'doc_finance' => ['System\Models\File', 'public' => false]
    ];

    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];

    protected $revisionable = [
        'year', 'total_income', 'tenant_id',
    ];

    public $revisionableLimit = 500;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }


    public function getYearOptions()
    {
        $year = [];
        for ($x = date('Y'); $x >= date('Y', strtotime('-10YEARS')); $x--) {
            $year[$x] = $x;
        }
        return $year;
    }
}
