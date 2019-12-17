<?php


namespace Nemundo\Process\Template\Builder;


use App\App\IssueTracker\Workflow\Status\AnalyseStatus;
use Nemundo\Process\Builder\AbstractStatusLogBuilder;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Status\CommentStatus;

class CommentStatusBuilder extends AbstractStatusLogBuilder
{

    public $comment;

    public function saveItem()
    {

        //$this->contentType =new AnalyseStatus();  // new CommentStatus();

        $data = new LargeText();
        $data->id=$this->dataId;
        $data->largeText = $this->comment;
        $data->save();

        $this->saveWorkflowLog();

        // search index

    }

}