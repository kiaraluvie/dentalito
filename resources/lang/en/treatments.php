<?php

return [
    // Titles
    'title_index' => 'Treatment List',
    'title_create' => 'Create Treatment',
    'title_edit' => 'Edit Treatment',
    'title_show' => 'Treatment Details',
    'title_delete' => 'Delete Treatment',

    // Fields
    'fields' => [
        'patient' => 'Patient',
        'dentist' => 'Dentist',
        'procedure' => 'Procedure',
        'description' => 'Description',
        'date' => 'Date',
        'price' => 'Price',
        'status' => 'Status',
    ],

    // Status
    'status' => [
        'pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'status_colors' => [
        'pending' => 'warning',
        'in_progress' => 'info',
        'completed' => 'success',
        'cancelled' => 'danger',
    ],

    // Placeholders & misc
    'no_treatments_found' => 'No treatments found.',
    'delete_confirm' => 'Are you sure you want to delete this treatment?',

    // Controller messages
    'created_success' => 'Treatment created successfully.',
    'updated_success' => 'Treatment updated successfully.',
    'deleted_success' => 'Treatment deleted successfully.',
];
