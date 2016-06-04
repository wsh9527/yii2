<?php
use tests\codeception\custom\AcceptanceTester;
use tests\codeception\custom\_pages\AboutPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that about works');
AboutPage::openBy($I);
$I->see('About', 'h1');
