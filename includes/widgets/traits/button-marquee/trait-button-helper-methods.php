<?php

trait Button_Helper_Method
{
  private function handle_video_url($link_type, $settings)
  {
    $video_link = '';

    if ($link_type === 'youtube' && !empty($settings['deensimc_button_yt_video_link'])) {
      $watchLink = $settings['deensimc_button_yt_video_link'];
      $urlParts = wp_parse_url(sanitize_text_field($watchLink));

      if (isset($urlParts['query'])) {
        parse_str($urlParts['query'], $queryParams);
        if (isset($queryParams['v'])) {
          $videoId = sanitize_text_field($queryParams['v']);
          $video_link = esc_url("https://www.youtube.com/embed/" . $videoId);
        }
      } elseif (!empty($urlParts['path'])) {
        // Handle youtu.be short links
        $videoId = trim($urlParts['path'], '/');
        $video_link = esc_url("https://www.youtube.com/embed/" . sanitize_text_field($videoId));
      }
    }

    if ($link_type === 'vimeo' && !empty($settings['deensimc_button_vimeo_video_link'])) {
      $vimeo_url = $settings['deensimc_button_vimeo_video_link'];
      $path = parse_url($vimeo_url, PHP_URL_PATH);
      $url_parts = explode('/', trim($path, '/'));
      $potential_id_with_query = end($url_parts);
      $video_id = current(explode('?', $potential_id_with_query));

      if (is_numeric($video_id)) {
        $video_link = esc_url("https://player.vimeo.com/video/" . sanitize_text_field($video_id));
      }
    }

    if ($link_type === 'hosted' && !empty($settings['deensimc_button_hosted_video_link']['url'])) {
      $video_link = esc_url($settings['deensimc_button_hosted_video_link']['url']);
    }

    if (!empty($video_link)) {
      $this->add_render_attribute('button', 'data-link', $video_link);
    }
  }
}
