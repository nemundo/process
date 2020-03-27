<?php


namespace Nemundo\Process\Com\Button;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;

class GroupRestrictedAdminSiteButton extends AdminSiteButton
{

    use GroupRestrictedTrait;

    public function getContent()
    {
        $this->visible = $this->checkUserVisibility();
        return parent::getContent();
    }

}