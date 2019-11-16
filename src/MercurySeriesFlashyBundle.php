<?php

namespace MercurySeries\FlashyBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use MercurySeries\FlashyBundle\DependencyInjection\MercurySeriesFlashyExtension;

class MercurySeriesFlashyBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new MercurySeriesFlashyExtension;
        }

        return $this->extension;
    }
}
