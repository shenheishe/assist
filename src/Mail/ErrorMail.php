<?php

namespace Shenheishe\Assist\Src\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Exception;

class ErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $url;
    protected $method;
    protected $input;
    protected $header;
    protected $content;


    public function __construct()
    {
        $arr = func_get_args();
        $this->url = $arr[0];
        $this->method = $arr[1];
        $this->input = $arr[2];
        $this->header = $arr[3];
        $this->content = $arr[4];
    }


    public function build()
    {
        return $this->subject('系统异常')
            ->view('assist::error_reporter_mail', [
                'url' => $this->url,
                'method' => $this->method,
                'input' => $this->input,
                'header' => $this->header,
                'content' => $this->content
            ]);
    }
}
