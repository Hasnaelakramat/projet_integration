<?php
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UserCredentialsNotification extends Notification
{
    
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $password = generateRandomPassword(); // Générez le mot de passe aléatoire

        return (new MailMessage)
            ->subject('Vos informations d\'identification')
            ->line('Voici vos informations d\'identification :')
            ->line('E-mail : ' . $notifiable->email)
            ->line('Mot de passe : ' . $password)
            ->line('Vous pouvez vous connecter à votre compte en utilisant ces informations.')
            ->line('Nous vous recommandons de modifier votre mot de passe après la première connexion.')
            ->line('Merci d\'utiliser notre application !');
    }
    function generateRandomPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $password;
}

}
