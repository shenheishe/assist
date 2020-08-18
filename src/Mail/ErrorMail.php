<?php

namespace Shenheishe\Assist\Src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $method;
    protected $input;
    protected $userAgent;
    protected $message;
    protected $content;
    protected $code;
    protected $ip;


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
        $this->ip = $arr[7];
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
                'ip'         => $this->ip,
            ]);
    }
}
