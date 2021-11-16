<?php

namespace Ap\Tender\Models;

use Backend\Facades\BackendAuth;
use Model;

/**
 * Model
 */
class Schedule extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Revisionable;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_schedules';



    public $dates = [
        'date_start',
        'date_end',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'date_start' => 'required|date',
        'date_end' => 'required|date|after:date_start',
    ];


    public $morphTo = [
        'schedulable' => []
    ];

    protected $revisionable = ['name','date_start','date_end', 'schedulable_id'];
    public $revisionableLimit = 500;
    public function getRevisionableUser()
    {
        return BackendAuth::getUser();
    }

    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
    ];
}
