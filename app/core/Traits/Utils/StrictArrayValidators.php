<?php

declare(strict_types=1);

namespace App\Core\Traits\Utils;

use Exception;

trait StrictArrayValidators
{
    /**
     * Validates Array to make sure child elements must be of specific type/types
     * @param Array $array
     * @param Array $types
     * @throws Exception
     * @return Void
     */
    public function childrenMustBeOfType(array $array, array $types): void
    {
        if(empty($array)){
            throw new Exception('Type Safety/childrenMustBeOfType: Array cannot be empty');
        }
        if(empty($types)){
            throw new Exception('Type Safety/childrenMustBeOfType: Types cannot be empty');
        }

        $allowed_types = ['string', 'integer', 'float', 'callable', 'boolean', 'array', 'null', 'object', 'callable'];

        foreach ($types as $type_value) {
            # code...
        }
        $bag = [];
        # code...
    }
}
