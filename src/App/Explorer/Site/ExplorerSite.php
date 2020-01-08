<?php


namespace Nemundo\Process\App\Explorer\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\App\Wiki\Data\WikiType\WikiTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class ExplorerSite extends AbstractSite
{

    /**
     * @var ExplorerSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Explorer';
        $this->url = 'explorer';
        // TODO: Implement loadSite() method.
        ExplorerSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);
        $layout->col1->columnWidth = 2;
        $layout->col2->columnWidth = 10;

        $list = new BootstrapHyperlinkList($layout->col1);

        $reader = new WikiTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $wikiTypeRow) {
            $site = clone(ExplorerSite::$site);
            $site->title = $wikiTypeRow->contentType->contentType;
            $site->addParameter(new ContentTypeParameter($wikiTypeRow->contentTypeId));
            $list->addSite($site);
        }


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {

            $contentType = $contentTypeParameter->getContentType();

            if ($contentType->hasForm()) {
                $form = $contentType->getForm($layout->col2);
                $form->redirectSite = new Site();
            }

            if ($contentType->hasList()) {
                $list = $contentType->getList($layout->col2);
                $list->redirectSite = ExplorerSite::$site;
            }


        }


        $page->render();

    }

}