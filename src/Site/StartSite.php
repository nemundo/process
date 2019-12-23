<?php


namespace Nemundo\Process\Site;


use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\Content\Collection\DocContentCollection;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeCollectionDropdown;
use Nemundo\Process\Content\Com\HyperlinkList\ContentTypeCollectionHyperlinkList;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Content\SearchContentList;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class StartSite extends AbstractSite
{

    /**
     * @var StartSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Start';
        $this->url = 'start';
        StartSite::$site = $this;
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        new ContentSearchForm($page);

        $layout = new BootstrapThreeColumnLayout($page);
        $layout->col1->columnWidth = 2;
        $layout->col2->columnWidth = 5;
        $layout->col3->columnWidth = 5;


        $dropdown = new ContentTypeCollectionDropdown($layout->col1);
        $dropdown->contentTypeCollection = new DocContentCollection();
        $dropdown->redirectSite = StartSite::$site;


        $list = new ContentTypeCollectionHyperlinkList($layout->col1);
        $list->contentTypeCollection = new DocContentCollection();
        $list->redirectSite = StartSite::$site;


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            //    $contentReader->filter->andEqual($contentReader->model->contentTypeId, $contentTypeParameter->getValue());


            $contentType = $contentTypeParameter->getContentType();

            if ($contentType->hasForm()) {
                $form = $contentType->getForm($layout->col2);
                $form->redirectSite=new Site();
            }


            if ($contentType->hasList()) {

                $list = $contentType->getList($layout->col2);
                $list->redirectSite = StartSite::$site;
                $list->redirectSite->addParameter(new ContentTypeParameter());
                $list->redirectParameter = new DataIdParameter();

            }


        }


        $dataIdParameter = new DataIdParameter();
        if ($dataIdParameter->exists()) {

            $contentType = $dataIdParameter->getContentType();
            $view = $contentType->getView($layout->col3);
            $view->dataId =$dataIdParameter->getValue();

        }

$queryParameter = new SearchQueryParameter();
        if ($queryParameter->exists()) {

            $list = new SearchContentList($layout->col2);
            $list->redirectSite = StartSite::$site;
            $list->redirectSite->addParameter($queryParameter);
            $list->redirectParameter=new DataIdParameter();

        }




        $page->render();


    }

}