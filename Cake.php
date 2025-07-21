<?php

final class Cake
{
    public function __construct(private int $candels)
    {
    }

    public function serve(): void
    {
        if ($this->candels > 0) {
            echo "Whoops! The cake is gone already!\n";
        }
    }
}

$cake = new Cake(candels: 10);
$cake->serve();
