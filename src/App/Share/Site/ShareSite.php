<?php


namespace Nemundo\Process\App\Share\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Icon\ShareIcon;
use Nemundo\Package\FontAwesome\Site\AbstractIconSite;

class ShareSite extends AbstractIconSite
{

    /**
     * @var ShareSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Share';
        $this->url = 'share';
        $this->icon = new ShareIcon();

        ShareSite::$site=$this;

    }


    public function loadContent()
    {

        //$page = (new DefaultTemplateFactory())->getDefaultTemplate()

    }

}