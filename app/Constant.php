<?php

namespace App;

class Constant
{

    const ANDROID_OS_KEY = "Android";
    const IOS_OS_KEY = "ios";

    //Kabul edilen os değerleri buraya kaydedilebilir.
    const allowedOS = [
        self::ANDROID_OS_KEY,
        self::IOS_OS_KEY
    ];

    const WORKER_LIMIT = 1000;

}
