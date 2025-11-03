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
		$type = ucfirst(strtolower($this->item->type));
		$status = $this->item->status;
		$author = $this->item->author->name;
		$message = '';


		if ($notifiable->hasRole('student')) {
			if ($status == 'Submitted') {
				$message = "You have submitted your {$type} for review.";
			} else if ($status == 'Resubmitted') {
				$message = "You have resubmitted your {$type}.";
			} else if ($status == 'For Publish') {
				$message = "Your {$type} is now marked for publication.";
			} else if ($status == 'Published') {
				$message = "Your {$type} has been published!";
			} else if ($status == 'Revision') {
				$message = "Your {$type} requires revision.";
			} else if ($status == 'Rejected') {
				$message = "Your {$type} has been rejected.";
			} else if ($status == 'Scheduled') {
				$message = "Your {$type} has been scheduled for publication.";
			}
		}

		if ($status == 'Submitted' || $status == 'Resubmitted') {
			if ($notifiable->hasRole('teacher')) {
				if ($status == 'Submitted') {
					$message = "{$author} has submitted a new {$type} for review.";
				} else if ($status == 'Resubmitted') {
					$message = "{$author} has resubmitted their {$type}.";
				}
			}
		}

		if ($status == 'For Publish') {
			if ($notifiable->hasRole('admin')) {
				$message = "{$type} by {$author} is marked for publication.";
			}
		}

		// Return the same structure for all roles
		return [
			'type' => $type,
			'id' => $this->item->id,
			'status' => $status,
			'message' => $message,
			'created_at' => now(),
		];
	}


	public function toBroadcast($notifiable)
	{
		return new BroadcastMessage($this->toDatabase($notifiable));
	}
}
