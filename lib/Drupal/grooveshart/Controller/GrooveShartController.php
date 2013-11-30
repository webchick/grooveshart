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
    $client = \Drupal::httpClient();

    // @todo Grab a random value from config file.
    $terrible_song = urlencode('Pauly Shore Lisa Lisa');

    // @todo Get API key from config.
    $api_key = '';
    $request = $client->get("http://tinysong.com/b/$terrible_song/?format=json&key=$api_key");

    $response = $request->send();

    $json = $response->json();

    return array(
      '#theme' => 'grooveshark_player',
      '#songIDs' => $json['SongID'],
    );
  }
}
