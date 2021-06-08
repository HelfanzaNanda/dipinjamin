<?php

namespace App\Traits;

use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\{OptionsBuilder, PayloadDataBuilder, PayloadNotificationBuilder};

trait FirebaseTrait {

    public function notification($message, $fcm_token)
    {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive(60 * 20);
        $notificationBuilder = new PayloadNotificationBuilder('dipinjamin');
        $notificationBuilder->setBody($message)->setSound('default');

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData(['a_data' => 'my_data']);
        $option = $optionBuilder->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();
        
        FCM::sendTo($fcm_token, $option, $notification, $data);
    }

}