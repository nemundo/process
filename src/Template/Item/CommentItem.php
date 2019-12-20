<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Status\CommentProcessStatus;

class CommentItem extends AbstractContentItem
{

    public $comment;


    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->contentType =new CommentProcessStatus();

    }


    public function saveItem()
    {





        $data = new LargeText();
        $data->id=$this->dataId;
        $data->largeText = $this->comment;
        $data->save();

        $this->saveContent();  //saveWorkflowLog();

        // search index

    }

}