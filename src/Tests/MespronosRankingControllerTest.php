<?php

/**
 * @file
 * Contains Drupal\mespronos\Tests\MespronosLeagueTest.
 */

namespace Drupal\mespronos\Tests;

use Drupal\simpletest\WebTestBase;
use Drupal\mespronos\Controller\RankingController;

/**
 * Provides automated tests for the mespronos module.
 * @group mespronos
 */
class MespronosRankingControllerTest extends WebTestBase {
  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "MesPronos RankingDay functionality",
      'description' => 'Test Unit for user permissions.',
      'group' => 'MesPronos',
    );
  }

  static public $modules = array(
    'mespronos',
  );

  public function setUp() {
    parent::setUp();
  }

  public function testSortingMethodSimple() {
    $data = [];

    $data_obj = new \stdClass();
    $data_obj->better = 1;
    $data_obj->points = 10;
    $data_obj->nb_bet = 1;
    $data[] = $data_obj;

    $data_obj = new \stdClass();
    $data_obj->better = 2;
    $data_obj->points = 5;
    $data_obj->nb_bet = 1;
    $data[] = $data_obj;

    $data_obj = new \stdClass();
    $data_obj->better = 3;
    $data_obj->points = 1;
    $data_obj->nb_bet = 1;
    $data[] = $data_obj;
    debug($data);
    RankingController::sortRankingDataAndDefinedPosition($data);
    debug($data);
    $this->assertEqual(count($data),3,t('Data still has three lines'));
    $this->assertEqual($data[0]->position,1,t('First data object has position 1'));
    $this->assertEqual($data[1]->position,2,t('Second data object has position 2'));
    $this->assertEqual($data[2]->position,3,t('Third data object has position 3'));

    $this->assertEqual($data[0]->better,1,t('Better 1 is first'));
    $this->assertEqual($data[1]->better,2,t('Better 2 is second'));
    $this->assertEqual($data[2]->better,3,t('Better three is third'));


  }


}
