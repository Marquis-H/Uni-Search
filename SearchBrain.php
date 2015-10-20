<?php

/**
 * Created by PhpStorm.
 * User: Marquis
 * Date: 15/10/20
 * Time: 下午6:04
 */
class SearchBrain
{
    public function searching($q, $siteId)
    {
        $SearchSites = new SearchSites();
        $sites = $SearchSites->SitesList();
        $q = isset($q) ? $q : '';
        $siteId = isset($siteId) && isset($sites[intval($siteId)]) ? intval($siteId) : 0;
        $url = $q ? str_replace("{q}", $q, $sites[$siteId]['url']) : 'about:blank';
        return array('q' => $q, 'siteId' => $siteId, 'url' => $url);
    }
}