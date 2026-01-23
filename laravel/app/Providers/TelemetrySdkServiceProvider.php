<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenTelemetry\SDK\Sdk;
use OpenTelemetry\SDK\Trace\TracerProviderBuilder;
use OpenTelemetry\SDK\Trace\SpanProcessor\BatchSpanProcessorBuilder;
use OpenTelemetry\Contrib\Otlp\SpanExporter as OtlpSpanExporter;
use OpenTelemetry\Contrib\Otlp\OtlpHttpTransportFactory;
use OpenTelemetry\API\Globals;

class TelemetrySdkServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (!config('otel.enabled', env('OTEL_ENABLED', false))) {
            return;
        }

        $this->app->singleton('otel.sdk', function () {
            $endpoint = rtrim(env('OTEL_EXPORTER_OTLP_ENDPOINT', 'http://otel-collector:4318' ), '/') . '/v1/traces';
            $transport = (new OtlpHttpTransportFactory())->create($endpoint, 'application/x-protobuf');
            $exporter  = new OtlpSpanExporter($transport);
            $spanProcessor = (new BatchSpanProcessorBuilder($exporter))->build();


            $tracerProvider = (new TracerProviderBuilder())
                ->addSpanProcessor($spanProcessor)
                ->build();

            Sdk::builder()
                ->setTracerProvider($tracerProvider)
                ->buildAndRegisterGlobal();

            return $tracerProvider;
        });
    }

    public function boot(): void
    {
        if (!config('otel.enabled', env('OTEL_ENABLED', false))) {
            return;
        }

        $tracerProvider = $this->app->make('otel.sdk');
        $this->app->terminating(function () use ($tracerProvider) {
            $tracerProvider->shutdown();
        });
    }
}
