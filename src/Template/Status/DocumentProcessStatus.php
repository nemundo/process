<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\DocumentContentForm;
use Nemundo\Process\Template\View\DocumentContentView;

class DocumentProcessStatus extends AbstractProcessStatus
{

    protected function loadContentType()
    {

        $this->label[LanguageCode::EN] = 'Document';
        $this->label[LanguageCode::DE] = 'Dokument';
        $this->id ='bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
        $this->changeStatus=false;
        $this->formClass=DocumentContentForm::class;
        $this->viewClass=DocumentContentView::class;

    }


    public function getSubject($dataId)
    {

        $documentRow = (new DocumentReader())->getRowById($dataId);
        $text = 'Document '.$documentRow->document->getFilename().' was uploaded';

        return $text;

    }

}