<?php


namespace Nemundo\Process\Template\Item;


use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\Status\CommentProcessStatus;

class CommentItem extends CommentProcessStatus  // AbstractContentItem
{

    public $comment;

/*
    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->contentType =new CommentProcessStatus();

    }*/


    protected function onCreate()
    {

        $data = new LargeText();
        $data->id=$this->dataId;
        $data->largeText = $this->comment;
        $data->save();


        $this->addSearchText($this->comment);

        //$this->saveContent();  //saveWorkflowLog();

        // search index

    }

}