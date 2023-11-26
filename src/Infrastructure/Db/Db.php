<?php
declare(strict_types=1);

namespace App\Infrastructure\Db;

class Db
{
    public const DSN = 'pgsql:host=127.0.0.1;dbname=postgres';
    public const USERNAME = 'postgres';
    public const PASSWORD = 'postgres';
}