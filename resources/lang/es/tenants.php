<?php

return [
        // Titles
    'singular'        => 'Inquilino',
    'plural'          => 'Inquilinos',

    // Columns
    'index_title'     => 'Listado de Inquilinos',
    'create_title'    => 'Inquilino - Crear',
    'show_title'      => 'Inquilino - Información',
    'edit_title'      => 'Inquilino - Editar',
    'delete_title'    => 'Inquilino - Eliminar',
    'edit_all_title'  => 'Inquilino - Editar Todo',
    'id'              => 'N°',
    'name'            => 'Nombre',
    'logo'            => 'Logo',
    'is_active'       => 'Estado',

    // Table headers for live edit
    'table_headers' => [
        'editable_name' => 'Nombre (editable)',
        'editable_status' => 'Estado (editable)',
    ],

    // Export
    'export_filename' => 'exportación_inquilinos',
    'export_title'    => 'Reporte de inquilinos',

    // Validation messages
    // name
    'name_required' => 'El campo nombre es obligatorio.',
    'name_unique'   => 'Este Inquilino ya existe.',

    // logo
    'logo_image' => 'El logo debe ser un archivo de imagen.',
    'logo_mimes' => 'El logo debe ser un archivo de tipo: jpg, jpeg, png, webp.',
    'logo_max'   => 'El logo no puede superar los 2MB.',

    // is_active
    'is_active_required' => 'El campo estado es obligatorio.',

    // deletion
    'deleted_description_required' => 'El motivo de eliminación es obligatorio.',
    'deleted_description_min'      => 'El motivo de eliminación debe tener al menos 3 caracteres.',
    'deleted_description_max'      => 'El motivo de eliminación no puede superar los 1000 caracteres.',

    'api_key_generated_title'     => 'Clave de API Generada Exitosamente',
    'api_key_generated_message'   => 'A continuación se muestra su nueva clave de API. Por favor, cópiela y guárdela en un lugar seguro. No podrá volver a verla.',
    'api_key_management_title'    => 'Gestión de Clave de API',
    'api_key_explanation'         => 'Las claves de API permiten que aplicaciones externas interactúen con este sistema en nombre de este inquilino. La clave debe enviarse en el encabezado de Autorización como un token Bearer.',
    'current_api_key'             => 'Clave de API Actual',
    'no_api_key'                  => 'Aún no se ha generado ninguna clave de API.',
    'generate_api_key_confirm'    => '¿Está seguro de que desea generar una nueva clave de API? La clave anterior será invalidada inmediatamente.',
    'generate_new_key'            => 'Generar Nueva Clave de API',
    'api_key'                     => 'API KEY',
    'view_api_key'                => 'Ver Clave de API',
    'hide_api_key'                => 'Ocultar Clave de API',
    'api_key_manager_title'       => 'Inquilino - Clave de API',
    'manage_api_key'              => 'Administrar Clave de API',
];