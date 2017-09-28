<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 20:13
 */

$salt = sha1('salt');

return [
    'salt' => $salt,
    'company' => 'Наша Компания',
    'menu' => [
        [
            'id' => 'products',
            'title' => 'Продукция',
        ],
        [
            'id' => 'contacts',
            'title' => 'Контакты',
        ]
    ],
    'pageIdParam' => 'page',

    'users' => [
        ['admin', sha1($salt.'123456')],
        ['user1', sha1($salt.'87654')],
    ]
];