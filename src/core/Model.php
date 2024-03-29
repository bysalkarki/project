<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

    public const RULE_UNIQUE = 'unique';

    public array $errors = [];

    public function loadData(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }

                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['min']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                if ($ruleName === self::RULE_MATCH && $value != $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }

                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare(
                        "SELECT * FROM $tableName WHERE $uniqueAttribute = :attr"
                    );
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }
        return empty($this->errors);
    }

    abstract public function rules(): array;

    public function addError(string $attribute, string $rule, array $params = []): void
    {
        $messages = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $messages = str_replace("{{$key}}", $value, $messages);
        }
        $this->errors[$attribute][] = $messages;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MAX => 'This field must be the same as {match}',
            self::RULE_UNIQUE => "Record with this {field} already exists"
        ];
    }


    public function hasErrors($attribute): bool
    {
        return (bool)($this->errors[$attribute] ?? false);
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }

    public function printErrorMessage($attribute)
    {
        if(!$this->hasErrors($attribute)){
            return '';
        }

        return '<span class="text-danger">'.$this->getFirstError($attribute).'</span>';
    }


}