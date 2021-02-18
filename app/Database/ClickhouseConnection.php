<?php

declare(strict_types=1);

namespace App\Database;

use ClickHouseDB\Client;
use Illuminate\Support\Facades\Config;

class ClickhouseConnection
{
    private Client $client;

    /**
     * ClickhouseConnection constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $database = $config['database'] ?? null;
        unset($config['database']);
        $client = new Client($config);
        if ($database) {
            $client->database($database);
        }
        $this->client = $client;
    }

    /**
     * Named constructor for create instance of clickhouse connection
     * @return self
     */
    public static function create(): self
    {
        return new self(Config::get('database.connections.clickhouse'));
    }

    /**
     * Get clickhouse client
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}