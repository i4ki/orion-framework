#!/usr/bin/php
<?php

require_once('../../../Orion/ORM/Doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));

$manager = Doctrine_Manager::getInstance();

$manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);

$manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

$conn = Doctrine_Manager::connection('mysql://root:1123581321@localhost/hitcentre_dev','MainConn');

$conn->setCharset('utf8');
$conn->setCollate('utf8_general_ci');
 
$manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
Doctrine::loadModels('../database/models');

/*
Doctrine::dropDatabases($conn);
Doctrine::createDatabases($conn);
Doctrine::createTablesFromModels('../database/models');
Doctrine::generateYamlFromModels('../database/schemas/schema.yml', '../database/models');
*/
//Doctrine::loadData('data/fixtures/Groups.yml');
Doctrine::dumpData('./allteste.yml');


