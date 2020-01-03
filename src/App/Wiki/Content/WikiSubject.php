<?php


namespace Nemundo\Process\App\Wiki\Content;


use Nemundo\Process\App\Wiki\Data\Wiki\WikiReader;
use Nemundo\Process\Content\Subject\AbstractContentSubject;

class WikiSubject extends AbstractContentSubject
{

    public function getSubject()
    {

        $wikiRow = (new WikiReader())->getRowById($this->dataId);
        $subject = $wikiRow->title;

        return $subject;


    }


}