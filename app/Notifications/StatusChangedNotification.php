<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class StatusChangedNotification extends Notification
{
	use Queueable;

	public $item;

	/**
	 * Create a new notification instance.
	 */
	public function __construct($item)
	{
		$this->item = $item;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array
	{
		return ['database', 'broadcast'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toDatabase($notifiable)
	{
		$isAdmin = $notifiable->hasAnyRole(['admin', 'eic']);

		return [
			'type' => $this->item->type,
			'id' => $this->item->id,
			'message' => $isAdmin
            ? "{$this->item->author->name} submitted {$this->item->type} for Publication"
            : "Your {$this->item->type} has been {$this->item->status} for Publication.",
			'created_at' => now(),
		];
	}

	public function toBroadcast($notifiable)
	{
		return new BroadcastMessage($this->toDatabase($notifiable));
	}
}
