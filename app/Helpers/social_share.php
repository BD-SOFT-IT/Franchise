<?php

function socialShareMetaData(array $data) {

}

/**
 * @param array $for
 * @param string|null $url
 * @param string|null $title
 * @param string|null $media
 * @param array|null $classes
 * @return string
 */
function socialShareLinkGroup(array $for, string $url = null, string $title = null, string $media = null, array $classes = null) {
    $links = '<div class="social-share-wrapper ';
    $links .= (($classes && isset($classes['position'])) ? $classes['position'] . ' ' : '');
    $links .= (($classes && isset($classes['show'])) ? $classes['show'] . ' ' : 'horizontal');
    $links .= ($classes && isset($classes['float'])) ? $classes['float'] : (($classes && isset($classes['position']) && in_array(strtolower($classes['position']), ['fixed', 'absolute'])) ? 'left' : '');
    $links .= '"><ul class="social-share';
    $links .= ($classes && isset($classes['ul'])) ? (' ' . $classes['ul'] . '">') : '">';

    foreach ($for as $social) {
        if($link = generateSocialShareLink($social, $url, $title, $media)) {
            $links .= '<li class="social-share-item';
            $links .= ($classes && isset($classes['li'])) ? (' ' . $classes['li'] . '">') : '">';
            $links .= '<a href="' . $link .'" title="Share in ' . strtoupper($social) . '" @click="openShareWindow" class="' . strtolower($social) . '-link"><i class="fa fa-';
            $links .= (strtolower($social) == 'google') ? 'google-plus' : ((strtolower($social) == 'pocket') ? 'get-pocket' : strtolower($social));
            $links .= '"></i><span class="title">Share in ' . $social . '</span>';
            $links .= '</a></li>';
        }
    }
    $links .= '</ul></div>';

    return $links;
}

/**
 * @param string $for
 * @param string|null $url
 * @param string|null $title
 * @param string|null $media
 * @return string|null
 */
function generateSocialShareLink(string $for, string $url = null, string $title = null, string $media = null) {
    if(!$url) {
        $url = Request::fullUrl();
    }
    if($title) {
        $title = urlencode($title);
    }
    if($media) {
        $media = urlencode($media);
    }
    $share_url = null;
    switch (strtolower($for)) {
        case 'facebook':
            $share_url = 'https://www.facebook.com/sharer.php?u=' . $url;
            break;
        case 'google':
            $share_url = 'https://plus.google.com/share?url=' . $url;
            break;
        case 'twitter':
            $share_url = 'https://twitter.com/intent/tweet?url=' . $url . '&status=' . $title . ' -- ' . $url;
            break;
        case 'pinterest':
            $share_url = 'https://pinterest.com/pin/create/bookmarklet/?url=' . $url . '&description=' . $title . '&media=' . $media;
            break;
        case 'linkedin':
            $share_url = 'https://www.linkedin.com/shareArticle?url=' . $url . '&title=' . $title;
            break;
        case 'thumblr':
            $share_url = 'https://www.tumblr.com/share/link?url=' . $url . '&name=' . $title;
            break;
        case 'reddit':
            $share_url = 'https://reddit.com/submit?url=' . $url . '&title=' . $title;
            break;
        case 'pocket':
            $share_url = 'https://getpocket.com/save?url=' . $url . '&title=' . $title;
            break;
    }
    return $share_url;
}
