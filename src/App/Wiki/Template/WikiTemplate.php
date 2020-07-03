<?php


namespace Nemundo\Process\App\Wiki\Template;


use Nemundo\Com\Template\AbstractTemplateDocument;
use Nemundo\Process\App\Wiki\Com\WikiNavigation;

class WikiTemplate extends AbstractTemplateDocument
{

    protected function loadContainer()
    {

        parent::loadContainer();
        new WikiNavigation($this);

    }

}