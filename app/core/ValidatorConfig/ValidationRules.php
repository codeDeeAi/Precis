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
                'string' => function (string $key, mixed $value): array {
                    return [
                        'status' => (is_string($value)) ? true : false,
                        'error' => "$key is not a valid string"
                    ];
                },
                'empty' => function (string $key, mixed $value): array {
                    return [
                        'status' => (!empty($value)) ? true : false,
                        'error' => "$key must not be empty"
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
                // case ARRAY;
                // case BOOLEAN;
                // case Confirmed;
                // case Current Passwordcase ;
                // case Date;
                // case Date Equals;
                // case Date Format;
                // case Decimal;
                // case Declined;
                // case Declined If;
                // case Different;
                // case Digits;
                // case Digits Between;
                // case Dimensions (Image Files);
                // case Distinct;
                // case Doesnt Start With;
                // case Doesnt End With;
                // case Email;
                // case Ends With;
                // case Enum;
                // case Exclude;
                // case Exclude If;
                // case Exclude Unless;
                // case Exclude With;
                // case Exclude Without;
                // case Exists (Database);
                // case File;
                // case Filled;
                // case Greater Than;
                // case Greater Than Or Equal;
                // case Image (File);
                // case In;
                // case In Array;
                // case Integer;
                // case IP Address;
                // case JSON;
                // case Less Than;
                // case Less Than Or Equal;
                // case Lowercase;
                // case MAC Address;
                // case Max;
                // case Max Digits;
                // case MIME Types;
                // case MIME Type By File Extension;
                // case Min;
                // case Min Digits;
                // case Missing;
                // case Missing If;
                // case Missing Unless;
                // case Missing With;
                // case Missing With All;
                // case Multiple Of;
                // case Not In;
                // case Not Regex;
                // case Nullable;
                // case Numeric;
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
                // case String;
                // case Timezone;
                // case Unique (Database);
                // case Uppercase;
                // case URL;
                // case ULID;
                // case UUID;
            ];
    }
}
