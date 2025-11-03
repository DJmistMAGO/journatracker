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
     * Get the database representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        $type = ucfirst(strtolower($this->item->type ?? 'Unknown'));
        $status = $this->item->status ?? 'Unknown';

        // Get author name - for incident reports use student_name, for articles use author
        $author = null;
        if (isset($this->item->student_name)) {
            // For Incident Reports
            $author = $this->item->student_name;
        } elseif (method_exists($this->item, 'author') && $this->item->author) {
            // For Articles/Media
            $author = $this->item->author->name;
        }
        $author = $author ?? 'Unknown';

        $message = '';

        // Handle Incident Reports
        if (strtolower($type) === 'incident report') {
            if ($notifiable->hasAnyRole(['admin', 'teacher'])) {
                if ($status == 'Pending') {
                    $message = "A new {$type} has been submitted by {$author} and is pending your review.";
                } elseif ($status == 'Under Review') {
                    $message = "The {$type} submitted by {$author} is currently under review.";
                } elseif ($status == 'Resolved') {
                    $message = "The {$type} submitted by {$author} has been resolved.";
                } elseif ($status == 'Rejected') {
                    $message = "The {$type} submitted by {$author} has been rejected.";
                }
            }
        }
        // Handle Articles/Media
        else {
            if ($notifiable->hasRole('student')) {
                if ($status == 'Submitted') {
                    $message = "You have submitted your {$type} for review.";
                } elseif ($status == 'Resubmitted') {
                    $message = "You have resubmitted your {$type}.";
                } elseif ($status == 'For Publish') {
                    $message = "Your {$type} is now marked for publication.";
                } elseif ($status == 'Published') {
                    $message = "Your {$type} has been published!";
                } elseif ($status == 'Revision') {
                    $message = "Your {$type} requires revision.";
                } elseif ($status == 'Rejected') {
                    $message = "Your {$type} has been rejected.";
                } elseif ($status == 'Scheduled') {
                    $message = "Your {$type} has been scheduled for publication.";
                }
            }

            if ($notifiable->hasRole('teacher')) {
                if ($status == 'Submitted') {
                    $message = "{$author} has submitted a new {$type} for review.";
                } elseif ($status == 'Resubmitted') {
                    $message = "{$author} has resubmitted their {$type}.";
                }
            }

            if ($notifiable->hasRole('admin')) {
                if ($status == 'For Publish') {
                    $message = "The EIC has marked {$author}'s {$type} for publication.";
                }
            }
        }

        // Return the same structure for all types
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