<?php


namespace Nemundo\Process\Search\Row;


use Nemundo\Core\Text\SnippetText;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexRow;

class SearchIndexCustomRow extends SearchIndexRow
{


    public function getSearchTitle() {


        $contentType = $indexRow->content->getContentType();
        $row->addText($bold->getBoldText($contentType->getSubject()));
        $row->addText($indexRow->content->contentType->contentType);

        $snippet = new SnippetText();
        $textSnippet = $snippet->getSnippet($queryParameter->getValue(), $contentType->getText());
        $row->addText($bold->getBoldText($textSnippet));

        if ($contentType->hasViewSite()) {
            $site = $contentType->getViewSite();
            $row->addClickableSite($site);
        }


    }


    public function getSearchText() {



    }



}