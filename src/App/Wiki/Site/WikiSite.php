<?php

namespace Nemundo\Process\App\Wiki\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Block\Hr;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\App\News\Type\NewsContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentForm;
use Nemundo\Process\App\Wiki\Content\WikiPageContentItem;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Template\Container\DocumentParentContainer;
use Nemundo\Process\Template\Type\DocumentContentType;
use Nemundo\Process\Template\Type\LargeTextContentType;
use Nemundo\Process\Template\Type\WebImageContentType;
use Nemundo\Process\Template\Type\YoutubeContentType;
use Nemundo\ToDo\Com\ToDoParentContainer;
use Nemundo\ToDo\Workflow\Process\ToDoProcess;
use Nemundo\ToDo\Workflow\Type\ToDoAddContentType;
use Nemundo\Web\Site\AbstractSite;
use Schleuniger\App\ChangeRequest\Workflow\Process\EcrProcess;

class WikiSite extends AbstractSite
{

    /**
     * @var WikiSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Wiki';
        $this->url = 'wiki';
        WikiSite::$site = $this;

        new WikiAddSite($this);
        new ContentDeleteSite($this);
        new ContentEditSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $layout = new BootstrapThreeColumnLayout($page);
        $layout->col1->columnWidth = 2;
        $layout->col2->columnWidth = 5;
        $layout->col3->columnWidth = 5;


        $form = new WikiPageContentForm($layout->col1);
        $form->redirectSite = WikiSite::$site;


        $list = new BootstrapHyperlinkList($layout->col1);

        $reader = new WikiReader();
        $reader->addOrder($reader->model->title);
        foreach ($reader->getData() as $wikiRow) {

            $site = clone(WikiSite::$site);
            $site->title = $wikiRow->title;
            $site->addParameter(new WikiParameter($wikiRow->id));

            $list->addSite($site);

        }


        $wikiParameter = new WikiParameter();
        if ($wikiParameter->exists()) {

            $wikiId = $wikiParameter->getValue();

            $wikiItem = new WikiPageContentItem($wikiId);

            $wikiType = new WikiPageContentType();

            $title = new AdminTitle($layout->col2);
            $title->content = $wikiType->getSubject($wikiId);   //Item->getSubject();  //Row->title;


            $wikiRow = (new WikiReader())->getRowById($wikiId);

            $title = new AdminTitle($layout->col2);
            $title->content = $wikiRow->title;

            $dropdown = new ContentTypeDropdown($layout->col2);
            $dropdown->redirectSite = WikiSite::$site;
            $dropdown->redirectSite->addParameter(new WikiParameter());
            $dropdown->addContentType(new LargeTextContentType());
            $dropdown->addContentType(new ToDoProcess());
            /*$dropdown->addContentType(new IssueTrackerProcess());
            $dropdown->addContentType(new PhotoContentType());*/
            $dropdown->addContentType(new WebImageContentType());
            $dropdown->addContentType(new EcrProcess());
            $dropdown->addContentType(new YoutubeContentType());
            $dropdown->addContentType(new NewsContentType());
            $dropdown->addContentType(new DocumentContentType());
            $dropdown->addContentType(new ToDoAddContentType());


            /*$dropdown = new ContentDropdown($layout->col2);
            $dropdown->redirectSite = WikiAddSite::$site;
            $dropdown->redirectSite->addParameter(new WikiParameter());*/
            //$dropdown->addContentTypeFilter(new ToDoProcess());
            //$dropdown->addContentTypeFilter(new IssueTrackerProcess());


            $contentTypeParameter = new ContentTypeParameter();
            if ($contentTypeParameter->exists()) {

                $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();

                $form = $contentType->getForm($layout->col2);
                $form->parentId = $wikiId;
                $form->redirectSite = WikiSite::$site;
                $form->redirectSite->addParameter(new WikiParameter());

            }



            foreach ($wikiItem->getChild() as $contentRow) {

                $contentType = $contentRow->contentType->getContentType();

                $subtitle = new AdminSubtitle($layout->col2);
                $subtitle->content = $contentType->getSubject($contentRow->dataId) . ' - ' . $contentRow->dateTimeCreated->getShortDateTimeFormat() . ' ' . $contentRow->itemOrder;

                $btn = new AdminIconSiteButton($layout->col2);
                $btn->site = clone(ContentDeleteSite::$site);
                $btn->site->addParameter(new ContentParameter($contentRow->id));

                $btn = new AdminIconSiteButton($layout->col2);
                $btn->site = clone(ContentEditSite::$site);
                $btn->site->addParameter(new ContentParameter($contentRow->id));


                if ($contentType->hasViewSite()) {
                    $btn = new AdminSiteButton($layout->col2);
                    $btn->site = $contentType->getViewSite($contentRow->dataId);
                }

                $div = new Div($layout->col2);

                $view = $contentType->getView($div);
                $view->dataId = $contentRow->dataId;

                (new Hr($layout->col2));

            }


            $container = new ToDoParentContainer($layout->col3);
            $container->parentId = $wikiId;

            $container = new DocumentParentContainer($layout->col3);
            $container->parentId = $wikiId;

        }


        $page->render();


    }
}