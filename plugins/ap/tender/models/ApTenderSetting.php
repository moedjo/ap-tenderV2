<?php namespace Ap\Tender\Models;

use Url;
use File;
use Model;

class ApTenderSetting extends Model
{
  

    const SMALL_LOGO = '~/plugins/ap/tender/assets/images/small_logo.jpg';

    public static function getSmallLogo()
    {
        $logoPath = File::symbolizePath(self::SMALL_LOGO);

        if ($logoPath && File::exists($logoPath)) {
            return Url::asset(File::localToPublic($logoPath));
        }

        return null;
    }
}
