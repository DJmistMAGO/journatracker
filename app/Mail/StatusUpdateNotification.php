<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusUpdateNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $userName;
    public $itemType;
    public $itemTitle;
    public $status;
    public $remarks;
    public $datePublish;
    public $timePublish;
	public $publish_at;

    public function __construct(
        $userName,
        $itemType,
        $itemTitle,
        $status,
        $remarks = null,
        $datePublish = null,
        $timePublish = null,
		$publish_at = null
    ) {
        $this->userName = $userName;
        $this->itemType = $itemType;
        $this->itemTitle = $itemTitle;
        $this->status = $status;
        $this->remarks = $remarks;
        $this->datePublish = $datePublish;
        $this->timePublish = $timePublish;
		$this->publish_at = $publish_at;
		
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: ucfirst($this->itemType) . ' Status Update');
    }

    public function content(): Content
    {
        return new Content(

            view: 'spj-content.publication-management.email.email-status',
            with: [
                'userName' => $this->userName,
                'itemType' => $this->itemType,
                'itemTitle' => $this->itemTitle,
                'status' => $this->status,
                'remarks' => $this->remarks,
                'datePublish' => $this->datePublish,
                'timePublish' => $this->timePublish,
				'publish_at' => $this->publish_at,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
