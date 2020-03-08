<?php


namespace Nemundo\Process\App\Document\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Document\Com\DocumentTabs;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\AbstractSite;

class DocumentNewSite extends AbstractSite
{

    /**
     * @var DocumentNewSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title='New';
        $this->url='new';

        DocumentNewSite::$site=$this;

        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new DocumentTabs($page);


        $parameter=new ContentTypeParameter();
        $parameter->contentTypeCheck=false;
       $form =  $parameter->getContentType()->getForm($page);
$form->redirectSite = DocumentSite::$site;

        $page->render();


    }

}