<?php

namespace App\Contract;

interface Parser
{
    public function parse(string  $link): array;

}
