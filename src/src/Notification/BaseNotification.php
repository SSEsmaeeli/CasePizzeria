<?php

namespace App\Notification;

use App\NotificationChannel\EmailChannel;
use App\NotificationChannel\SlackChannel;
use App\NotificationChannel\SmsChannel;

abstract class BaseNotification
{
    private array $channelMap = [
        'sms' => SmsChannel::class,
        'email' => EmailChannel::class,
        'slack' => SlackChannel::class
    ];

    private array $channels = [];

    private array $data = [];

    protected string $message = '';

    protected array $preferredChannelStrings = ['sms'];


    abstract public function setPreferredChannelStrings();

    public function __construct()
    {
        $this->handleConfigs();
    }

    public function getChannels(): array
    {
        return $this->channels;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    protected function setMessage(): void
    {
        $this->message = '';
    }

    public function getData(): array
    {
        return $this->data;
    }

    protected function setData(): void
    {
        $this->data = method_exists($this, 'withMoreData') && is_array($this->withMoreData()) && count($this->withMoreData()) ?
            $this->withMoreData() : [];
    }

    private function setChannelClasses(): void
    {
        foreach ($this->preferredChannelStrings as $channelClassNameString) {
            if($this->EnsureClassNameStringExistsInChannelMap($channelClassNameString)) {
                $this->pushToChannel($this->channelMap[$channelClassNameString]);
            }
        }
    }

    private function EnsureClassNameStringExistsInChannelMap($channelClassNameString): bool
    {
        return isset($this->channelMap[$channelClassNameString]);
    }

    private function pushToChannel($channelClassName): void
    {
         $this->channels[] = $channelClassName;
    }

    private function handleConfigs(): void
    {
        $this->setPreferredChannelStrings();
        $this->setChannelClasses();
        $this->setMessage();
        $this->setData();
    }
}