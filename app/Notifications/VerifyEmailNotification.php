<?php 

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Créer une nouvelle notification
     */
    public function __construct()
    {
        //
    }

    /**
     * Canaux utilisés par la notification
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Représentation de l'e-mail
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bienvenue sur SELLIA - Vérifiez votre adresse e-mail')
            ->view('emails.auth.verify-email', [
                'user' => $notifiable,
                'verificationUrl' => $this->verificationUrl($notifiable),
            ]);
    }

    /**
     * Génère l'URL de vérification
     */
    protected function verificationUrl(object $notifiable): string
    {
        return url()->temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}