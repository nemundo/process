<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Workflow\Content\Form\StatusForm;
use Nemundo\Process\Workflow\Content\Writer\ProcessStatusWriter;

abstract class AbstractProcessStatus extends AbstractSequenceContentType
{

    use ProcessStatusTrait;

    public function __construct($dataId = null)
    {
        $this->formClass=StatusForm::class;
        parent::__construct($dataId);
    }


    final public function saveType()
    {

        $this->saveData();

        $writer = new ProcessStatusWriter();
        $writer->contentType = $this;
        $writer->parentId = $this->parentId;
        $writer->dataId = $this->dataId;
        $writer->write();


    }

}