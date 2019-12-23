<?php


namespace Nemundo\Process\Content\Com\Dropdown;


use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractContentTypeCollection;
use Nemundo\Web\Site\AbstractSite;

class ContentTypeCollectionDropdown extends BootstrapSiteDropdown
{

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    /**
     * @var AbstractContentTypeCollection
     */
    public $contentTypeCollection;





    public function getContent()
    {

        foreach ($this->contentTypeCollection->getContentTypeList() as $contentType) {

            $site = clone($this->redirectSite);
            $site->addParameter(new ContentTypeParameter($contentType->id));
            $site->title = $contentType->type;  //getClassNameWithoutNamespace();
            $this->addSite($site);

        }


        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}