<?php
/*
 *  $Id: config.php 2753 2007-10-07 20:58:08Z Jonathan.Wage $
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the LGPL. For more information, see
 * <http://www.phpdoctrine.org>.
 */

/**
 * Doctrine Configuration File
 *
 * This is a sample implementation of Doctrine
 * 
 * @package     Doctrine
 * @subpackage  Config
 * @license     http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link        www.phpdoctrine.org
 * @since       1.0
 * @version     $Revision: 2753 $
 * @author      Konsta Vesterinen <kvesteri@cc.hut.fi>
 * @author      Jonathan H. Wage <jwage@mac.com>
 */

define('DOCTRINE_I4K', '/www/myFramework/Libs/Database/Doctrine');
define('SANDBOX_PATH', DOCTRINE_I4K . '/Sandbox');
define('DOCTRINE_PATH', SANDBOX_PATH . '/lib');
define('DATA_FIXTURES_PATH', DOCTRINE_I4K . '/data/fixtures');
define('MODELS_PATH', DOCTRINE_I4K . '/models');
define('MIGRATIONS_PATH', DOCTRINE_I4K . '/migrations');
define('SQL_PATH', DOCTRINE_I4K . '/data/sql');
define('YAML_SCHEMA_PATH', DOCTRINE_I4K . '/schemas');
define('DB_PATH', SANDBOX_PATH . '/sandbox.db');
//define('DSN', 'sqlite:///' . DB_PATH);
define('DSN', 'mysql://root:1123581321@localhost/hitcentre');

require_once(DOCTRINE_PATH . DIRECTORY_SEPARATOR . 'Doctrine.php');

spl_autoload_register(array('Doctrine', 'autoload'));

Doctrine_Manager::connection(DSN, 'connSandBox');

Doctrine_Manager::getInstance()->setAttribute('model_loading', 'conservative');
