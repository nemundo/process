<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Core\Type\Number\YesNo;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Block\Div;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Item\ContentItem;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Web\Site\AbstractSite;

class ContentNewSite extends AbstractSite
{

    /**
     * @var ContentItemSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'New';
        $this->url = 'content-new';
        $this->menuActive=false;
        ContentNewSite::$site = $this;

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $dropdown = new BootstrapSiteDropdown($page);

        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {

            $site = clone(ContentNewSite::$site);
            $site->title = $contentTypeRow->contentType;
            //$site->addParameter(new DataIdParameter());
            $site->addParameter(new ContentTypeParameter($contentTypeRow->id));

            $dropdown->addSite($site);

        }


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentType = (new ContentTypeReader())->getRowById($contentTypeParameter->getValue())->getContentType();

            $form = $contentType->getForm($page);
            $form->redirectSite= ContentNewSite::$site;
            $form->redirectSite->addParameter(new ContentTypeParameter());


            //$form->parentId = $dataId;
            //$form->redirectSite = ContentItemSite::$site;
            //$form->appendParameter=true;

            //$form->redirectSite->addParameter(new DataIdParameter());
            //$form->redirectSite=new Site();

        }



        $page->render();


    }


}