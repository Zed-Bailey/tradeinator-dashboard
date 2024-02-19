<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqService
{

    protected $connection;
    protected $exchange;

    public function __construct() {
        $this->exchange = env('RABBITMQ_EXCHANGE');
        error_log($this->exchange);

        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            'guest',
            'guest'
        );

        $this->channel = $this->connection->channel();

        $this->channel->exchange_declare($this->exchange, 'topic', false, false, false);

    }

    public function publish($message,  $routingKey)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, $this->exchange, $routingKey);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

}
