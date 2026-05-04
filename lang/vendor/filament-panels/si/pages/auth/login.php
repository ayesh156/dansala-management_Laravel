<?php

return [
    'title'   => 'පිවිසීම',
    'heading' => 'පද්ධතියට ඇතුළු වන්න',

    'actions' => [
        'register' => [
            'before' => 'හෝ',
            'label'  => 'ගිණුමක් ලියාපදිංචි කරන්න',
        ],
        'request_password_reset' => [
            'label' => 'මුරපදය අමතකද?',
        ],
    ],

    'form' => [
        'email' => [
            'label' => 'විද්‍යුත් තැපෑල',
        ],
        'password' => [
            'label' => 'මුරපදය',
        ],
        'remember' => [
            'label' => 'මතක තබා ගන්න',
        ],
        'actions' => [
            'authenticate' => [
                'label' => 'ඇතුළු වන්න',
            ],
        ],
    ],

    'messages' => [
        'failed' => 'ඇතුළත් කළ තොරතුරු නිවැරදි නොවේ.',
    ],

    'notifications' => [
        'throttled' => [
            'title' => 'ඉතා වැඩිපුර ලොගින් උත්සාහයන්',
            'body'  => 'තත්පර :seconds කින් නැවත උත්සාහ කරන්න.',
        ],
    ],
];
