<?php


namespace Nemundo\Process\App\Wiki\Page;


use Nemundo\Com\Template\AbstractTemplateDocument;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\App\Wiki\Template\WikiTemplate;

class WikiNewPage extends WikiTemplate  // AbstractTemplateDocument
{

    public function getContent()
    {

        $layout=new BootstrapTwoColumnLayout($this);

        $form = (new WikiPageContentType())->getForm($layout->col1);
        $form->appendParameter = true;
        $form->redirectSite = WikiSite::$site;

        return parent::getContent();

    }

}