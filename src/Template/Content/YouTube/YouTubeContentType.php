<?php


namespace Nemundo\Process\Template\Content\YouTube;


use Nemundo\Core\Http\Url\UrlItem;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;
use Nemundo\Process\Template\Data\Youtube\Youtube;


class YouTubeContentType extends AbstractTreeContentType
{

    public $youTubeUrl;

    protected function loadContentType()
    {
        $this->typeId = '5badc331-f0d1-4f14-8eba-e8468a64b9e3';
        $this->typeLabel='YouTube';
        $this->formClass = YoutubeContentForm::class;
        $this->viewClass = YoutubeContentView::class;
    }


    protected function onCreate()
    {

        //$url = $this->url->getValue();

        $urlItem = new UrlItem($this->youTubeUrl);

        $data = new TemplateText();
        $data->text = $urlItem->getParameterValue('v');
        $this->dataId=$data->save();

        /*$data = new Youtube();
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