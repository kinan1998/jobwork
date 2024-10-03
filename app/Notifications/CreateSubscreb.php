<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateSubscreb extends Notification
{
    use Queueable;

    public $Subscription;
    /**
     * Create a new notification instance.
     */
    public function __construct($subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

 

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable,): array
    {
        return [
            'message' => 'A new subscription has been created',
            'subscription_id' => $this->subscription->id,
            'payment_type' => $this->subscription->payment_type,
            'name_company' => Auth::user()->name_company,
         

        ];
    }
}
