<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Com\Html\Hyperlink\UrlHyperlink;
use Nemundo\Core\Http\Request\File\FileRequest;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Model\Data\Property\File\RedirectFilenameDataProperty;
use Nemundo\Process\Template\Data\Document\Document;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Data\Document\DocumentReader;
use Nemundo\Process\Template\Form\DocumentContentForm;
use Nemundo\Process\Template\View\DocumentContentView;

class DocumentProcessStatus extends AbstractProcessStatus
{


    public $filename;

    /**
     * @var FileRequest
     */
    public $fileRequest;

    protected function loadContentType()
    {

        $this->contentLabel[LanguageCode::EN] = 'Document';
        $this->contentLabel[LanguageCode::DE] = 'Dokument';
        $this->contentId ='bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
        $this->changeStatus=false;
        $this->formClass=DocumentContentForm::class;
        $this->viewClass=DocumentContentView::class;



    }


    protected function onCreate()
    {

        $data = new Document();
        $data->id = $this->dataId;
        $data->active = true;

        if ($this->fileRequest !==null) {
            $data->document->fromFileRequest($this->fileRequest);
        }

        if ($this->filename !==null) {
            $data->document->fromFilename($this->filename);
        }

        $data->save();

    }


    public function getSubject()
    {

        $documentRow = (new DocumentReader())->getRowById($this->dataId);

        $hyperlink = new UrlHyperlink();
        $hyperlink->content = $documentRow->document->getFilename();
        $hyperlink->url = $documentRow->document->getUrl();


        //$text = 'Document '.$documentRow->document->getFilename().' was uploaded';
        $text = 'Document '.$hyperlink->getContent().' was uploaded';

        return $text;

    }

}