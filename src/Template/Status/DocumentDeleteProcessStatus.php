<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\DocumentContentForm;

class DocumentDeleteProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->type[LanguageCode::EN] = 'Document Delete';
        $this->type[LanguageCode::DE] = 'Dokument löschen';
        $this->contentId ='a83ea4f8-9605-40d0-9557-bb8224d41e24';
        $this->changeStatus=false;

        //$this->formClass=DocumentForm::class;

    }


    public function getSubject($dataId)
    {

        $documentRow = (new DocumentReader())->getRowById($dataId);
        $text = 'Document '.$documentRow->document->getFilename().' was deleted';

   //     $text = 'Doc Deleted';

        return $text;

    }

}