<?php


namespace Nemundo\Process\Template\Builder;


use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Template\Data\LargeText\LargeText;

class CommentStatusBuilder extends AbstractStatusLogBuilder
{

    public $comment;

    public function createStatusItem()
    {
        // TODO: Implement createStatusStep() method.

        $data = new LargeText();
        $data->largeText=$this->comment;
         $this->dataId= $data->save();

          $this->saveWorkflowLog();

    }

}