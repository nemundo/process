<?php


namespace Nemundo\Process\App\Bookmark\Content;


use Nemundo\Core\Validation\ValidationType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;

class BookmarkContentForm extends AbstractContentForm
{

    /**
     * @var BookmarkContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    private $url;

    /**
     * @var BootstrapTextBox
     */
    private $bookmarkTitle;

    /**
     * @var BootstrapLargeTextBox
     */
    private $description;


    public function getContent()
    {


        $this->url= new BootstrapTextBox($this);
        $this->url->label = 'Url';
        $this->url->validation=true;
        $this->url->validationType = ValidationType::IS_URL;




        return parent::getContent();

    }


    protected function loadUpdateForm()
    {

        $bookmarkRow=$this->contentType->getDataRow();

        $this->url->value = $bookmarkRow->url;
        $this->url->readOnly=true;

        $this->bookmarkTitle = new BootstrapTextBox($this);
        $this->bookmarkTitle->label='Title';
        $this->bookmarkTitle->value=$bookmarkRow->title;

        $this->description=new BootstrapLargeTextBox($this);
        $this->description->label= 'Description';
        $this->description->value=$bookmarkRow->description;


    }


    protected function onSubmit()
    {


        if ($this->contentType->existItem()) {

            $this->contentType->title = $this->bookmarkTitle->getValue();
            $this->contentType->description=$this->description->getValue();

        } else {
            $this->contentType->fromUrl($this->url->getValue());

        }

        $this->contentType->saveType();

    }

}