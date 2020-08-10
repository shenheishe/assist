<?php
/**
 * laravel错误日志通知
 */

namespace Shenheishe\Assist;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Shenheishe\Assist\Src\Mail\ErrorMail;

class ErrorReport
{
    protected $emails = [];

    public function send(Request $request, Exception $exception)
    {
        $bool = env('MAIL_DRIVER') && env('MAIL_HOST') && env('MAIL_USERNAME') && env('MAIL_PORT') && env('MAIL_PASSWORD');
        if (!$bool) {
            Log::debug('系统未配置邮件发送环境，无法发送系统异常信息');
            return false;  //未配置邮件发送环境
        }

//        return view('assist::error_reporter_mail',[
//            'url'=>$request->url(),
//            'method' => $request->method(),
//            'input' => $request->input(),
//            'header' => $request->header(),
//            'content' => ''
//        ]);

        $emails = config('assist.error_receiver_emails');
        if (!count($emails)) return;
        Mail::to($emails)->send(new ErrorMail(
            $request->url(),
            $request->method(),
            $request->input(),
            $request->header(),
            $exception
        ));
    }
}