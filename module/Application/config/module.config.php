<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'application' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/application[/:action]',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'frayants' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/fray[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\FrayController::class,
                        'actions' => 'index',
                    ]
                ]
            ],
            'users' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/users[/:action[/:id]]',
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action' => 'index',
                    ]
                ]
            ],
            'add_comics' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/comics_list/add',
                    'defaults' => [
                        'controller' => Controller\ComicsController::class,
                        'action' => 'add',
                    ],
                ],
            ],
            'comics' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/comics_list',
                    'defaults' => [
                        'controller' => Controller\ComicsController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => Controller\ComicsController::class,
                                'action' => 'add',
                            ]
                        ]
                    ]
                ]
            ],
            'profile' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/profile[/:username]',
                    'constraints' => [
                        'username' => '[a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\UsersController::class,
                        'action' => 'index',
                        'custom_var' => 'something important'
                    ]
                ]
            ],
            
            // TODO: Implement all later.
            /*'blog' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/blog[/:action[/:slug]]',
                    'constraints' => [
                        'slug' => '[a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'news' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/news[/:action[/:slug]]',
                    'constraints' => [
                        'slug' => '[a-zA-Z0-9_-]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'tweets' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/tweets',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'stream' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/stream',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index'
                    ]
                ]
            ]*/
        ]
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => function($sm) {
                $usersService = $sm->get('Application\Model\UsersTable');
                return new Controller\IndexController($usersService);
            },
            Controller\UsersController::class => function($sm) {
                $postService = $sm->get('Application\Model\UsersTable');
                return new Controller\UsersController($postService);
            },
            Controller\ComicsController::class => function($sm) {
                return new Controller\ComicsController();
            },
            // TODO: Implement all modules properly.
            /*Controller\IndexController::class => function($sm) {
                $blogServices = $sm->get('Blog\Model\Table');
                return new Controller\IndexController();
            },
            Controller\IndexController::class => function($sm) {
                $newsService = $sm->get('News\Model\Table');
                return new Controller\IndexController();
            },
            Controller\IndexController::class => function($sm) {
                $tweetService = $sm->get('Tweet\Model\Table');
                return new Controller\IndexController();
            },
            Controller\IndexController::class => function($sm) {
                $frayService = $sm->get('Fray\Model\Table');
                return new Controller\IndexController();
            },
            Controller\IndexController::class => function($sm) {
                $liveStreamService = $sm->get('LiveStream\Model\Table');
                return new Controller\IndexController();
            }*/
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'base_url' => '/cupara',
    ],
];
