<?php

namespace MercurySeries\FlashyBundle;

interface SessionStore
{
    public function flash(string $name, array $data): void;
}
