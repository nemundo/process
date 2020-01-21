<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Data\Document\DocumentUpdate;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\FileContentForm;
use Nemundo\Workflow\App\WorkflowTemplate\Data\SubjectChange\SubjectChange;

class DocumentDeleteProcessStatus extends AbstractProcessStatus
{

    public $documentId;

    protected function loadContentType()
    {


        $this->typeLabel[LanguageCode::EN] = 'Document Delete';
        $this->typeLabel[LanguageCode::DE] = 'Dokument löschen';
        $this->typeId ='a83ea4f8-9605-40d0-9557-bb8224d41e24';
        $this->changeStatus=false;

        //$this->formClass=DocumentForm::class;

    }


    public function getSubject()
    {

        //$documentRow = (new DocumentReader())->getRowById($this->dataId);
        //$text = 'Document '.$documentRow->document->getFilename().' was deleted';

        $text = 'Doc Deleted';

        return $text;

    }


    protected function onCreate()
    {

        $update = new DocumentUpdate();
        $update->active = false;
        $update->updateById($this->documentId);

    }

}