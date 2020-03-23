<?php


namespace Nemundo\Process\App\Share\Com\Button;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Process\App\Share\Site\ShareSite;

class ShareButton extends AdminIconSiteButton
{

    public function getContent()
    {

        $this->site = ShareSite::$site;
        return parent::getContent();

    }

}