<?php

/**
 * @file
 * Contains \Drupal\grooveshart\Controller\GrooveShartController.
 */

namespace Drupal\grooveshart\Controller;

/**
 * GrooveShart page controller.
 */
class GrooveShartController {

  /**
   * Streams a truly terrible song from the GrooveShark API.
   */
  public function stream() {
    return array(
      '#markup' => t('TODO'),
    );
  }

}
