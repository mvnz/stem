<?php

namespace App\Notifications;

use App\Models\TrashReading;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrashBinThresholdExceeded extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public TrashReading $reading, public float $threshold) {}

    public function via($notifiable): array {
        return ['mail']; // tambah 'database' kalau mau
    }

    public function toMail($notifiable): MailMessage {
        return (new MailMessage)
            ->subject('Trash Bin Penuh: '.$this->reading->device_id)
            ->line('Device: '.$this->reading->device_id)
            ->line('Fill: '.$this->reading->fill_pct.'% (threshold '.$this->threshold.'%)')
            ->line('Distance: '.$this->reading->distance_cm.' cm')
            ->line('Measured at: '.$this->reading->measured_at->toDateTimeString())
            ->line('Payload disimpan di DB (tabel trash_readings).');
    }
}
