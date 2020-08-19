<?php

/*
 * This file is part of the shenheishe/assist.
 *
 * (c) shenheishe <shenheishe@qq.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Shenheishe\Assist\Src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $url;
    protected $method;
    protected $input;
    protected $userAgent;
    protected $message;
    protected $content;
    protected $code;
    protected $userIp;
    protected $mailer;

    public function __construct()
    {
        $arr = func_get_args();
        $this->url = $arr[0];
        $this->method = $arr[1];
        $this->input = $arr[2];
        $this->userAgent = $arr[3];
        $this->message = $arr[4];
        $this->content = $arr[5];
        $this->code = $arr[6];
        $this->userIp = $arr[7];
    }

    public function build()
    {
        return $this->subject('系统异常')
            ->markdown('assist::error_reporter_mail', [
                'url'        => $this->url,
                'method'     => $this->method,
                'input'      => $this->input,
                'user_agent' => $this->userAgent,
                'message'    => $this->message,
                'content'    => $this->content,
                'code'       => $this->code,
                'ip'         => $this->userIp,
            ]);
    }

    public function mailer($mailer)
    {
        $this->mailer = $mailer;
    }
}
