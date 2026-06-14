<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Partnership;

class PartnershipRequested extends Notification
{
    use Queueable;

    public $partnership;

    /**
     * Create a new notification instance.
     */
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
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $sppg = $this->partnership->procurementRequest->sppg;
        return [
            'type' => 'partnership_requested',
            'title' => 'Permintaan Kerja Sama Baru',
            'message' => $sppg->nama_sppg . ' telah mengirimkan permintaan kerja sama kepada Anda.',
            'url' => route('supplier.partnerships.index'),
            'partnership_id' => $this->partnership->id,
        ];
    }
}
