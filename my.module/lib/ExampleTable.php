<?php
namespace MyModule;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ExampleTable extends DataManager
{
    public static function getTableName()
    {
        return 'example_table';
    }

    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('TABLE_ID'),
            ),
            'TEXT' => array(
                'data_type' => 'string',
                'title' => Loc::getMessage('TABLE_TEXT'),
            ),
        );
    }
}
