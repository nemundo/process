<?php


namespace Nemundo\Process\Com\Dropdown;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\WikiAddSite;
use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Parameter\ContentParameter;
use Nemundo\Process\Parameter\ContentTypeParameter;
use Nemundo\Process\Parameter\StatusParameter;
use Nemundo\Process\Status\AbstractStatus;
use Nemundo\Web\Site\AbstractSite;

class ContentDropdown extends BootstrapSiteDropdown
{

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    /**
     * @var AbstractContentType[]
     */
    public $contentTypeFilterList=[];


    public function addContentTypeFilter(AbstractContentType $contentType) {

        $this->contentTypeFilterList[]=$contentType;
        return $this;

    }


    public function getContent()
    {


        $reader = new ContentReader();
        $reader->model->loadContentType();

        foreach ($this->contentTypeFilterList as $contentType) {
            $reader->filter->orEqual($reader->model->contentTypeId,$contentType->id);
        }

        foreach ($reader->getData() as $contentRow) {

            $contentType = $contentRow->contentType->getContentType();

            $site = clone($this->redirectSite);
            $site->addParameter(new ContentParameter($contentRow->id));
            $site->addParameter(new WikiParameter());

            $site->title = $contentType->getSubject($contentRow->dataId);
            $this->addSite($site);

        }


        return parent::getContent();

    }

}