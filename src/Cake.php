<?php

declare(strict_types=1);


namespace Lendable\ComposerLicenseChecker;


final class Cake
{
    public function __construct(
        private int $candles,
    ) {
    }

    public function removeCandle(): void
    {
        if ($this->candles > 0) {
            $this->candles--;
        }
    }

    public function __toString(): string
    {
        return "The cake with {$this->candles} candles on the top.\n";
    }
}

$cake = new Cake(candles: 10);
$cake->removeCandle();

echo $cake;
