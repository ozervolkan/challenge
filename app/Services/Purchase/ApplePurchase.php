<?php

namespace App\Services\Purchase;

class ApplePurchase
{
    public function send(array $payload, $type=1)
    {
        $response['status'] = false;
        if (isset($payload['receipt'])) {
            if (is_numeric(substr($payload['receipt'], -1)) && substr($payload['receipt'], -1) % 2 != 0){
                $response['status'] = true;
                $response['expire_date'] = $this->getDateTime('Etc/GMT-6', 'Y-m-d H:i:s', rand(1,365)); //expire-date i rastgele bir gün veriyorum
            } else {
                if($type == 2){
                    if (is_numeric(substr($payload['receipt'], -2)) && substr($payload['receipt'], -1) % 6 == 0){
                        $response['status'] = false;
                        $response['errorMessage'] = 'rate-limit';
                    }
                }
            }
        } else {
            $response['errorMessage'] = 'receipt parameter is missing.';
        }
        return $response;
    }

    private function getDateTime($timezone, $format, $addDay) {
        $dt = new \DateTime('now +'.$addDay.' days');
        $dt->setTimezone(new \DateTimeZone($timezone));
        return $dt->format($format);
    }
}
