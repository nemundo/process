<?php


namespace Nemundo\Process\App\Video\Content\YouTube;


use Nemundo\Package\Bootstrap\FormElement\BootstrapLargeTextBox;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;


class YouTubeContentForm extends AbstractContentForm
{

    /**
     * @var YouTubeContentType
     */
    public $contentType;

    /**
     * @var BootstrapTextBox
     */
    private $url;

    /**
     * @var BootstrapTextBox
     */
    private $videoTitle;

    /**
     * @var BootstrapLargeTextBox
     */
    private $description;


    public function getContent()
    {

        $this->url = new BootstrapTextBox($this);
        $this->url->label = 'YouTube Url';
        $this->url->validation = true;

        $this->videoTitle = new BootstrapTextBox($this);
        $this->videoTitle->label = 'Title';

        $this->description = new BootstrapLargeTextBox($this);
        $this->description->label = 'Description';

        return parent::getContent();

    }

    protected function onSubmit()
    {

        $this->contentType->youTubeUrl = $this->url->getValue();
        $this->contentType->title = $this->videoTitle->getValue();
        $this->contentType->description = $this->description->getValue();
        $this->contentType->saveType();

    }

}