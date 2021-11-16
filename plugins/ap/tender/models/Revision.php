<?php namespace Ap\Tender\Models;

use Model;

/**
 * Model
 */
class Revision extends Model
{


    public $table = 'system_revisions';

    public $belongsTo = [
        'user' => [
            'Backend\Models\User',
            'key' => 'user_id'
        ],
    ];
    
}
