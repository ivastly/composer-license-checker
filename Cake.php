<?php

final class Cake
{
    public function __construct(private readonly int $candles)
    {
    }

    public function serve(): void
    {
        if ($this->candles === 0) {
            echo "Whoops! The cake is gone already!\n";
        }
    }
}

$cake = new Cake(candles: 10);
$cake->serve();
