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
use Nemundo\Process\App\Wiki\Com\WikiNavigation;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Type\WikiContentTypeCollection;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeCollectionDropdown;

use Nemundo\Process\Content\Com\Table\ContentLogTable;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Workflow\Com\Table\WorkflowLogTable;
use Nemundo\Web\Site\AbstractSite;


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

        new WikiNewSite($this);
        new AdminSite($this);

        //new WikiAddSite($this);
        new ContentDeleteSite($this);
        new ContentEditSite($this);
        new ContentRemoveSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new WikiNavigation($page);


        $layout = new BootstrapThreeColumnLayout($page);
        $layout->col1->columnWidth = 2;
        $layout->col2->columnWidth = 5;
        $layout->col3->columnWidth = 5;


        /*
        $form = new WikiPageContentForm($layout->col1);
        $form->appendParameter = true;
        $form->redirectSite = WikiSite::$site;
*/

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
            $wikiType = new WikiPageContentType($wikiId);

            $contentTable =new ContentLogTable($layout->col3);
            $contentTable->contentType = $wikiType;

            $title = new AdminTitle($layout->col2);
            $title->content = $wikiType->getSubject();


            /*
            if ((new GroupCheck())->isMemberOfGroup(new WikiEditorGroup())) {

                $type = new TitleChangeContentType();
                $type->parentId = $wikiType->getContentId();
                $form = $type->getForm($layout->col2);
                //$form->parentId = $wikiType->getContentId();

            }*/

            $dropdown = new ContentTypeCollectionDropdown($layout->col2);
            $dropdown->contentTypeCollection = new WikiContentTypeCollection();

            $dropdown->redirectSite = WikiSite::$site;
            $dropdown->redirectSite->addParameter(new WikiParameter());
            $dropdown->groupRestricted = true;
            $dropdown->addRestrictedGroup(new WikiEditorGroup());
            //$dropdown->visible=false;


            $contentTypeParameter = new ContentTypeParameter();
            if ($contentTypeParameter->exists()) {

                $contentTypeParameter->addAllowedContentTypeCollection(new WikiContentTypeCollection());
                $contentType = $contentTypeParameter->getContentType();
                $contentType->parentId = $wikiType->getContentId();

                $form = $contentType->getForm($layout->col2);
                           $form->appendParameter = false;
                $form->redirectSite = WikiSite::$site;
                $form->redirectSite->addParameter(new WikiParameter());

            }


            foreach ($wikiType->getChild() as $contentRow) {

                $contentType = $contentRow->getContentType();

                if ($contentType !== null) {

                    if ($contentType->hasView()) {

                        $subtitle = new AdminSubtitle($layout->col2);
                        $subtitle->content = $contentType->getSubject() . ' - ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat();

                        $btn = new AdminIconSiteButton($layout->col2);
                        $btn->site = clone(ContentDeleteSite::$site);
                        $btn->site->addParameter(new ContentParameter($contentRow->id));

                        $btn = new AdminIconSiteButton($layout->col2);
                        $btn->site = clone(ContentRemoveSite::$site);
                        $btn->site->addParameter(new ContentParameter($contentRow->id));
                        $btn->site->addParameter(new WikiParameter($wikiId));

                        $btn = new AdminIconSiteButton($layout->col2);
                        $btn->site = clone(ContentEditSite::$site);
                        $btn->site->addParameter(new ContentParameter($contentRow->id));
                        $btn->site->addParameter(new WikiParameter());

                        if ($contentType->hasViewSite()) {
                            $btn = new AdminSiteButton($layout->col2);
                            $btn->site = $contentType->getViewSite();
                        }

                        $div = new Div($layout->col2);
                        $contentType->getView($div);

                        (new Hr($layout->col2));

                    }

                }

            }

        }

        $page->render();

    }

}