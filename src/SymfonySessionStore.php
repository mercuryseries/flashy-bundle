<?php

namespace MercurySeries\FlashyBundle;

use Symfony\Component\HttpFoundation\Session\Session;

class SymfonySessionStore implements SessionStore
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function flash(string $name, array $data): void
    {
        $this->session->getFlashBag()->add($name, $data);
    }
}
