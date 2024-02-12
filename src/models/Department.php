<?php

namespace app\models;

use app\core\DbModel;

class Department extends DbModel
{

    public function tableName(): string
    {
        return 'department';
    }

    public function attributes(): array
    {
        return ['name'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED]
        ];
    }
}