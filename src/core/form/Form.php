<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin(string $action, string $method): void
    {
        echo sprintf("<form action='%s' method='%s'>", $action, $method);
    }

    public static function end(): void
    {
        echo "</form>";
    }

    public function field(Model $model, string $attribute): Field
    {
        return new Field($model , $attribute);
    }
}