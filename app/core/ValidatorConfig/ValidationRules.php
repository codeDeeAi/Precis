<?php

declare(strict_types=1);

namespace App\Core\ValidatorConfig;

use Exception;

class ValidationRules
{
    protected array $ruleMethods = [];

    public function __construct()
    {
        $this->ruleMethods = $this->getMethods();
    }

    /**
     * Get Validation Rule Method
     * @param String $rule
     * @return Callable|Throwable 
     */
    public function getMethod(string $rule): callable
    {
        if (array_key_exists($rule, $this->ruleMethods)) {
            return $this->ruleMethods[$rule];
        }

        throw new Exception("$rule doesn't exist in validator", 500);
    }

    /**
     * Get All Validation Methods
     * @return Array ['rule' => function(){}]
     */
    private function getMethods(): array
    {
        return
            [
                'string' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_string($value)) ? true : false,
                        'error' => "$key is not a valid string"
                    ];
                },
                'empty' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (!empty($value)) ? true : false,
                        'error' => "$key must not be empty"
                    ];
                },
                'array' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_array($value)) ? true : false,
                        'error' => "$key should be an array"
                    ];
                },
                'boolean' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_bool($value)) ? true : false,
                        'error' => "$key should be a boolean"
                    ];
                },
                'integer' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_int($value)) ? true : false,
                        'error' => "$key should be a valid integer"
                    ];
                },
                'float' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_float($value)) ? true : false,
                        'error' => "$key should be a valid float data type"
                    ];
                },
                'object' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_object($value)) ? true : false,
                        'error' => "$key should be a valid object data type"
                    ];
                },
                'min' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = (strlen($value) >= (int) $options[0]) ? true : false;
                        $error = "$key: should not be less than $options[0] characters";
                    } else if (is_array($value)) {
                        $status = (count($value) >= (int) $options[0]) ? true : false;
                        $error = "$key: array length should not be less than $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value >= (int) $options[0]) ? true : false;
                        $error = "$key: should not be less than $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value >= (float) $options[0]) ? true : false;
                        $error = "$key: should not be less than $options[0]";
                    } else {
                        $status = ($value >= $options[0]) ? true : false;
                        $error = "$key: should not be less than $options[0]";
                    }
                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'max' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = (strlen($value) <= (int) $options[0]) ? true : false;
                        $error = "$key: should not be greater than $options[0] characters";
                    } else if (is_array($value)) {
                        $status = (count($value) <= (int) $options[0]) ? true : false;
                        $error = "$key: array length should not be greater than $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value <= (int) $options[0]) ? true : false;
                        $error = "$key: should not be greater than $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value <= (float) $options[0]) ? true : false;
                        $error = "$key: should not be greater than $options[0]";
                    } else {
                        $status = ($value <= $options[0]) ? true : false;
                        $error = "$key: should not be greater than $options[0]";
                    }
                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'in' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (in_array($value, explode(',', $options[0]))) ? true : false,
                        'error' => "$key doesn't exist in options"
                    ];
                },
                'not in' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (!in_array($value, explode(',', $options[0]))) ? true : false,
                        'error' => "$key doesn't exist in options"
                    ];
                },
                'numeric' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_numeric($value)) ? true : false,
                        'error' => "$key should be of numeric type"
                    ];
                },
                'file' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (is_file($value)) ? true : false,
                        'error' => "$key should be of file type"
                    ];
                },
                'lowercase' => function (string $key, string $value, array $options = []): array {
                    return [
                        'status' => (ctype_lower($value)) ? true : false,
                        'error' => "$key should be lowercase"
                    ];
                },
                'uppercase' => function (string $key, string $value, array $options = []): array {
                    return [
                        'status' => (ctype_upper($value)) ? true : false,
                        'error' => "$key should be uppercase"
                    ];
                },
                'email' => function (string $key, string $value, array $options = []): array {
                    return [
                        'status' => (filter_var($value, FILTER_VALIDATE_EMAIL)) ? true : false,
                        'error' => "$key is not a valid email"
                    ];
                },
                'uuid' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (preg_match("/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i", $value)) ? true : false,
                        'error' => "$key is not a valid UUID"
                    ];
                },
                'url' => function (string $key, mixed $value, array $options = []): array {
                    return [
                        'status' => (filter_var($value, FILTER_VALIDATE_URL)) ? true : false,
                        'error' => "$key is not a valid URL"
                    ];
                },
                'mime type' => function (string $key, mixed $value, array $options = []): array {
                    if (count($options) !== 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }

                    $accepted_file_types = explode(',', $options[0]);

                    if (is_file($value)) {
                        $content_type = mime_content_type($value);

                        if (in_array($content_type, $accepted_file_types)) {
                            $status = true;
                            $error = "";
                        } else {
                            $status = false;
                            $error = "$key should be of file formats: $options[0]";
                        }
                    } else {
                        $status = false;
                        $error = "$key should be of file type";
                    }

                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'greater than' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = ($value > (string) $options[0]) ? true : false;
                        $error = "$key: should be greater than $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value > (int) $options[0]) ? true : false;
                        $error = "$key: should be greater than $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value > (float) $options[0]) ? true : false;
                        $error = "$key: should be greater than $options[0]";
                    } else {
                        $status = ($value > $options[0]) ? true : false;
                        $error = "$key: should be greater than $options[0]";
                    }

                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'greater than or equal' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = ($value >= (string) $options[0]) ? true : false;
                        $error = "$key: should be greater than or equal to $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value >= (int) $options[0]) ? true : false;
                        $error = "$key: should be greater than or equal to $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value >= (float) $options[0]) ? true : false;
                        $error = "$key: should be greater than or equal to $options[0]";
                    } else {
                        $status = ($value >= $options[0]) ? true : false;
                        $error = "$key: should be greater than or equal to $options[0]";
                    }

                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'less than' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = ($value < (string) $options[0]) ? true : false;
                        $error = "$key: should be less than $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value < (int) $options[0]) ? true : false;
                        $error = "$key: should be less than $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value < (float) $options[0]) ? true : false;
                        $error = "$key: should be less than $options[0]";
                    } else {
                        $status = ($value < $options[0]) ? true : false;
                        $error = "$key: should be less than $options[0]";
                    }

                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                'less than or equal' => function (string $key, mixed $value, array $options = []): array {
                    if (!count($options) == 1) {
                        throw new Exception("Invalid rule format: $key", 500);
                    }
                    if (is_string($value)) {
                        $status = ($value <= (string) $options[0]) ? true : false;
                        $error = "$key: should be less than or equal to $options[0]";
                    } else if (is_int($value)) {
                        $status = ($value <= (int) $options[0]) ? true : false;
                        $error = "$key: should be less than or equal to $options[0]";
                    } else if (is_float($value)) {
                        $status = ($value <= (float) $options[0]) ? true : false;
                        $error = "$key: should be less than or equal to $options[0]";
                    } else {
                        $status = ($value <= $options[0]) ? true : false;
                        $error = "$key: should be less than or equal to $options[0]";
                    }

                    return [
                        'status' => $status,
                        'error' => $error
                    ];
                },
                // case ACCEPTED;
                // case ACCEPTED_IF;
                // case Active URL;
                // case After (Date);
                // case After Or Equal (Date);
                // case Alpha;
                // case Alpha Dash;
                // case Alpha Numeric;
                // case Confirmed;
                // case Current Passwordcase ;
                // case Date;
                // case Date Equals;
                // case Date Format;
                // case Declined;
                // case Declined If;
                // case Different;
                // case Digits;
                // case Digits Between;
                // case Dimensions (Image Files);
                // case Distinct;
                // case Doesnt Start With;
                // case Doesnt End With;
                // case Ends With;
                // case Enum;
                // case Exclude;
                // case Exclude If;
                // case Exclude Unless;
                // case Exclude With;
                // case Exclude Without;
                // case Exists (Database);
                // case Filled;
                // case Image (File);
                // case In Array;
                // case IP Address;
                // case JSON;
                // case MAC Address;
                // case Max Digits;
                // case MIME Types;
                // case MIME Type By File Extension;
                // case Min Digits;
                // case Missing;
                // case Missing If;
                // case Missing Unless;
                // case Missing With;
                // case Missing With All;
                // case Multiple Of;
                // case Not Regex;
                // case Password;
                // case Present;
                // case Prohibited;
                // case Prohibited If;
                // case Prohibited Unless;
                // case Prohibits;
                // case Regular Expression;
                // case Required;
                // case Required If;
                // case Required Unless;
                // case Required With;
                // case Required With All;
                // case Required Without;
                // case Required Without All;
                // case Required Array Keys;
                // case Same;
                // case Size;
                // case Sometimes;
                // case Starts With;
                // case Timezone;
                // case Unique (Database);
                // case ULID;
            ];
    }
}
