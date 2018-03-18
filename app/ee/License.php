<?php

namespace App\ee;

use App\Setting;
use Carbon\Carbon;

class License
{
    /**
     *
     */
    const ENCRYPTION_KEY = '.license_encryption_key.pub';

    /**
     *
     */
    const LICENSE_SETTING_KEY = 'WEBAPP_LICENSE';

    /**
     *
     */
    const LICENSE_FEATURES = [
        'Starter' => [
            'groups',
            'projects'
        ],
        'Premium' => [
            'epics'
        ],
        'Ultimate' => [
            'pages'
        ]
    ];

    /**
     * Do not merge with other licenses
     */
    const EARLY_ADOPTER = [
        'groups',
        'projects',
        'epics',
        'pages'
    ];

    /**
     * @param $license
     * @return mixed
     */
    protected static function featuresByLicense($license)
    {
        $starter = static::LICENSE_FEATURES['Starter'];
        $premium = array_merge($starter, static::LICENSE_FEATURES['Premium']);
        $ultimate = array_merge($premium, static::LICENSE_FEATURES['Ultimate']);

        $featuresByLicense = [
            'Starter' => $starter,
            'Premium' => $premium,
            'Ultimate' => $ultimate,
            'EarlyAdopter' => static::EARLY_ADOPTER
        ];

        return $featuresByLicense[$license];
    }

    /**
     * @return bool|mixed
     */
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

    /**
     * @return bool
     */
    public static function expired()
    {
        $license = self::import();

        // return true if license is expired
        if ($license->expires_at < Carbon::now()) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public static function isValid()
    {
        // return false if license is expired
        if (self::expired()) {
            return false;
        }

        return true;
    }

    /**
     * @param $feature
     * @return bool
     */
    public static function check($feature)
    {
        $license = self::import();

        // if there is no license return false
        if (false == $license) {
            return false;
        }

        // return false if license is expired
        if ($license->expires_at < Carbon::now()) {
            return false;
        }

        // If license is trial
        if ($license->type == 'Trial') {
            return true;
        }

        // Check if license has required features
        $featuresByLicense = self::featuresByLicense($license->type);
        if (!in_array($feature, $featuresByLicense)) {
            return false;
        }

        // else return true
        return true;
    }
}
