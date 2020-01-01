<?php


namespace Nemundo\Process\Template\Content\Assignment;


use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class GroupAssignmentStatus extends AbstractProcessStatus
{
protected function loadContentType()
{
 $this->type='Group Assignment';
 $this->contentId='e4368eda-9bb4-4610-9595-7ad9e86272ba';
 $this->changeStatus=false;
 $this->formClass=GroupAssignmentForm::class;
 $this->itemClass=GroupAssignmentItem::class;
    // TODO: Implement loadContentType() method.
}
}