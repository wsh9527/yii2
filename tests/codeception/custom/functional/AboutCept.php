<?php
use tests\codeception\custom\FunctionalTester;
use tests\codeception\custom\_pages\AboutPage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that about works');
AboutPage::openBy($I);
$I->see('About', 'h1');
