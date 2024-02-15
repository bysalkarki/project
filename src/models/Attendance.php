<?php

namespace app\models;

use app\core\DbModel;

class Attendance extends DbModel
{
    public string $employee_id = '';
    public string $attendance_date = '';
    public string $status = '';

    public static function tableName(): string
    {
        return 'attendance';
    }

    public function attributes(): array
    {
        return ['employee_id', 'attendance_date', 'status'];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'employee_id' => [self::RULE_REQUIRED],
            'attendance_date' => [self::RULE_REQUIRED],
        ];
    }
}