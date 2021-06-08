<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnswerMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

        $this->text = $data['text'];
        $this->files = $data['files'];
        $this->email_from = $data['email_from'];
        $this->subject = $data['subject'];
        $this->house = $data['house'];

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail =  $this->from($this->email_from , $this->house)->bcc($this->email_from)->replyTo($this->email_from)->subject($this->subject)
            ->markdown('emails.answer')->with([
                'text' => $this->text,
            ]);
        $files = $this->files;

        if(count($files) > 0){
            foreach($files as $file_array){
                foreach ($file_array as $file) {
                    $mail->attach($file->getRealPath(),
                        [
                            'as' => $file->getClientOriginalName(),
                            'mime' => $file->getClientMimeType(),
                        ]);
                }
            }
        }
        return $mail;
    }
}
