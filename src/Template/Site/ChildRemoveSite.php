<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Template\Content\Source\Remove\ChildRemoveContentType;
use Nemundo\Core\Http\Url\UrlReferer;

class ChildRemoveSite extends AbstractDeleteIconSite
{

    /**
     * @var ChildRemoveSite
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

        $type = new ChildRemoveContentType();
        $type->parentId = (new ParentParameter())->getValue();
        $type->removeId = (new ChildParameter())->getValue();
        $type->saveType();

        (new UrlReferer())->redirect();

    }

}