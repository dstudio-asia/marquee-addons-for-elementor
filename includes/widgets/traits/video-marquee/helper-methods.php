<?php

use Elementor\Icons_Manager;

if (! defined('ABSPATH')) {
    exit;
}

trait Video_Marquee_Helper_Methods
{
    /**
     * Converts a YouTube watch link into an embeddable URL.
     *
     * This function takes a standard YouTube watch link, extracts the video ID, and returns the appropriate embed link. If privacy mode is enabled, it will return a URL that ensures YouTube does not track user interactions unless the video is played.
     *
     * @param string $watchLink The YouTube watch URL.
     * @param bool $privacyEnabled Determines whether privacy mode is enabled (defaults to false).
     * @return string|null Returns the embeddable YouTube URL or null if the URL is invalid.
     */
    protected function youtube_embed($watchLink, $privacyEnabled = false)
    {
        $urlParts = wp_parse_url(sanitize_text_field($watchLink));
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $queryParams);
            if (isset($queryParams['v'])) {
                $videoId = sanitize_text_field($queryParams['v']);
                $baseUrl = $privacyEnabled ? "https://www.youtube-nocookie.com/embed/" : "https://www.youtube.com/embed/";
                return esc_url($baseUrl . $videoId);
            }
        }
        return null;
    }

    /**
     * Extracts the video ID from a Vimeo URL.
     *
     * This function takes a Vimeo video link, parses it, and extracts the video ID. It returns the ID as a sanitized string, which can be used to embed the video.
     *
     * @param string $vimeo_url The Vimeo URL.
     * @return string|null Returns the Vimeo video ID or null if the URL is invalid.
     */
    protected function vimeo_embed($vimeo_url)
    {
        $vimeo_url = esc_url($vimeo_url);
        $url_parts = explode('/', trim($vimeo_url, '/'));
        $video_id = end($url_parts);
        return is_numeric($video_id) ? sanitize_text_field($video_id) : null;
    }

    /**
     * Extracts the video ID from a Dailymotion URL.
     *
     * This function processes a Dailymotion video link, extracts the video ID, and returns it in a sanitized form. This video ID can then be used to embed the Dailymotion video.
     *
     * @param string $dailymotion_url The Dailymotion URL.
     * @return string|null Returns the Dailymotion video ID or null if the URL is invalid.
     */
    protected function dailymotion_embed($dailymotion_url)
    {
        $dailymotion_url = esc_url($dailymotion_url);
        $url_parts = explode('/', trim($dailymotion_url, '/'));
        if (in_array('video', $url_parts)) {
            $video_id = end($url_parts);
            return sanitize_text_field($video_id);
        }
        return null;
    }

    /**
     * Renders the image overlay for videos.
     *
     * This function checks if the image overlay option is enabled for a video. If enabled, it displays the specified overlay image. Additionally, if the play icon option is enabled, it renders a play button on top of the overlay.
     *
     * @param array $video_link The array containing video settings, including options for the overlay image and play icon.
     */
    protected function image_overlay($video_link)
    {
        if ($video_link['deensimc_show_video_image_overlay'] === 'yes' && $video_link['deensimc_video_overlay_image'] !== '') {
?>

            <div class="deensimc-video-placeholder">
                <img src="<?php echo esc_url($video_link['deensimc_video_overlay_image']['url']); ?>" alt="Video Placeholder" class="deensimc-placeholder-image">
                <?php
                if ($video_link['deensimc_show_image_overlay_play_icon'] === 'yes') {
                ?>
                    <div class="deensimc-play-button">
                        <?php Icons_Manager::render_icon($video_link['deensimc_image_overlay_icon'], ['aria-hidden' => 'true']); ?>
                    </div>
                <?php
                }
                ?>
            </div>
        <?php

        }
    }

    /**
     * Renders a YouTube video item.
     *
     * Given a set of YouTube video parameters, this function generates an embeddable iframe to display the video, including options for autoplay, mute, and custom start/end times.
     *
     * @param array $video_link The array containing the video link details and settings.
     */
    protected function render_youtube_video($video_link,  $start_time, $end_time, $auto_play, $mute, $loop, $controls, $video_display)
    {
        $youtube_url = $video_link['deensimc_video_youtube_url'] ?? '';
        $embed_url = $this->youtube_embed($youtube_url, $video_link['deensimc_video_privacy'] === 'yes');

        // Extract the video id from the youtube url separately
        $video_id = '';
        if (isset($youtube_url)) {
            $urlParts = wp_parse_url(sanitize_text_field($youtube_url));
            if (isset($urlParts['query'])) {
                parse_str($urlParts['query'], $queryParams);
                $video_id = isset($queryParams['v']) ? sanitize_text_field($queryParams['v']) : '';
            }
        }

        if ($embed_url) {
            $modest_branding = $video_link['deensimc_video_modestbranding'] === 'yes' ? 1 : 0;
            $suggested_video = $video_link['deensimc_video_rel'] === 'yes' ? 1 : 0;

            // If loop is enabled, add the playlist parameter with the video id
            if ($loop) {
                $embed_url = sprintf(
                    '%s?start=%d&end=%d&autoplay=%d&mute=%d&loop=%d&controls=%d&modestbranding=%d&rel=%d&playlist=%s',
                    $embed_url,
                    $start_time,
                    $end_time,
                    $auto_play,
                    $mute,
                    $loop,
                    $controls,
                    $modest_branding,
                    $suggested_video,
                    $video_id
                );
            } else {
                $embed_url = sprintf(
                    '%s?start=%d&end=%d&autoplay=%d&mute=%d&loop=%d&controls=%d&modestbranding=%d&rel=%d',
                    $embed_url,
                    $start_time,
                    $end_time,
                    $auto_play,
                    $mute,
                    $loop,
                    $controls,
                    $modest_branding,
                    $suggested_video
                );
            }
        ?>
            <div class="deensimc-video-item">
                <?php $this->image_overlay($video_link); ?>
                <iframe class="deensimc-video-wrapper <?php echo esc_attr($video_display); ?>" src="<?php echo esc_url($embed_url); ?>"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
        <?php
        } else {
            echo '<div class="deensimc-video-item deensimc-invalid-video-url">Invalid Youtube URL</div>';
        }
    }

    /**
     * Renders a Vimeo video item.
     *
     * This function embeds a Vimeo video within the component, offering options like autoplay, mute, and custom start times.
     *
     * @param array $video_link The array containing Vimeo video details and settings.
     */
    protected function render_vimeo_video($video_link, $auto_play, $mute, $loop, $video_display, $start_time)
    {
        $vimeo_url = $video_link['deensimc_video_vimeo_url'] ?? '';
        $vimeo_video_id = $this->vimeo_embed($vimeo_url);

        if ($vimeo_video_id) {
            $show_title = $video_link['deensimc_video_vimeo_title'] === 'yes' ? 1 : 0;
            $privacy_mode = $video_link['deensimc_video_privacy'] === 'yes' ? 1 : 0;
            $show_portrait = $video_link['deensimc_video_vimeo_portrait'] === 'yes' ? 1 : 0;
            $show_byline = $video_link['deensimc_video_vimeo_byline'] === 'yes' ? 1 : 0;

            $embed_url = sprintf(
                'https://player.vimeo.com/video/%s?autoplay=%d&dnt=%d&autopause=0&loop=%d&muted=%d&title=%d&portrait=%d&byline=%d#t=%ds',
                $vimeo_video_id,
                $auto_play,
                $privacy_mode,
                $loop,
                $mute,
                $show_title,
                $show_portrait,
                $show_byline,
                $start_time
            );
        ?>
            <div class="deensimc-video-item">
                <?php $this->image_overlay(video_link: $video_link); ?>
                <iframe class="deensimc-video-wrapper <?php echo esc_attr($video_display); ?>" src="<?php echo esc_url($embed_url); ?>"
                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
        <?php
        } else {
            echo '<div class="deensimc-video-item deensimc-invalid-video-url">Invalid Vimeo URL</div>';
        }
    }

    /**
     * Renders a Dailymotion video item.
     *
     * This function generates the embed link for a Dailymotion video and renders the appropriate iframe with the selected settings.
     *
     * @param array $video_link The array containing Dailymotion video details and settings.
     */
    protected function render_dailymotion_video($video_link, $start_time, $auto_play, $mute, $controls, $video_display)
    {
        $dailymotion_url = $video_link['deensimc_video_dailymotion_url'] ?? '';
        $dailymotion_video_id = $this->dailymotion_embed($dailymotion_url);
        $dailymotion_logo = $video_link['deensimc_video_logo'] === 'yes' ? 1 : 0;

        if ($dailymotion_video_id) {
            $embed_url = sprintf(
                'https://www.dailymotion.com/embed/video/%s?autoplay=%d&mute=%d&start=%d&controls=%d&ui-logo=%d',
                $dailymotion_video_id,
                $auto_play,
                $mute,
                $start_time,
                $controls,
                $dailymotion_logo
            );
        ?>
            <div class="deensimc-video-item">
                <?php $this->image_overlay($video_link); ?>
                <iframe class="deensimc-video-wrapper <?php echo esc_attr($video_display); ?>" src="<?php echo esc_url($embed_url); ?>"
                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
                </iframe>
            </div>
        <?php
        } else {
            echo '<div class="deensimc-video-item deensimc-invalid-video-url">Invalid Dailymotion URL</div>';
        }
    }

    /**
     * Renders a self-hosted video.
     *
     * This function handles the embedding of videos hosted on the site, offering support for autoplay, mute, looping, and custom poster images.
     *
     * @param array $video_link The array containing hosted video details and settings.
     */
    protected function render_hosted_video($video_link, $start_time, $end_time, $video_display)
    {
        $video_url = !empty($video_link['deensimc_video_external_url']['url']) ? $video_link['deensimc_video_external_url']['url'] : $video_link['deensimc_video_hosted_url']['url'] ?? '#';
        if ($video_url) {
            $auto_play = $video_link['deensimc_video_autoplay'] === 'yes' ? 'autoplay' : '';
            $mute = $video_link['deensimc_video_mute'] === 'yes' ? 'muted' : '';
            $loop = $video_link['deensimc_video_loop'] === 'yes' ? 'loop' : '';
            $controls = $video_link['deensimc_video_controls'] === 'yes' ? 'controls' : '';
            $video_download = $video_link['deensimc_video_download_button'] !== 'yes' ? 'controlsList=nodownload' : '';
            $poster = !empty($video_link['deensimc_video_poster']['url']) ? 'poster=' . esc_url($video_link['deensimc_video_poster']['url']) . '' : '';
        ?>
            <div class="deensimc-video-item">
                <?php $this->image_overlay($video_link); ?>
                <video class="deensimc-hosted-video <?php echo esc_attr($video_display); ?>" data-start="<?php echo esc_attr($start_time); ?>" data-end="<?php echo esc_attr($end_time); ?>" src="<?php echo esc_url($video_url); ?>"
                    <?php echo esc_attr($auto_play); ?> <?php echo esc_attr($mute); ?> <?php echo esc_attr($loop); ?> <?php echo esc_attr($controls); ?> <?php echo esc_attr($poster); ?> <?php echo esc_attr($video_download) ?> playsinline>
                    <?php esc_html_e('Your browser does not support the video tag.',  'marquee-addons-for-elementor'); ?>
                </video>
            </div>
<?php
        } else {
            echo '<div class="deensimc-video-item deensimc-invalid-video-url">Invalid Self Hosted URL</div>';
        }
    }

    /**
     * Renders the correct video type based on user input.
     *
     * This function selects the appropriate render method based on the video type (YouTube, Vimeo, Dailymotion, or hosted) and renders the video accordingly.
     *
     * @param array $video_link The array containing video details and settings.
     */
    protected function render_video_item($video_list)
    {
        $count  = count($video_list);

        // If less than 8, duplicate until at least 8
        if ($count > 0 && $count < 8) {
            $i = 0;
            while (count($video_list) < 8) {
                $duplicate           = $video_list[$i % $count];
                $duplicate['_is_dup'] = true; // Mark as duplicate
                $video_list[]         = $duplicate;
                $i++;
            }
        }

        foreach ($video_list as $video_link) {
            $video_type = $video_link['deensimc_video_type'];
            $start_time = intval($video_link['deensimc_video_start'] ?? 0);
            $end_time = intval($video_link['deensimc_video_end'] ?? 0);
            $auto_play = $video_link['deensimc_video_autoplay'] === 'yes' ? 1 : 0;
            $mute = $video_link['deensimc_video_mute'] === 'yes' ? 1 : 0;
            $controls = $video_link['deensimc_video_controls'] === 'yes' ? 1 : 0;
            $loop = $video_link['deensimc_video_loop'] === 'yes' ? 1 : 0;
            $video_display = $video_link['deensimc_show_video_image_overlay'] === 'yes' ? 'deensimc-d-none' : '';

            switch ($video_type) {
                case 'youtube':
                    $this->render_youtube_video($video_link,  $start_time, $end_time, $auto_play, $mute, $loop, $controls, $video_display);
                    break;
                case 'vimeo':
                    $this->render_vimeo_video($video_link, $auto_play, $mute, $loop, $video_display, $start_time);
                    break;
                case 'dailymotion':
                    $this->render_dailymotion_video($video_link, $start_time, $auto_play, $mute, $controls, $video_display);
                    break;
                case 'hosted':
                    $this->render_hosted_video($video_link, $start_time, $end_time, $video_display);
                    break;
            }
        }
    }
}
