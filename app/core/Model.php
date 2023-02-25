<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\Model as InterfacesModel;
use Exception;

/**
 * Class Model
 * 
 * @author Adeola Bada <dunsin.bada@gmail.com>
 * @package App\Core
 */
class Model implements InterfacesModel
{
    protected string $table = '';
    protected array $columns = [];

    /**
     * Set Model Properties
     * @param Array $properties
     * @return void
     */
    protected function setProperties(array $properties): void
    {
        if (isset($properties['TABLE']) && is_string($properties['TABLE'])) {
            $this->table = $properties['TABLE'];
        }
        if (isset($properties['COLUMNS']) && is_array($properties['COLUMNS'])) {
            $this->columns = $properties['COLUMNS'];
        }
    }

    /**
     * Get Model Properties
     * @param String $property
     * @return Mixed
     */
    public function getProperty(string $property): mixed
    {
        $property = strtolower($property);
        if (!in_array(
            $property,
            ['table', 'columns']
        )) {
            throw new Exception("$property not found in model", 500);
        }

        return match ($property) {
            'table' => $this->table,
            'columns' => $this->columns,
            default => NULL
        };
    }
}
