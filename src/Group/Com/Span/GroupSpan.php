<?php


namespace Nemundo\Process\Group\Com\Span;


use Nemundo\Html\Formatting\Bold;
use Nemundo\Html\Inline\Span;
use Nemundo\Process\Group\Type\GroupContentType;

class GroupSpan extends Span
{

    public $groupId;

    public function getContent()
    {

        $group = (new GroupContentType())->fromGroupId($this->groupId);

        //$span = new Bold();
        //$span->content = $group->getSubject();  // $this->workflowRow->assignment->group;
        $this->title = $group->getUserListText();

        return parent::getContent();
    }

}