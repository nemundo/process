<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\DocumentContentForm;

class DocumentDeleteStatus extends AbstractStatus
{

    protected function loadContentType()
    {

        $this->label='Document Delete';
        $this->id ='a83ea4f8-9605-40d0-9557-bb8224d41e24';
        $this->changeStatus=false;

        //$this->formClass=DocumentForm::class;

    }


    public function getLogText($dataId)
    {

        $documentRow = (new DocumentReader())->getRowById($dataId);
        $text = 'Document '.$documentRow->document->getFilename().' was deleted';

   //     $text = 'Doc Deleted';

        return $text;

    }

}