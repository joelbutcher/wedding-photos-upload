<?php

namespace App\Concerns\Models;

/**
 * @property id
 */
trait HasId
{
    public function id(): string
    {
        return $this->id;
    }
}
