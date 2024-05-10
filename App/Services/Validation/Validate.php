<?php

namespace App\Services\Validation;

use App\Core\Request;

class Validate
{
    public static function validate($request, $rules)
    {
        $validator = new FormValidator($request);
        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $ruleItem) {
                if (!$validator->applyRule($field, $ruleItem)) {
                    break;
                }
            }
        }
        return $validator->getErrors();
    }
}
