<?php


namespace Nemundo\Process\Group\Content\Add;


use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

class AddGroupContentType extends AbstractProcessStatus  // AbstractContentType
{

    protected function loadContentType()
    {
        $this->typeLabel = 'Add Group';
        $this->typeId = '43959909-7aca-4a0f-a486-02f993266ad1';
        $this->formClass = AddGroupContentForm::class;
        //$this->itemClass=AddGroupContentItem::class;
        // TODO: Implement loadContentType() method.
    }
}