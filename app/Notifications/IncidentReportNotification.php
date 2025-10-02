<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class IncidentReportNotification extends Notification
{
    use Queueable;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'id' => $this->item->id,
            'status' => $this->item->status,
            'type' => $this->item->type,
            'message' => 'An incident report has been submitted.',
            'can_view' => $notifiable->hasRole(['admin', 'eic']),
        ];
    }
}
