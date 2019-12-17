<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\Content\AbstractContentType;

class WikiPageContentType extends AbstractContentType
{

    protected function loadContentType()
    {

        $this->id ='b94ec710-d1bd-4430-8866-4a7f9a493c52';
        $this->viewSite= WikiSite::$site;
        $this->parameterClass=WikiParameter::class;

    }


    public function getSubject($dataId)
    {

        $wikiRow = (new WikiReader())->getRowById($dataId);
        $subject = $wikiRow->title;

        return $subject;

    }

}