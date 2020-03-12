<?php


namespace Nemundo\Process\Template\Content\YouTube;


use Nemundo\Core\Http\Url\Url;
use Nemundo\Core\Http\Url\UrlBuilder;
use Nemundo\Core\Http\Url\UrlItem;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Data\Youtube\Youtube;


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

    public function getContent()
    {

        $this->url = new BootstrapTextBox($this);
        $this->url->label = 'YouTube Url';
        $this->url->validation = true;

        return parent::getContent();

    }

    protected function onSubmit()
    {

        $this->contentType->youTubeUrl=$this->url->getValue();
        $this->contentType->saveType();



//        new Youtube

       // https://www.youtube.com/watch?v=SjYdIKI2DlA

      //  new Url()


        /*
        $url = $this->url->getValue();

        $urlItem = new UrlItem($url);

        $data = new Youtube();
        $data->url = $this->url->getValue();
        $data->youtubeId=$urlItem->getParameterValue('v');
        $dataId = $data->save();


        $item = new ContentItem();
        $item->parentId = $this->parentId;
        $item->contentType = new YoutubeContentType();
        $item->dataId = $dataId;
        $item->saveItem();*/


    }

}