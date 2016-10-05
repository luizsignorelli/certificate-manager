<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
	use Notifiable;

    public function routeNotificationForSlack(){
    	return 'https://hooks.slack.com/services/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';
    }
}
