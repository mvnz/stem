<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\Log;

class MqttListenTrash extends Command
{
    /*protected $signature = 'mqtt:trash-listen
                            {--host=test.mosquitto.org}
                            {--port=1883}
                            {--topic=trash/+/telemetry}';
    protected $description = 'Listen trash telemetry dari MQTT broker';*/

    protected $signature = 'mqtt:trash-listen
                            {--host=broker.hivemq.com}
                            {--port=1883}
                            {--topic=trash/+/telemetry}';
    protected $description = 'Listen trash telemetry dari MQTT broker';

    public function handle()
    {
        $host   = $this->option('host');
        $port   = (int) $this->option('port');
        $topic  = $this->option('topic');
        $clientId = 'laravel-listener-'.substr(md5(uniqid('', true)), 0, 8);

        $settings = (new ConnectionSettings)
            ->setKeepAliveInterval(60)
            ->setUseTls(false);

        $mqtt = new MqttClient($host, $port, $clientId);
        $mqtt->connect($settings, true);

        $this->info("Connected to MQTT $host:$port, subscribing '$topic'...");
        $mqtt->subscribe($topic, function (string $topic, string $message) {
            try {
                $data = json_decode($message, true, 512, JSON_THROW_ON_ERROR);
                app(\App\Services\TrashIngestService::class)->ingest($data);
                $this->line("OK: $topic");
            } catch (\Throwable $e) {
                Log::error('MQTT ingest error: '.$e->getMessage(), ['topic'=>$topic,'payload'=>$message]);
                $this->error('ERR: '.$e->getMessage());
            }
        }, 0);

        $mqtt->loop(true); // blocking
        $mqtt->disconnect();
        return 0;
    }
}
