<?php
/**
 * Created by PhpStorm.
 * User: barmmie
 * Date: 7/28/15
 * Time: 5:05 PM
 */

namespace Karakata\Presenter;


use Illuminate\Pagination\Presenter;

class SemanticPaginationPresenter extends Presenter
{
    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string $url
     * @param  int $page
     * @param  string $rel
     * @return string
     */
    public function getPageLinkWrapper($url, $page, $rel = null)
    {
        $rel = is_null($rel) ? '' : ' rel="' . $rel . '"';

        return "<a href='{$url}' {$rel} class='item'>{$page}</a>";

    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string $text
     * @return string
     */
    public function getDisabledTextWrapper($text)
    {
        return '<div class="disabled item">' . $text . '</div>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string $text
     * @return string
     */
    public function getActivePageWrapper($text)
    {
        return '<a class="active item">' . $text . '</a>';
    }
}