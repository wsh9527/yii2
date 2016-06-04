<?php

namespace tests\codeception\custom\_pages;

use yii\codeception\BasePage;

/**
 * Represents about page
 * @property \codeception_custom\AcceptanceTester|\codeception_custom\FunctionalTester $actor
 */
class AboutPage extends BasePage
{
    public $route = 'site/about';
}
