<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use \MyModule\ExampleTable;

Loc::loadMessages(__FILE__);

if (class_exists('my_module')) {
    return;
}

class my_module extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'my.module';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2018-03-02 16:23:14';
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->PARTNER_NAME = "Павел Иовлев";
    }

    public function doInstall()
    {
	    if(!IsModuleInstalled('sprint.migration')){
            global $APPLICATION;
			$APPLICATION->ThrowException(Loc::getMessage('MODULE_ERROR_TO_INSTALL'));
		    return false;
	    }
	    CopyDirFiles(__DIR__ . '/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin', true, true);
        ModuleManager::registerModule($this->MODULE_ID);
        
       // $this->installDB();
    }

    public function doUninstall()
    {
	    DeleteDirFiles(__DIR__ . '/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');
        //$this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    /*
    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
	        //Если таблица не установлена, устанавливаем вручную.
	        if(!Application::getConnection(ExampleTable::getConnectionName())->isTableExists(ExampleTable::getTableName())){
		        ExampleTable::getEntity()->createDbTable();
	        }
        }
    }
    */

	/*
    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(ExampleTable::getTableName());
        }
    }
    */
}
