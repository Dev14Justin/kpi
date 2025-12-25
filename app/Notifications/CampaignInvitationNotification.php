<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CampaignInvitationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public \App\Models\Campaign $campaign,
        public \App\Models\User $inviter
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Invitation à une campagne : '.$this->campaign->title)
            ->greeting('Bonjour '.$notifiable->name.' !')
            ->line($this->inviter->name.' vous a invité à rejoindre la campagne "'.$this->campaign->title.'".')
            ->action('Voir la campagne', route('campaigns.index'))
            ->line('Vous pouvez accepter ou refuser cette invitation depuis votre tableau de bord.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'campaign_id' => $this->campaign->id,
            'campaign_title' => $this->campaign->title,
            'inviter_name' => $this->inviter->name,
            'message' => $this->inviter->name.' vous a invité sur la campagne : '.$this->campaign->title,
        ];
    }
}
