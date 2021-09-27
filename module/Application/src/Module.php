<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application;
use Application\Model\User;
use Application\Model\UsersTable;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig() : array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    // getServiceConfig() calls the Users table and adds it to the Service Manager
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'UsersTableGateway' => function($sm) {
                    $dbAdapter = $sm->get('Laminas\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    
                    // Get base URL from config
                    $config = $sm->get('Config');
                    $baseUrl = $config['view_manager']['base_url'];
                    
                    // Pass base URL view constructor to the User class
                    $resultSetPrototype->setArrayObjectPrototype(new User($baseUrl));
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'Application\Model\UsersTable' => function($sm) {
                    $tableGateway = $sm->get('UsersTableGateway');
                    $table = new UsersTable($tableGateway);
                    return $table;
                }
            )
        );
    }
}