<?php

declare(strict_types=1);


namespace Lendable\ComposerLicenseChecker;


final class Cake
{
    public function __construct(
        private int $candles = 0,
    ) {
    }

    public function addCandle(): void
    {
        $this->candles++;
    }

    public function removeCandle(): void
    {
        $this->candles--;
    }

    public function __toString(): string
    {
        return "The cake with {$this->candles} candles on the top.\n";
    }
}

$cake = new Cake();
$cake->addCandle();
$cake->addCandle();
$cake->removeCandle();

echo $cake;
