<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\Source\Remove\ChildRemoveContentType;
use Nemundo\Process\Template\Content\SourceRemove\SourceRemoveContentType;
use Nemundo\Web\Url\UrlReferer;

// SourceRemoveSite
class ChildRemoveSite extends AbstractDeleteIconSite
{

    /**
     * @var FileInactiveSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'child-delete';
        $this->menuActive = false;
        ChildRemoveSite::$site = $this;
    }


    public function loadContent()
    {

      //  $childId = (new ChildParameter())->getValue();


        $type=new ChildRemoveContentType();
        $type->parentId = (new ParentParameter())->getValue();//(new ContentParameter())->getValue();
        $type->removeId=(new ChildParameter())->getValue();
        $type->saveType();



        /*
        $type = new SourceRemoveContentType();
        $type->parentId = (new ChildParameter())->getValue();//(new ContentParameter())->getValue();
        $type->removeId=(new ChildParameter())->getValue();
        $type->saveType();*/


        //$contentType = (new ContentParameter())->getContentType();
        //$contentType->removeChild($childId);

        (new UrlReferer())->redirect();

    }

}