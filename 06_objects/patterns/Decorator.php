<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 12/4/17
 * Time: 19:32
 */


interface INotifier
{
    public function send($message);
}

class EmailNotifier implements INotifier
{
    public function send($message)
    {
        mail($message['to'], $message['subject'], $message['content']);
    }
}

class SmsNotifier implements INotifier
{
    public function send($message)
    {
        // send SMS
    }
}


class NotificationLogger implements INotifier
{
    protected $notifier = null;

    public function __construct(INotifier $notifier)
    {
        $this->notifier = $notifier;
    }

    public function send($message)
    {
        Logger::log($message);
        $this->notifier->send($message);
    }
}


