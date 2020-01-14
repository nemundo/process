<?php


namespace Nemundo\Process\Template\Content\AddSource;


use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Workflow\Content\Form\AbstractStatusForm;
use Schleuniger\App\Prozesssteuerung\Content\Projekt\ProzesssteuerungProjektContentType;

class AddSourceContentForm extends AbstractContentForm
{

    /**
     * @var BootstrapListBox
     */
    private $source;

    public function getContent()
    {

        $this->source = new BootstrapListBox($this);
        $this->source->label='Quelle';
        $this->source->validation=true;

        $reader = new ContentReader();
        $reader->filter->andEqual($reader->model->contentTypeId,(new ProzesssteuerungProjektContentType())->typeId);
        $reader->addOrder($reader->model->subject);
        foreach ($reader->getData() as $contentRow) {
            $this->source->addItem($contentRow->id, $contentRow->subject);
        }

        return parent::getContent();

    }



    protected function onSubmit()
    {

        $type=new AddSourceContentType();
        $type->parentId=$this->parentId;
        $type->sourceId=$this->source->getValue();
        $type->saveType();

        // TODO: Implement onSubmit() method.
    }


}