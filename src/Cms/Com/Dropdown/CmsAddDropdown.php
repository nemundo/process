<?php


namespace Nemundo\Process\Cms\Com\Dropdown;


use Nemundo\Package\Bootstrap\Dropdown\BootstrapSiteDropdown;
use Nemundo\Process\Cms\Data\CmsType\CmsTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\ParentParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Web\Site\Site;

class CmsAddDropdown extends BootstrapSiteDropdown
{

    /**
     * @var AbstractContentType
     */
    public $parentContentType;

    public function getContent()
    {

        $cmsTypeReader = new CmsTypeReader();
        $cmsTypeReader->model->loadCmsContentType();
        $cmsTypeReader->filter->andEqual($cmsTypeReader->model->parentContentTypeId, $this->parentContentType->typeId);
        foreach ($cmsTypeReader->getData() as $cmsTypeRow) {
            $site = new Site();
            $site->title = $cmsTypeRow->cmsContentType->contentType;
            $site->addParameter(new ParentParameter($this->parentContentType->getContentId()));
            $site->addParameter(new ContentTypeParameter($cmsTypeRow->cmsContentTypeId));
            $this->addSite($site);
        }

        return parent::getContent();

    }

}