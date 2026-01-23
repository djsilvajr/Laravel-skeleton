<?php

return [
    'enabled' => filter_var(env('OTEL_ENABLED', true), FILTER_VALIDATE_BOOL),
];