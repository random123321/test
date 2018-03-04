<?php

namespace Sprint\Migration;




class Version120180304184723 extends Version {

    protected $description = "Тестовая миграция";

    public function up(){
        $helper = new HelperManager();
        
		//Можно создавать таблицу и без модуля, тогда необходимо подключать класс с представлением таблицы
		if(\Bitrix\Main\Loader::includeModule('my.module')){
			\MyModule\ExampleTable::getEntity()->createDbTable();
		}
		
		

    }

    public function down(){
        $helper = new HelperManager();
        
        $connection = Application::getInstance()->getConnection();
        $connection->dropTable(\MyModule\ExampleTable::getTableName());

    }

}
