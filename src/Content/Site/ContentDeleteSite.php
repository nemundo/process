<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Web\Url\UrlReferer;

class ContentDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var ContentDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'content-delete';
        ContentDeleteSite::$site = $this;
    }

    public function loadContent()
    {



        $dataId = (new DataIdParameter())->getValue();



        $reader = new ContentReader();
        $reader->model->loadContentType();
        //$reader->filter->andEqual($reader->model->dataId, $dataId);

        $contentRow = $reader->getRowById($dataId);

        $contentType = $contentRow->contentType->getContentType();

        $contentItem = $contentType->getItem($contentRow->id);
        $contentItem->deleteItem();

        (new UrlReferer())->redirect();



    }


}