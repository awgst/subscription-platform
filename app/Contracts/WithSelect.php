<?php

namespace App\Contracts;

interface WithSelect
{
    public function select(array $with);
}