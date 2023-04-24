<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Traits\Utils\CommonHelpers;
use App\Core\ValidatorConfig\ValidationRules;
use Exception;

/**
 * Class Validator
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Validator
{
    use CommonHelpers;

    protected array $body = [];
    protected array $errors = [];
    protected array $validated = [];
    protected ValidationRules $config;

    public function __construct(
        protected Request $request,
        protected array $rules
    ) {
        $this->request = $request;
        $this->rules = $rules;
        $this->config = new ValidationRules();
        $this->body = $request->getBody();
    }

    /**
     * Validate
     * @param Boolean $handleErrors defaults false
     * @return Array [validated, errors]
     */
    public function validate(bool $handleErrors = false): array
    {
        $this->checkRules();

        if ($handleErrors && !empty($this->errors)) {
            ## Handle Errors / Throw exception errors
            $response = new Response();
            $response
                ->setHeaders([
                    'Content-Type: application/json; charset=utf-8'
                ])
                ->setStatusCode(422)
                ->toJson($this->errors);
        } else {
            return [
                'validated' => $this->validated,
                'errors' => $this->errors
            ];
        }
    }

    // private function getRequestBody(): void
    // {
    //     $req_method = $this->request->getMethod($toLowerCase = true);

    //     $this->body = match($req_method){
    //         'post' => $this->request->getBody()
    //     };
    // }

    /**
     * Check Rules
     * @return Void
     */
    private function checkRules(): void
    {
        foreach ($this->rules as $rule_name => $value) {

            if (!is_array($value) && !is_string($value)) {
                throw new Exception("$rule_name - rules should be an array or string", 500);
            }

            $arrayRules = (is_string($value)) ? explode(',', $value) : $value;

            if (
                in_array('nullable', $arrayRules) &&
                !array_key_exists($rule_name, $this->body)
            ) {
                ## Skip Validation
            } else {
                if (
                    in_array('nullable', $arrayRules)
                    && array_key_exists($rule_name, $this->body)
                ) {
                    unset($arrayRules['nullable']);
                }

                foreach ($arrayRules as $rule) {
                    $this->validateRule($rule_name, $rule);
                }
            }
        }
    }

    /**
     * Validate Each Item/Rule
     * @param String $req_key - key to be validated on request object e.g 'name'
     * @param String $rule - defined rule such as string or isArray or max:6
     */
    private function validateRule(string $req_key, string $rule)
    {
        if (array_key_exists($req_key, $this->body)) {
            $rule_decode = $this->decodeRule($rule);
            $function = $this->config->getMethod($rule_decode['rule']);
            $result = call_user_func_array($function, [
                'key' => $req_key,
                'value' => $this->body[$req_key],
                'options' => $rule_decode['options']
            ]);

            if (
                isset($result['status'])
                && $result['status'] === true
            ) {
                ## Add to validated
                $this->addToValidated($req_key);
            } else {
                ## Add to error bag
                $this->updateErrorBag(
                    $key = $req_key,
                    $error = $result['error'] ?? "Failed to validate $req_key against Rule:$rule on request"
                );
            }
        } else {
            ## Add to error bag
            $this->updateErrorBag(
                $key = $req_key,
                $error = "$req_key is required!"
            );
        }
    }

    /**
     * Add to errors
     * @param String $key
     * @param Mixed $error
     * @return Void
     */
    private function updateErrorBag(string $key, mixed $error): void
    {
        $this->errors[$key][] = $error;
    }

    /**
     * Add to Validated bag
     * @param String $key
     * @return Void
     */
    private function addToValidated(string $key): void
    {
        $this->validated[$key] = $this->body[$key];
    }

    /**
     * Decode Rule and Options
     * @param String $rule
     * @return array
     */
    private function decodeRule(string $rule): array
    {
        $rule_array = explode('~:~', $rule);

        return [
            'rule' => $rule_array[0],
            'options' => (isset($rule_array[1])) ? [$rule_array[1]] : []
        ];
    }
}
