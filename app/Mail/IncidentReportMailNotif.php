<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IncidentReportMailNotif extends Mailable
{
    use Queueable, SerializesModels;

	public $studentName;
	public $status;
	public $description;

    /**
     * Create a new message instance.
     */
    public function __construct($studentName, $status, $description)
    {
        $this->studentName = $studentName;
        $this->status = $status;
        $this->description = $description;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SPJ | Report A Problem Status Update',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'spj-content.incident-report.email.email-status',
			with: [
				'studentName' => $this->studentName,
				'status' => $this->status,
				'description' => $this->description,
			],
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
