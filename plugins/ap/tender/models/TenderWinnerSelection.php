<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class TenderWinnerSelection extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tenders';

    /**
     * @var array Validation rules
     */ 
    public $rules = [];

    public $belongsTo = [
        'business_field' => [
            'Ap\Tender\Models\BusinessField',
            'key' => 'business_field_id',
        ],

        'airport' => [
            'Ap\Tender\Models\Airport',
            'key' => 'airport_id',
        ],
    ];

    public $hasMany = [];

    public $morphMany = [];

    public $belongsToMany = [];

    public $attachOne = [];

    public $attachMany = [];

    protected $jsonable = [
        'tender_winner_selection'
    ];

    public function getTenderWinnerSelectionOptions()
    {
        $tenantTenders = TenderTenant::all();
        $result = [];
        foreach ($tenantTenders as $tenant) {
            if ($this->id == $tenant->tender_id) {
                $result[$tenant->id] = [$tenant->invite_name];
            }
        }

        return $result;
    }

}