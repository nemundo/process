<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Core\Debug\Debug;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
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



    //    $dataId = (new DataParameter())->getValue();


/*
        $reader = new ContentReader();
        $reader->model->loadContentType();
        //$reader->filter->andEqual($reader->model->dataId, $dataId);

        $contentRow = $reader->getRowById($dataId);

        $contentType = $contentRow->contentType->getContentType($dataId);*/

        //$contentItem = $contentType->getItem($contentRow->id);
        //$contentItem->deleteItem();

        $contentType = (new ContentParameter())->getContentType();

        //(new Debug())->write($contentType->getSubject());

        $contentType->deleteType();

        (new UrlReferer())->redirect();



    }


}