<?php

namespace tests\codeception\custom\unit;

/**
 * @inheritdoc
 */
class DbTestCase extends \yii\codeception\DbTestCase
{
    public $appConfig = '@tests/codeception/config/custom/unit.php';
}
