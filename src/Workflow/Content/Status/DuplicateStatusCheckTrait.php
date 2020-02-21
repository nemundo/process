<?php


namespace Nemundo\Process\Workflow\Content\Status;


trait DuplicateStatusCheckTrait
{

    public function isStatusChangeable()
    {


        $count = 0;
        //$found = false;
        foreach ($this->getParentContentType()->getChild() as $logRow) {
            if ($logRow->contentType->getContentType()->getClassName() == $this->getClassName()) {

                if ($logRow->id == $this->getContentId()) {
                    if ($count>0) {
                        $this->changeStatus = false;

                    }
                }

                //      $found = true;
                $count++;



            }
        }

        //(new Debug())->write($count);

        /* if ($found) {
             $this->changeStatus = false;
         }*/

        return parent::isStatusChangeable();

    }


}