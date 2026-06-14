<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Partnership;

class PartnershipAccepted extends Notification
{
    use Queueable;

    public $partnership;

    public function __construct(Partnership $partnership)
    {
        $this->partnership = $partnership;
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
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $supplier = $this->partnership->supplier;
        return [
            'type' => 'partnership_accepted',
            'title' => 'Kerja Sama Diterima',
            'message' => 'Supplier ' . $supplier->nama_usaha . ' telah menerima permintaan kerja sama Anda.',
            'url' => route('sppg.partnerships.index'),
            'partnership_id' => $this->partnership->id,
        ];
    }
}
