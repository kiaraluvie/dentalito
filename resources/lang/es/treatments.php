<?php

return [
    // Titles
    'title_index' => 'Listado de Tratamientos',
    'title_create' => 'Crear Tratamiento',
    'title_edit' => 'Editar Tratamiento',
    'title_show' => 'Detalles del Tratamiento',
    'title_delete' => 'Eliminar Tratamiento',

    // Fields
    'fields' => [
        'patient' => 'Paciente',
        'dentist' => 'Dentista',
        'procedure' => 'Procedimiento',
        'description' => 'Descripción',
        'date' => 'Fecha',
        'price' => 'Precio',
        'status' => 'Estado',
    ],

    // Status
    'status' => [
        'pending' => 'Pendiente',
        'in_progress' => 'En Progreso',
        'completed' => 'Completado',
        'cancelled' => 'Cancelado',
    ],

    'status_colors' => [
        'pending' => 'warning',
        'in_progress' => 'info',
        'completed' => 'success',
        'cancelled' => 'danger',
    ],

    // Placeholders & misc
    'no_treatments_found' => 'No se encontraron tratamientos.',
    'delete_confirm' => '¿Estás seguro de que quieres eliminar este tratamiento?',

    // Controller messages
    'created_success' => 'Tratamiento creado correctamente.',
    'updated_success' => 'Tratamiento actualizado correctamente.',
    'deleted_success' => 'Tratamiento eliminado correctamente.',
];
