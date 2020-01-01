<?php


namespace Nemundo\Process\Content\Com\HyperlinkList;


use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentTypeCollection;
use Nemundo\Web\Site\AbstractSite;

class ContentTypeCollectionHyperlinkList extends BootstrapHyperlinkList
{

    /**
     * @var AbstractContentTypeCollection
     */
    public $contentTypeCollection;

    /**
     * @var AbstractSite
     */
    public $redirectSite;


    public function getContent()
    {
        $contentTypeParameter = new ContentTypeParameter();

        foreach ($this->contentTypeCollection->getContentTypeList() as $contentType) {


            if ($contentTypeParameter->getValue() == $contentType->contentId) {
                $this->addActiveHyperlink($contentType->type);
            } else {

                $site=clone($this->redirectSite);
                $site->addParameter(new ContentTypeParameter($contentType->contentId));
                $site->removeParameter(new SearchQueryParameter());
                $site->title=$contentType->type;
                $this->addSite($site);

            }

        }

        return parent::getContent();
    }

}