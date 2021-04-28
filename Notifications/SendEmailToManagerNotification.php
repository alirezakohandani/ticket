<?php

namespace Modules\Ticketing\Notifications;

use Modules\Notifier\Services\Notification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Messages\MailMessage;

class SendEmailToManagerNotification extends Notification
{
    /**
     * Ticket tracking code
     *
     * @var int
     */
    protected $ref_number;



    /**
     * SendEmailToManagerNotification constructor.
     *
     * @param int  $ref_number
     * @param null $message
     */
    public function __construct(int $ref_number, $message = null)
    {
        $this->ref_number = $ref_number;
    }



    /**
     * @inheritdoc
     */
    public static function title()
    {
        return static::trans("title");
    }



    /**
     * @inheritdoc
     */
    public static function hasPermit($notifiable): bool
    {
        return $notifiable->isAdmin();
    }



    /**
     * @inheritdoc
     */
    public static function group()
    {
        return Notification::GROUP_GENERAL;
    }



    /**
     * @inheritdoc
     */
    public static function icon(): string
    {
        return Notification::ICON_GENERAL;
    }



    /**
     * get the mail representation of the notification.
     *
     * @param Notifiable $notifiable
     *
     * @return MailMessage
     */
    protected function toEmail($notifiable)
    {
        $subject = trans('ticketing::notifications.title');
        $msg     = trans('ticketing::notifications.notification.email', [
            'ref_number' => $this->ref_number,
        ]);


        return (new \Swift_Message($subject))
            ->setTo($notifiable->email)
            ->setBody($msg)
            ;


    }



    /**
     * get the translation of a phrase, from the array of the official trans file of this notification.
     *
     * @param string $phrase
     *
     * @return string
     */
    private static function trans(string $phrase)
    {
        return trans("ticketing::notifications.send_email_to_manager.$phrase");
    }

}

