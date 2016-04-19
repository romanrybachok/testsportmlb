<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected $_docRoot;

	/**
	 * generate registry
	 * @return Zend_Registry
	 */
	protected function _initRegistry()
	{
		$registry = Zend_Registry::getInstance();

		return $registry;
	}

	/**
	 * Init application configuration
	 *
	 * @return void
	 */
	public function _initConfig()
	{
		Zend_Registry::set('config', new Zend_Config($this->_application->getOptions(), true));
		Zend_Registry::set('env', $this->getEnvironment());
	}

	protected function _initPath()
	{
		$this->_docRoot = realpath(APPLICATION_PATH . '/../');
		Zend_Registry::set('docRoot', $this->_docRoot);
	}

	protected function _initLoaderResource()
	{
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
				'basePath' => $this->_docRoot . '/application',
				'namespace' => 'Saffron'
			));
		$resourceLoader->addResourceTypes(array(
			'model' => array(
				'namespace' => 'Model',
				'path' => 'models'
			)
		));
	}

	protected function _initLog()
	{
		$writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/../data/logs/error.log');
		return new Zend_Log($writer);
	}

	protected function _initView()
	{
		$view = new Zend_View();
		return $view;
	}

	/**
	 * Initialize mysql adapter
	 * @return Zend_Db_Adapter_Pdo_Mysql
	 */
	public function _initAdapter()
	{

		$dbConfig = $this->getOption('db');

		$db = Zend_Db::factory('Pdo_Mysql', array(
			'host'     => $dbConfig['host'],
			'username' => $dbConfig['user'],
			'password' => $dbConfig['pass'],
			'dbname'   => $dbConfig['db'],
		));

		$registry = Zend_Registry::getInstance();
		$registry->set('adapter', $db);

		return $db;
	}

}