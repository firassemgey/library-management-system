<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function send(Request $request){
        $email['to'] = $request->email;
        $email['name'] = $request->name;
        $email['subject'] = $request->subject;
        $email['msg'] = $request->msg;
        SendEmailJob::dispatch($email);
    }
}
