<?php


namespace Nemundo\Process\Workflow\Content\Status;


trait DuplicateStatusCheckTrait
{

    public function isStatusChangeable()
    {

        $count = 0;
        foreach ($this->getParentContentType()->getChild() as $logRow) {
            if ($logRow->contentType->getContentType()->getClassName() == $this->getClassName()) {

                if ($logRow->id == $this->getContentId()) {
                    if ($count>0) {
                        $this->changeStatus = false;

                    }
                }

                $count++;

            }

        }

        return parent::isStatusChangeable();

    }


}