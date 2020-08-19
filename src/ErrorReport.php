<?php

/*
 * This file is part of the shenheishe/assist.
 *
 * (c) shenheishe <shenheishe@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Shenheishe\Assist;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Shenheishe\Assist\Src\Mail\ErrorMail;

class ErrorReport
{
    public function send(Request $request, Exception $exception)
    {
        $bool = env('MAIL_DRIVER')
            && env('MAIL_HOST')
            && env('MAIL_USERNAME')
            && env('MAIL_PORT')
            && env('MAIL_PASSWORD');

        if (!$bool) {
            Log::debug('系统未配置邮件发送环境，无法发送系统异常信息');
            return false;
        }

        $emails = config('assist.error_receiver_emails');
        if (!count($emails)) {
            return false;
        }

        return Mail::to($emails)->send(new ErrorMail(
            $request->url(),
            $request->method(),
            $request->input(),
            $request->userAgent(),
            $exception->getMessage(),
            $exception,
            $exception->getCode(),
            $request->getClientIp()
        ));
    }
}
