<?php

return [
    'debug' => true,
    'home'  => 'notes',
    'content' => [
        'locking'   => false,
        'extension' => 'md',
        'uuid'      => false
    ],
    'panel' => [
        'kirbytext' => false,
        'markdown'  => [
            'fileDragText' => function ($file, $url) {
                return '![' . $file->alt() . '](/' . $file->id() . ')';
            }
        ]
    ],
];
