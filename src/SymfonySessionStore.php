<?php

namespace MercurySeries\FlashyBundle;

use Symfony\Component\HttpFoundation\RequestStack;

class SymfonySessionStore implements SessionStore
{
    private $session;

    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    public function flash(string $name, array $data): void
    {
        $this->session->getFlashBag()->add($name, $data);
    }
}
