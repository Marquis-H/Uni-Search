<?php

/**
 * Created by PhpStorm.
 * User: Marquis
 * Date: 15/10/20
 * Time: 下午5:52
 */
class SearchSites
{
    public function SitesList()
    {
        // google 镜像域名
        $google = 'https://www.googto.com/';

        $sites = array(
            array(
                'name' => '谷歌',
                'url' => $google . '?q={q}'
            )
        );

        return $sites;
    }

}