<?php

return [
    'pages' => [
        'home' => [
            'name' => 'Home',
            'route' => '',
        ],
        'books' => [
            'name' => 'Books',
            'route' => 'books',
        ],
        'my-books' => [
            'name' => 'My Books',
            'route' => 'my-books',
            'permissions' => ['view my books'],
        ],
    ],
];
