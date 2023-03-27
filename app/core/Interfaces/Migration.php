<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface Migration
{
    # Run migration
    public function up();

    # Rollback migration
    public function down();
}
