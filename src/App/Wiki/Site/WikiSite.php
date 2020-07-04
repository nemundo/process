<?php

namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Process\App\Wiki\Page\WikiPage;
use Nemundo\Web\Site\AbstractSite;


class WikiSite extends AbstractSite
{

    /**
     * @var WikiSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Wiki';
        $this->url = 'wiki';
        WikiSite::$site = $this;

        new WikiNewSite($this);
        new AdminSite($this);

    }

    public function loadContent()
    {

        (new WikiPage())->render();

    }

}