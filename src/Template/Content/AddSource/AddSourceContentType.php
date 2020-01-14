<?php


namespace Nemundo\Process\Template\Content\AddSource;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Workflow\App\Workflow\Content\Type\AbstractWorkflowStatus;

class AddSourceContentType extends AbstractTreeContentType
{

    public $parentId;

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel='Add Source';
        $this->typeId='e40e4360-d630-42e2-a9f9-98a28ea6156d';
        $this->formClass=AddSourceContentForm::class;

     }


     public function onCreate()
     {

         $data=new SourceLog();
         $data->sourceId=$this->sourceId;
 $this->dataId= $data->save();

        $writer = new TreeWriter();
        $writer->parentId = $this->sourceId;
        $writer->dataId = $this->parentId;
        $writer->write();

     }

}