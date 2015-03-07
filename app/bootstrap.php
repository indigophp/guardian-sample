<?php

/*
 * This file is part of the Indigo Guardian Test project.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'di' => [
        'controller' => [
            'class'     => 'Indigo\Guardian\Controller',
            'arguments' => ['app'],
        ],
        'Indigo\Guardian\Identifier\LoginTokenIdentifier' => [
            'class'     => 'Indigo\Guardian\Identifier\InMemory',
            'arguments' => [
                [
                    [
                        'id'       => 1,
                        'username' => 'john.doe',
                        'password' => 'secret',
                    ],
                ],
            ],
        ],
        'Indigo\Guardian\Authenticator' => [
            'class'     => 'Indigo\Guardian\Authenticator\UserPassword',
            'arguments' => ['hasher'],
        ],
        'hasher' => [
            'class' => 'Indigo\Guardian\Hasher\Plaintext',
        ],
        'Indigo\Guardian\Session' => [
            'class' => 'Indigo\Guardian\Session\Native'
        ],
    ],
];
