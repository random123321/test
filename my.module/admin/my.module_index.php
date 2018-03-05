<?php
define('ADMIN_MODULE_NAME', 'my.module');

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';

\Bitrix\Main\Loader::includeModule('my.module');

use \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Context,
    \Bitrix\Main\Application,
    \MyModule\ExampleTable;
    
    
Loc::loadMessages(__FILE__);

global $APPLICATION;
$flgErr = false;

if(Application::getConnection(ExampleTable::getConnectionName())->isTableExists(ExampleTable::getTableName())){
	$sTableID = ExampleTable::getTableName();

	$oSort = new CAdminSorting($sTableID, 'ID', 'DESC');
	$lAdmin = new CAdminList($sTableID, $oSort);
	
	$dbResultList = ExampleTable::getList();
	
	while($arElement = $dbResultList->Fetch()){
		$lAdmin->AddRow($arElement["ID"], $arElement);
	}
	
	$lAdmin->AddHeaders(array(
	    array('id' => 'ID', 'content' => Loc::getMessage('TABLE_ID'), 'sort' => 'ID', 'default' => true),
	    array('id' => 'TEXT', 'content' => Loc::getMessage('TABLE_TEXT'), 'sort' => 'TEXT', 'default' => true),
	        ));

} else {
	$flgErr = true;
	
}


require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_after.php';

if(!$flgErr){
	$lAdmin->DisplayList();
} else{
	CAdminMessage::ShowMessage(Loc::getMessage('MODULE_TABLE_ERROR'));
}

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/epilog_admin.php';
