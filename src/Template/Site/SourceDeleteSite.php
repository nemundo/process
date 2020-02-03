<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Template\Content\SourceRemove\SourceRemoveContentType;
use Nemundo\Web\Url\UrlReferer;

// SourceRemoveSite
class SourceDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var FileInactiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'source-delete';
        $this->menuActive = false;
        SourceDeleteSite::$site = $this;
    }


    public function loadContent()
    {

      //  $childId = (new ChildParameter())->getValue();

        $type = new SourceRemoveContentType();
        $type->parentId = (new ChildParameter())->getValue();//(new ContentParameter())->getValue();
        $type->removeId=(new ChildParameter())->getValue();
        $type->saveType();


        //$contentType = (new ContentParameter())->getContentType();
        //$contentType->removeChild($childId);

        (new UrlReferer())->redirect();

    }

}