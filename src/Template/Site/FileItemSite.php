<?php


namespace Nemundo\Process\Template\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\Content\Com\Table\SourceTable;
use Nemundo\Process\Template\Content\AddSource\AddSourceContentType;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Process\Template\Parameter\FileParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class FileItemSite extends AbstractSite
{
    /**
     * @var FileItemSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->url = 'file-item';
        $this->menuActive = false;

        FileItemSite::$site = $this;

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $layout = new BootstrapTwoColumnLayout($page);


        $fileId = (new FileParameter())->getValue();

        $fileType = (new FileContentType($fileId));
        $fileType->getView($layout->col1);


        $btn = new AdminSiteButton($layout->col2);
        $btn->site= clone(PdfExtractSite::$site);
        $btn->site->addParameter(new FileParameter());


        $table = new SourceTable($layout->col2);
        $table->contentType = $fileType;


        $type = new AddSourceContentType();
        //$type->parentId = $fileType->getContentId();

        $form = $type->getForm($layout->col2);
        $form->parentId = $fileType->getContentId();
        $form->redirectSite=new Site();


        $page->render();

    }

}