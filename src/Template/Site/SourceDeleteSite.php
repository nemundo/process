<?php

namespace Nemundo\Process\Template\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;

use Nemundo\Process\Content\Parameter\ChildParameter;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Workflow\Content\Item\Status\StatusItem;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Process\Template\Parameter\DocumentParameter;
use Nemundo\Process\Template\Status\DocumentDeleteProcessStatus;
use Nemundo\Web\Url\UrlReferer;


class SourceDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var FileDeleteSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url = 'source-delete';
        $this->menuActive = false;
        SourceDeleteSite::$site= $this;
    }



    public function loadContent()
    {

        $childId = (new ChildParameter())->getValue();

        $contentType = (new ContentParameter())->getContentType();
$contentType->removeChild($childId);

        (new UrlReferer())->redirect();

    }

}