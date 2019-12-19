<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Status\CancelStatus;
use Nemundo\Process\Template\Status\CommentProcessStatus;
use Nemundo\Process\Workflow\Content\Item\Process\WorkflowItem;
use Nemundo\Process\Workflow\Content\Item\Status\AbstractStatusItem;

class CancelContentItem extends AbstractStatusItem
{

    public $comment;


    /*
    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->contentType =new CommentProcessStatus();

    }*/


    public function saveItem()
    {


        $this->contentType= new CancelStatus();

        $data = new LargeText();
        $data->id=$this->dataId;
        $data->largeText = $this->comment;
        $data->save();

        $this->saveWorkflowLog();

        $item = new WorkflowItem($this->parentId);
        $item->clearAssignment();

        // assignment löschen

        // search index

    }

}