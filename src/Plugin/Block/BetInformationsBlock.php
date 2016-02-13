<?php

/**
 * @file
 * Contains \Drupal\mespronos\Plugin\Block\BetInformationsBlock.
 */

namespace Drupal\mespronos\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\mespronos\Entity\Day;
/**
 * Provides a 'BetInformationsBlock' block.
 *
 * @Block(
 *  id = "bet_informations_block",
 *  admin_label = @Translation("Bet informations block"),
 * )
 */
class BetInformationsBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $day_id = \Drupal::routeMatch()->getParameter('day');
    $day = Day::load($day_id);
    $league = $day->getLeague();

    return [
      '#theme' =>'block-bet-informations',
      '#day' => [
        'label' => $day->label(),
        'nb_games' => $day->getNbGame(),
      ],
      '#league' => [
        'label' => $league->label(),
        'points' => $league->getPoints(),
        'betting_type' => $league->getBettingType(),
        'betting_type_machine' => $league->getBettingType(true),
      ],
      '#cache' => [
        'contexts' => [ 'url'],
      ],
      "#title" => $league->label(),
    ];
  }

}
