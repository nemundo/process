<?php


namespace Nemundo\Process\Group\Content\Add;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Form\StatusFormTrait;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class AddGroupContentType extends AbstractProcessStatus  // AbstractContentType
{

protected function loadContentType()
{
$this->type='Add Group';
$this->id='43959909-7aca-4a0f-a486-02f993266ad1';
$this->formClass=AddGroupContentForm::class;
    // TODO: Implement loadContentType() method.
}
}