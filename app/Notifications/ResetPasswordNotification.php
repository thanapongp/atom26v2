<?php

namespace Atom26\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    protected $token;

    /**
     * An instance of user.
     * 
     * @var \Atom26\Accounts\User
     */
    protected $user;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('สวัสดีค่ะคุณ ' . $this->user->info->firstname)
            ->line('คุณได้รับ E-mail ฉบับนี้เนื่องจากคุณได้ทำการร้องขอให้รีเซ็ต Password')
            ->action('รีเซ็ต Password', url('password/reset', $this->token))
            ->line('Username ของคุณคือ: ' . $this->user->username)
            ->line('หากคุณไม่ได้ทำการร้องขอให้รีเซ็ต Password คุณไม่จำเป็นต้องกดปุ่มด้านบน');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
