<?php

namespace MercurySeries\FlashyBundle;

interface SessionStore
{
    public function flashy(string $name, array $data): void;
}
