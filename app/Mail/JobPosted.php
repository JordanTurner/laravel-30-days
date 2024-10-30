<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;

class JobPosted extends Mailable
{
    use Queueable, SerializesModels;

    /* 
        inside your mailable calasees, you can define a public property to hold the data that you want to pass to the view. This property will be available in the view file as a variable with the same name as the property. In this case, the view file will have access to a $job variable passed to the constructor, but we can also define public properties for other data that we want to pass to the view, like below:

        public $foo = 'bar';

        if you don't want a variable to be available in the view, you can make it private or protected.

        public function __construct(protected Job $job)
        {
            //
        }
    
    */

    /**
     * Create a new message instance.
     */
    public function __construct(public Job $job)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        // you can override the default envelope settings here. Below is an example of how to overide from and replyTo fields. Default values are set in the mail.php config file (taken from env file).
        return new Envelope(
            subject: 'Job Posted',
            from: 'admin@trainingemail.com',
            replyTo: ['jturner@videotile.co.uk'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // if you only want to inject specific properties into the view, you can use the with array to specify those. This is useful if you want to pass additional data to the view that isn't defined as a public property on the mailable class. If the job was protected in the constructor, you could pass e.g. only the job title to the view like below:
        return new Content(
            view: 'mail.job-posted',
            // with: ['title' => $this->job->title]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
