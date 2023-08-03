<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public string $attribute;
    public Model $model;

    public function __construct(Model $model, string $attribute)
    {
        $this->attribute = $attribute;
        $this->model = $model;
    }

    public function __toString(): string
    {
        return 'test';
    }
}