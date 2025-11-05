<?php

return [
        // Titles
    'singular'        => 'Tenant',
    'plural'          => 'Tenants',

    // Columns
    'index_title'     => 'Tenants List',
    'create_title'    => 'Tenant - Create',
    'show_title'      => 'Tenant - Information',
    'edit_title'      => 'Tenant - Edit',
    'delete_title'    => 'Tenant - Delete',
    'edit_all_title'  => 'Tenant - Edit All',
    'id'              => 'No.',
    'name'            => 'Name',
    'logo'            => 'Logo',
    'is_active'       => 'Status',

    // Table headers for live edit
    'table_headers' => [
        'editable_name' => 'Name (editable)',
        'editable_status' => 'Status (editable)',
    ],

    // Export
    'export_filename' => 'tenants_export',
    'export_title'    => 'Tenants Report',

    // Validation messages
    // name
    'name_required' => 'The name field is required.',
    'name_unique'   => 'This tenant already exists.',

    // logo
    'logo_image' => 'The logo must be an image file.',
    'logo_mimes' => 'The logo must be a file of type: jpg, jpeg, png, webp.',
    'logo_max'   => 'The logo may not be greater than 2MB.',

    // is_active
    'is_active_required' => 'The status field is required.',

    // deletion
    'deleted_description_required' => 'The deletion reason is required.',
    'deleted_description_min'      => 'The deletion reason must be at least 3 characters.',
    'deleted_description_max'      => 'The deletion reason cannot exceed 1000 characters.',

    'api_key_generated_title'     => 'API Key Generated Successfully',
    'api_key_generated_message'   => 'Below is your new API key. Please copy and store it in a safe place. You will not be able to see it again.',
    'api_key_management_title'    => 'API Key Management',
    'api_key_explanation'         => 'API keys allow external applications to interact with this system on behalf of this tenant. The key must be sent in the Authorization header as a Bearer token.',
    'current_api_key'             => 'Current API Key',
    'no_api_key'                  => 'No API key has been generated yet.',
    'generate_api_key_confirm'    => 'Are you sure you want to generate a new API key? The old key will be immediately invalidated.',
    'generate_new_key'            => 'Generate New API Key',
    'api_key'                     => 'API Key',
    'view_api_key'                => 'View API Key',
    'hide_api_key'                => 'Hide API Key',
    'api_key_manager_title'       => 'Tenant - API Key',
    'manage_api_key'              => 'Manage API Key',
];