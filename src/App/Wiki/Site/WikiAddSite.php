<?php


namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Content\ContentValue;
use Nemundo\Process\Content\Item\TreeItem;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Item\ContentItem;
use Nemundo\Process\Parameter\ContentParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Url\UrlRedirect;
use Nemundo\Web\Url\UrlReferer;

class WikiAddSite extends AbstractSite
{

    /**
     * @var WikiAddSite
     */
    public static $site;

    protected function loadSite()
    {
   $this->url ='wiki-add';
   WikiAddSite::$site=$this;
    }


    public function loadContent()
    {


        $item = new TreeItem();
        $item->parentId = (new WikiParameter())->getValue();
        $item->dataId = (new DataIdParameter())->getValue();
        $item->saveTree();



        /*
        $contentId = (new ContentParameter())->getValue();
        $wikiId =  (new WikiParameter())->getValue();
        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentRow = $contentReader->getRowById($contentId);


        $item = new ContentItem();
        $item->contentType = $contentRow->contentType->getContentType();
        $item->parentId =$wikiId;
        $item->dataId = $contentRow->dataId;
        $item->saveItem();


        /*
        $value = new ContentValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $wikiId);
        $itemOrder = $value->getMaxValue() + 1;

        //(new Debug())->write($itemOrder);

        $data = new Content();
        $data->contentTypeId = $contentRow->contentTypeId;
        $data->parentId= $wikiId;
        $data->dataId=$contentRow->dataId;
        $data->dateTimeCreated=(new DateTime())->setNow();
        $data->itemOrder=$itemOrder;
        $data->save();*/

        (new UrlReferer())->redirect();

    }

}