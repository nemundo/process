<?php


namespace Nemundo\Process\Template\Builder;


use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Status\CommentStatus;

class CommentStatusBuilder extends AbstractStatusLogBuilder
{

    public $comment;

    public function saveStatus()
    {

        $this->status = new CommentStatus();

        $data = new LargeText();
        $data->largeText = $this->comment;
        $this->dataId = $data->save();

        $this->saveWorkflowLog();

        // search index

    }

}