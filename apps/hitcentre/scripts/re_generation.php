#!/usr/bin/php
<?php

$time1 = time();

require_once('../../../Orion.php');
require_once('../../../Orion/Vendor/Doctrine/Doctrine.php');
spl_autoload_register(array('Doctrine', 'autoload'));

	 $config = array(
		'project'	=> 'hitcentre',
		Orion::ATTR_ENV	=> Orion::ATTR_ENV_DEV
		);
try {
	$orion =	Orion::getInstance();
} catch( Exception $e )
{
	print $e->getMessage();
	print $e->getTraceAsString();
}
$manager = Doctrine_Manager::getInstance();

$manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);

$manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

$conn = Doctrine_Manager::connection('mysql://root:1123581321@localhost/hitcentre_dev','MainConn');

$conn->setCharset('utf8');
$conn->setCollate('utf8_general_ci');
 
 $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
 Doctrine::loadModels('../database/models');

Doctrine::dropDatabases($conn);
Doctrine::createDatabases($conn);
Doctrine::createTablesFromModels('../database/models');

Doctrine::generateYamlFromModels('../database/schemas/schema.yml', '../database/models');


Doctrine::loadData('../database/fixtures/data_models/ALL.yml');
//Doctrine::loadData('../database/fixtures/data_models/state.yml');
//Doctrine::loadData('../database/fixtures/data_models/city.yml');
//Doctrine::loadData('../database/fixtures/data_models/admin.yml');
//Doctrine::loadData('../database/fixtures/data_models/company.yml');
//Doctrine::loadData('../database/fixtures/data_models/config_portal.yml');
//Doctrine::loadData('../database/fixtures/data_models/config_school.yml');
//Doctrine::loadData('../database/fixtures/data_models/services.yml');
//Doctrine::loadData('../database/fixtures/data_models/resource.yml');
//Doctrine::loadData('../database/fixtures/data_models/role.yml');
//Doctrine::loadData('../database/fixtures/data_models/role_resource.yml');
//Doctrine::loadData('../database/fixtures/data_models/group.yml');
//Doctrine::loadData('../database/fixtures/data_models/user.yml');
//Doctrine::loadData('../database/fixtures/data_models/course.yml');
//Doctrine::loadData('../database/fixtures/data_models/responsible.yml');
//Doctrine::loadData('../database/fixtures/data_models/resp_rel.yml');
//Doctrine::loadData('../database/fixtures/data_models/pedagogic_student.yml');
//Doctrine::loadData('../database/fixtures/data_models/student.yml');

$time2 = time();

printf("\nBanco gerado em %d segundos.\n", ($time2 - $time1));





