<?php

namespace app\core\Rules;

interface Rule
{
    public function getMessage();

    public function rule();
}