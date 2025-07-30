<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Appointment;

class AppointmentCreatedClient extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];  // You can add 'database', 'sms', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Appointment is Scheduled')
            ->greeting('Hello ' . $notifiable->full_name)
            ->line('Your appointment for ' . $this->appointment->service->name . ' has been scheduled on ' . $this->appointment->scheduled_date . ' at ' . $this->appointment->start_time . '.')
            ->line('Thank you for choosing us!');
    }
}
