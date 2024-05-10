<?php
namespace App\Services\Validation;

class FormValidator {
    protected $data;
    protected $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function applyRule($field, $rule) {
        switch ($rule) {
            case 'required':
                if (empty($this->data[$field])) {
                    $this->errors[$field] = 'Field is required.';
                    return false;
                }
                break;
            case 'email':
                if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
                    $this->errors[$field] = 'Invalid email format.';
                    return false;
                }
                break;
        }
        return true;
    }

    public function getErrors() {
        return $this->errors;
    }
}