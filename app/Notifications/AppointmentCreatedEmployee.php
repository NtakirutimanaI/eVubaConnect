<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Appointment;

class AppointmentCreatedEmployee extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Appointment Assigned')
            ->greeting('Hello ' . $notifiable->name)
            ->line('You have a new appointment for ' . $this->appointment->service->name . ' with client ' . $this->appointment->client->full_name . '.')
            ->line('Scheduled on ' . $this->appointment->scheduled_date . ' at ' . $this->appointment->start_time . '.');
    }
}
