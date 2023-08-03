<?php

namespace app\core;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';

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
            }
        }
    }

    abstract public function rules(): array;

    public function addError(string $attribute, string $rule): void
    {
        $messages = $this->errorMessages()[$rule] ?? '';
        $this->errors[$attribute][] = $messages;
    }

    public function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_EMAIL => 'This field must be valid email address',
            self::RULE_MAX => 'This field must be the same as {match}'
        ];
    }


}