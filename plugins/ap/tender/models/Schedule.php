<?php

namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class Schedule extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'ap_tender_tender_schedules';



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

    public $belongsTo = [
        'tender' => [
            'Ap\Tender\Models\Tender',
            'key' => 'tender_id'
        ],
    ];
}
