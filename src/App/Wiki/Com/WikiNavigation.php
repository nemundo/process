<?php


namespace Nemundo\Process\App\Wiki\Com;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Process\App\Wiki\Site\WikiSite;

class WikiNavigation extends AdminNavigation
{

    public function getContent()
    {

        $this->site = WikiSite::$site;
        return parent::getContent();

    }

}