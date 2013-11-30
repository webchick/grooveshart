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
    $config = \Drupal::config('grooveshart.settings');

    // Grab a random terrible song.
    $songs = $config->get('songs');
    $random = array_rand($songs, 1);
    $terrible_song = urlencode($songs[$random]);

    // Submit search request to GrooveShark API.
    $api_key = $config->get('api_key');
    $request = $client->get("http://tinysong.com/b/$terrible_song/?format=json&key=$api_key");
    $response = $request->send();
    $json = $response->json();

    // Output the player.
    return array(
      '#theme' => 'grooveshark_player',
      '#songIDs' => $json['SongID'],
    );
  }
}
