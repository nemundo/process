<?php


namespace Nemundo\Process\Com\Hyperlink;


use Nemundo\Package\FontAwesome\Hyperlink\IconSiteHyperlink;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;

class GroupRestrictedIconSiteHyperlink extends IconSiteHyperlink
{

    use GroupRestrictedTrait;

    public function getContent()
    {
        $this->visible = $this->checkUserVisibility();
        return parent::getContent();
    }


}