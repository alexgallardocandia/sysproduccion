<?php

return [
    //General
    'type_condition' => [
        1 => 'CONTADO', 
        2 => 'CREDITO'
    ],
    //Usuarios
    'users-status' => [
        1 => 'Activo',
        0 => 'Inactivo',
    ],
    'users-status-label' => [
        1 => 'primary',
        0 => 'danger',
    ],
    //Timbrados
    'timbrado-status' => [
        1 => 'Activo',
        0 => 'Vencido',
    ],
    'timbrado-status-label' => [
        1 => 'primary',
        0 => 'danger',
    ],
    'timbrado-type' => [
        1 => 'Compra',
        2 => 'Venta',
    ],
    'timbrado-type-label' => [
        1 => 'primary',
        2 => 'warning',
    ],
    //Pedidos de Compras
    'pedidos-compras-prioridad' => [
        1 => 'Alta',
        2 => 'Media',
        3 => 'Baja',
    ],
    'pedidos-compras-prioridad-label' => [
        1 => 'danger',
        2 => 'warning',
        3 => 'primary',
    ],
    'pedidos-compras-status' => [
        1 => 'Pendiente',
        2 => 'Presupuestado',
        3 => 'Rechazado',
        4 => 'Completado',
    ],
    'pedidos-compras-status-label' => [
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
        4 => 'secondary'
    ],
    //Presupuestos de Compras
    'presupuestos-compras-status' => [
        1 => 'Pendiente',
        2 => 'Aprobado',
        3 => 'Rechazado',
    ],
    'presupuestos-compras-status-label' => [
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
    ],
    'presupuestos-compras-detalles-status' => [
        1 => 'Pendiente',
        2 => 'Aprobado',
        3 => 'Rechazado',
    ],
    'presupuestos-compras-detalles-status-label' => [
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
    ],
    //MATERIAS PRIMAS
    'materias-primas-tipos'  => [
        1 => 'PERECEDEROS',
        2 => 'NO PERECEDEROS',
    ],
    'tipo-descuento' => [
        1 => 'GUARANIES',
        2 => 'PORCENTAJE'
    ],
    //ORDEN DE COMPRAS
    'orden-compras-status' => [  
        1 => 'PENDIENTE',
        2 => 'AUTORIZADO',
        3 => 'RECHAZADO',
    ],
    'orden-compras-status-label' => [  
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
    ],
    //COMPRAS
    'compras-status' => [  
        1 => 'PENDIENTE',
        2 => 'AUTORIZADO',
        3 => 'RECHAZADO',
    ],
    'compras-status-label' => [  
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
    ],
    //COMPRAS
    'compra-cuotas-status' => [  
        1 => 'PENDIENTE',
        2 => 'PAGADO',
        3 => 'ANULADO',
    ],
    'compra-cuotas-status-label' => [  
        1 => 'warning',
        2 => 'primary',
        3 => 'danger',
    ],
];