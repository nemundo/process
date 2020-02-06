<?php


namespace Nemundo\Process\App\Wiki\Type;


use Nemundo\Process\App\Wiki\Data\WikiType\WikiTypeReader;
use Nemundo\Process\Content\Type\AbstractContentTypeCollection;

class WikiContentTypeCollection extends AbstractContentTypeCollection
{

    protected function loadCollection()
    {

        $wikiTypeReader = new WikiTypeReader();
        $wikiTypeReader->model->loadContentType();
        $wikiTypeReader->addOrder($wikiTypeReader->model->contentType->contentType);
        foreach ($wikiTypeReader->getData() as $wikiTypeRow) {
            $contentType = $wikiTypeRow->contentType->getContentType();
            $this->addContentType($contentType);
        }

    }

}