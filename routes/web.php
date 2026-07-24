<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'API Soporte TI - Operativa',
        'version' => app()->version(),
        'documentation' => url('/api-docs'),
        'endpoints' => [
            'proveedores' => url('/api/proveedores'),
            'compras' => url('/api/compras'),
            'cotizaciones' => url('/api/cotizaciones'),
            'ofertas' => url('/api/ofertas'),
            'detalle-compras' => url('/api/detalle-compras'),
            'detalle-cotizaciones' => url('/api/detalle-cotizaciones'),
        ]
    ]);
});
