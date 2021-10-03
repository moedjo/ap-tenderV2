<?php

namespace Ap\Tender\Models;

use Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'ap_tender_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';
}
