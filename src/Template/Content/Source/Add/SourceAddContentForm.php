<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;
use Nemundo\Process\App\Document\Data\Document\DocumentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Form\AbstractContentForm;


class SourceAddContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapListBox
     */
    private $content;

    public function getContent()
    {

        $sourceId = (new SourceParameter())->getValue();

        $sourceContentType = (new ContentTypeReader())->getRowById($sourceId)->getContentType();

        $this->content = new BootstrapListBox($this);
        $this->content->label = $sourceContentType->typeLabel;
        $this->content->validation = true;

        $documentReader = new DocumentReader();
        $documentReader->filter->andEqual($documentReader->model->documentTypeId, $sourceId);
        $documentReader->filter->andEqual($documentReader->model->closed, false);
        $documentReader->addOrder($documentReader->model->title);
        foreach ($documentReader->getData() as $documentRow) {
            $this->content->addItem($documentRow->contentId, $documentRow->title);
        }

        return parent::getContent();

    }


    protected function onSubmit()
    {

        $this->contentType->sourceId = $this->content->getValue();
        $this->contentType->saveType();

    }

}