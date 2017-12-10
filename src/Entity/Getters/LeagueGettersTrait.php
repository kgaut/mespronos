<?php

namespace Drupal\mespronos\Entity\Getters;

use Drupal\Core\Database\Database;
use Drupal\mespronos\Entity\Day;
use Drupal\mespronos\Entity\Game;

trait LeagueGettersTrait {

  /**
   * Return all days for league
   * @return \Drupal\mespronos\Entity\Day[]
   */
  public function getDays() {
    $query = \Drupal::entityQuery('day');
    $query->condition('league', $this->id());
    $query->sort('id', 'ASC');
    $ids = $query->execute();

    return Day::loadMultiple($ids);
  }

  /**
   * Return all games for day
   * @return \Drupal\mespronos\Entity\Game[]
   */
  public function getGames() {
    $injected_database = Database::getConnection();
    $query = $injected_database->select('mespronos__game', 'g');
    $query->join('mespronos__day', 'd', 'd.id = g.day');
    $query->addField('g', 'id');
    $query->condition('d.league', $this->id());
    $results = $query->execute()->fetchAllAssoc('id');

    $results = array_map(function ($v) {return $v->id;}, $results);
    return Game::loadMultiple($results);
  }

  public function getLogoUrl() {
    if($logo = $this->get('field_league_logo')->referencedEntities()[0]) {
      return file_create_url($logo->getFileUri());
    }
    return NULL;
  }
}