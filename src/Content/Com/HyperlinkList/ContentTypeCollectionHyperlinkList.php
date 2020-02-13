<?php


namespace Nemundo\Process\Content\Com\HyperlinkList;


use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

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

        if ($this->redirectSite == null) {
            $this->redirectSite = new Site();
        }


        $contentTypeParameter = new ContentTypeParameter();

        foreach ($this->contentTypeCollection->getContentTypeList() as $contentType) {


            if ($contentTypeParameter->getValue() == $contentType->typeId) {
                $this->addActiveHyperlink($contentType->typeLabel);
            } else {

                $site = clone($this->redirectSite);
                $site->addParameter(new ContentTypeParameter($contentType->typeId));
                $site->removeParameter(new SearchQueryParameter());
                $site->title = $contentType->typeLabel;
                $this->addSite($site);

            }

        }

        return parent::getContent();
    }

}