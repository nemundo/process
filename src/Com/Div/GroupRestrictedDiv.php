<?php


namespace Nemundo\Process\Com\Div;


use Nemundo\Html\Block\Div;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;

class GroupRestrictedDiv extends Div
{

    use GroupRestrictedTrait;

    public function getContent()
    {
        $this->visible = $this->checkUserVisibility();
        return parent::getContent();
    }

}