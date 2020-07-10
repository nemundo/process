<?php


namespace Nemundo\Process\App\Video\Content\YouTube;


use Nemundo\Core\Http\Url\UrlItem;
use Nemundo\Process\App\Stream\Index\StreamIndexTrait;
use Nemundo\Process\App\Video\Data\YouTube\YouTube;
use Nemundo\Process\App\Video\Data\YouTube\YouTubeReader;
use Nemundo\Process\App\Video\Data\YouTube\YouTubeRow;
use Nemundo\Process\Cms\Index\CmsIndexTrait;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateText\TemplateText;



class YouTubeContentType extends AbstractTreeContentType
{

    //use StreamIndexTrait;
    //use CmsIndexTrait;

    // Favorite


    public $youTubeUrl;

    public $title;

    public $description;


    protected function loadContentType()
    {
        $this->typeId = '5badc331-f0d1-4f14-8eba-e8468a64b9e3';
        $this->typeLabel='YouTube';
        $this->formClass = YouTubeContentForm::class;
        $this->viewClass = YouTubeContentView::class;
    }


    protected function onCreate()
    {


        $urlItem = new UrlItem($this->youTubeUrl);

        $data = new YouTube();  // new TemplateText();
        $data->youtubeId = $urlItem->getParameterValue('v');
        $data->title=$this->title;
        $data->description=$this->description;
        $this->dataId=$data->save();

    }



    /*
    protected function onIndex()
    {

        $this->saveStreamIndex();
        $this->saveCmsIndex();

    }*/


    protected function onDataRow()
    {
        $this->dataRow = (new YouTubeReader())->getRowById($this->getDataId());
    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|YouTubeRow
     */
    public function getDataRow()
    {
        return parent::getDataRow(); // TODO: Change the autogenerated stub
    }


}