<?php

namespace App\Http\Middleware;

use Closure;
use Throwable;
use OpenTelemetry\API\Globals;
use OpenTelemetry\Context\Context;

class TraceRequests
{
    public function handle($request, Closure $next)
    {
        if (!config('otel.enabled', false)) {
            return $next($request);
        }

        $tracer = Globals::tracerProvider()->getTracer('laravel-http' );
        $name = sprintf('%s %s', $request->getMethod(), $request->path() ?: '/');
        $span = $tracer->spanBuilder($name)
            ->setSpanKind(\OpenTelemetry\API\Trace\SpanKind::KIND_SERVER)
            ->startSpan();

        $scope = $span->activate();
        $span->setAttribute('http.method', $request->getMethod( ));
        $span->setAttribute('http.url', $request->fullUrl( ));
        $span->setAttribute('http.target', $request->getRequestUri( ));
        $span->setAttribute('service.name', config('app.name'));

        try {
            $response = $next($request);
            
            if (method_exists($response, 'getStatusCode')) {
                $status = $response->getStatusCode();
                $span->setAttribute('http.status_code', $status );
                
                if ($status >= 500) {
                    $span->setStatus(\OpenTelemetry\API\Trace\StatusCode::STATUS_ERROR);
                }
            }
            
            return $response;
        } catch (Throwable $e) {
            $span->recordException($e);
            $span->setStatus(\OpenTelemetry\API\Trace\StatusCode::STATUS_ERROR);
            throw $e;
        } finally {
            $span->end();
            $scope->detach();
        }
    }
}
