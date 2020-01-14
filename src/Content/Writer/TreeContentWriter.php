<?php


namespace Nemundo\Process\Content\Writer;


use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeValue;

class TreeContentWriter extends ContentWriter
{

    public $parentId;

    public function write()
    {

        $contentId = parent::write();

        if ($this->parentId !== null) {

            $writer=new TreeWriter();
            $writer->parentId=$this->parentId;
            $writer->dataId= $contentId; // $this->dataId;
            $writer->write();

        }

        return $contentId;

    }

}