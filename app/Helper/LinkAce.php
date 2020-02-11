<?php

namespace App\Helper;

use ForceUTF8\Encoding;

/**
 * Class LinkAce
 *
 * @package App\Helper
 */
class LinkAce
{
    /**
     * Get the title and description of a website form it's URL
     *
     * @param string $url
     * @return array
     */
    public static function getMetaFromURL(string $url): array
    {
        $fallback = [
            'title' => parse_url($url, PHP_URL_HOST),
            'description' => null,
        ];

        // Try to get the HTML content of that URL
        try {
            $html = file_get_contents($url);
        } catch (\Exception $e) {
            return $fallback;
        }

        // Try to get the meta tags of that URL
        try {
            $tags = get_meta_tags($url);
        } catch (\Exception $e) {
            return $fallback;
        }

        if (empty($html)) {
            return $fallback;
        }

        // Parse the HTML for the title
        $res = preg_match("/<title>(.*)<\/title>/siU", $html, $title_matches);

        if ($res) {
            // Clean up title: remove EOL's and excessive whitespace.
            $title = preg_replace('/\s+/', ' ', $title_matches[1]);
            $title = trim($title);
        }

        // Parse OpenGraph meta data
        preg_match_all('/<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)/i', $html, $opengraph_matches);

        // Format OpenGraph matches
        $open_graph = [];
        if(array_key_exists(1, $opengraph_matches) && count($opengraph_matches[1]) > 0) {
            foreach ($opengraph_matches[1] as $key => $item) {
                $open_graph[$item] = $opengraph_matches[2][$key];
            }
        }

        $title = $title ?? $open_graph['og:title'] ?? $fallback['title'];

        // Get the title or the og:description tag or the twitter:description tag
        $description = $open_graph['og:description']
            ?? $tags['description']
            ?? $tags['twitter:description']
            ?? $fallback['description'];

        // Fix UTF8 Issues
        $title = self::fixString($title);
        $description = self::fixString($description);

        // Decode HTML Entities
        $title = html_entity_decode($title);
        $description = html_entity_decode($description);

        return compact('title', 'description');
    }

    /**
     * Generate the code for the bookmarklet
     */
    public static function generateBookmarkletCode(): string
    {
        $bm_code = 'javascript:javascript:(function(){var%20url%20=%20location.href;' .
            "var%20title%20=%20document.title%20||%20url;window.open('##URL##?u='%20+%20encodeURIComponent(url)" .
            "+'&t='%20+%20encodeURIComponent(title),'_blank','menubar=no,height=720,width=600,toolbar=no," .
            "scrollbars=yes,status=no,dialog=1');})();";

        $bm_code = str_replace('##URL##', route('bookmarklet-add'), $bm_code);

        return $bm_code;
    }

    /**
     * Fix UTF8 issues in a string
     *
     * @param string $string
     *
     * @return string
     */
    public static function fixString(string $string): string
    {
        $string = Encoding::toUTF8($string);
        $string = Encoding::fixUTF8($string);

        return $string;
    }
}
