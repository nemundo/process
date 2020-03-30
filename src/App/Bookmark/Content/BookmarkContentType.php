<?php


namespace Nemundo\Process\App\Bookmark\Content;


use Nemundo\Crawler\HtmlParser\HtmlParser;
use Nemundo\Process\App\Bookmark\Data\Bookmark\Bookmark;
use Nemundo\Process\App\Bookmark\Data\Bookmark\BookmarkReader;
use Nemundo\Process\App\Bookmark\Data\Bookmark\BookmarkRow;
use Nemundo\Process\App\Bookmark\Data\Bookmark\BookmarkUpdate;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class BookmarkContentType extends AbstractTreeContentType
{

    public $url;

    public $title;

    public $description;


    protected function loadContentType()
    {


        $this->typeLabel = 'Bookmark';
        $this->typeId = '0abbd11d-5321-4eef-a984-0e4061c5738d';

        $this->formClass = BookmarkContentForm::class;
        $this->viewClass = BookmarkContentView::class;

        // TODO: Implement loadContentType() method.
    }


    protected function onCreate()
    {

        $data = new Bookmark();
        $data->url = $this->url;
        $data->title = $this->title;
        $data->description = $this->description;
        $this->dataId = $data->save();

    }


    protected function onUpdate()
    {

        $update = new BookmarkUpdate();
        $update->title = $this->title;
        $update->description = $this->description;
        $update->updateById($this->dataId);

    }


    protected function onDataRow()
    {

        $this->dataRow = (new BookmarkReader())->getRowById($this->dataId);

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|BookmarkRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
    }

    public function fromUrl($url)
    {

        $crawler = new HtmlParser();
        $crawler->fromUrl($url);

        $this->url = $url;
        $this->title = $crawler->getPageTitle();
        $this->description = $crawler->getDescription();

        return $this;

    }


}