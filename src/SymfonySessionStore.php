<?php

namespace MercurySeries\FlashyBundle;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SymfonySessionStore implements SessionStore
{
    private $session;

    public function __construct(FlashBagInterface $session)
    {
        $this->session = $session;
    }

    public function flashy(string $name, array $data): void
    {
        $this->session->add($name, $data);
    }
}
