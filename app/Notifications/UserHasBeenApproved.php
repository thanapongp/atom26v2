<?php

namespace Atom26\Notifications;

use Atom26\Accounts\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserHasBeenApproved extends Notification
{
    use Queueable;

    /**
     * An instance of user.
     * 
     * @var \Atom26\Accounts\User
     */
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @param \Atom26\Accounts\User $user
     * @return void
     */
    public function __construct(User $user)
    {
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
                    ->subject('ข้อมูลของคุณได้ถูกยืนยันยันแล้ว')
                    ->greeting('สวัสดีค่ะคุณ ' . $this->user->info->firstname)
                    ->line('ข้อมูลของคุณได้ถูกยืนยันยันแล้ว')
                    ->line('คุณสามารถเข้าระบบเพื่อแก้ไขข้อมูลส่วนตัวได้จนถึงวันที่ 15 มีนาคม พ.ศ. 2560 ได้ที่ลิงค์ข้างล่างค่ะ')
                    ->action('เข้าสู่ระบบ', 'http://tritharagames.sci.ubu.ac.th/login')
                    ->line('ขอบคุณที่ลงทะเบียนเข้าร่วมงานไตรธาราเกมส์ค่ะ');
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
