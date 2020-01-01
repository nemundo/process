<?php


namespace Nemundo\Process\Group\Content\Group;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Content\GroupContentView;
use Nemundo\Process\Group\Parameter\GroupParameter;
use Nemundo\Process\Group\Site\GroupItemSite;

class GroupContentType extends AbstractContentType
{
    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
        $this->contentId = '3e7f52c9-63d6-4c49-abad-63f9836e1bce';
        $this->type = 'Group';

        $this->viewClass=GroupContentView::class;

        $this->viewSite=GroupItemSite::$site;
        $this->parameterClass=GroupParameter::class;

    }
}