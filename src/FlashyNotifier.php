<?php

namespace MercurySeries\FlashyBundle;

class FlashyNotifier
{
    private $session;

    private $flashMessageName;

    public function __construct(SessionStore $session, string $flashMessageName = 'mercuryseries_flashy_notification')
    {
        $this->session = $session;

        $this->flashMessageName = $flashMessageName;
    }

    public function info(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'info');

        return $this;
    }

    public function success(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'success');

        return $this;
    }

    public function error(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'error');

        return $this;
    }

    public function warning(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'warning');

        return $this;
    }

    public function primary(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'primary');

        return $this;
    }

    public function primaryDark(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'primary-dark');

        return $this;
    }

    public function muted(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'muted');

        return $this;
    }

    public function mutedDark(string $message, ?string $link = '#'): self
    {
        $this->message($message, $link, 'muted-dark');

        return $this;
    }

    public function message(string $message, ?string $link = '#', ?string $type = 'success'): self
    {
        $this->session->flash($this->flashMessageName, compact('message', 'link', 'type'));

        return $this;
    }
}
