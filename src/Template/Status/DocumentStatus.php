<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\DocumentForm;

class DocumentStatus extends AbstractStatus
{

    protected function loadStatus()
    {

        $this->label='Document';
        $this->id ='bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
        $this->changeStatus=false;
        $this->formClass=DocumentForm::class;

    }


    public function getLogText($dataId)
    {

        $documentRow = (new DocumentReader())->getRowById($dataId);
        $text = 'Document '.$documentRow->document->getFilename().' was uploaded';

        return $text;

    }

}