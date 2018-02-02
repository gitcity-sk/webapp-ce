<?php

namespace App\ee;

use App\Setting;
use Carbon\Carbon;

class License
{
    const ENCRYPTION_KEY = '.license_encryption_key.pub';

    const LICENSE_SETTING_KEY = 'WEBAPP_LICENSE';

    const LICENSE_FEATURES = [
        'Starter' => [
            'epics',
            'groups'
        ],
        'Premium' => [
            'epics',
            'groups'
        ],
        'Ultimate' => [
            'epics',
            'groups'
        ]
    ];

    public static function import()
    {
        $licenseString = Setting::where('key', static::LICENSE_SETTING_KEY)->first();
        $decryptionKey = file_get_contents(base_path(self::ENCRYPTION_KEY));

        if ($licenseString) {
            openssl_public_decrypt(base64_decode($licenseString->value), $decrypted, $decryptionKey);
            
            $license = json_decode($decrypted);
            $license->started_at = Carbon::createFromTimestamp($license->started_at);
            $license->expires_at = Carbon::createFromTimestamp($license->expires_at);

            return $license;
        }

        return false;
    }

    public static function check($feature)
    {
        $license = self::import();

        if (false == $license) return false;

        if ($license->type == 'Trial') return true;

        $featuresByLicense = self::LICENSE_FEATURES[$license->type];

        if (!in_array($feature, $featuresByLicense)) return false;

        return true;
    }
}
