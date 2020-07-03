<?php


namespace Nemundo\Process\Cms\Com\Container;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Html\Block\Div;
use Nemundo\Package\JqueryUi\Sortable\JquerySortable;
use Nemundo\Process\Cms\Com\Dropdown\CmsAddDropdown;
use Nemundo\Process\Cms\Data\Cms\CmsReader;
use Nemundo\Process\Cms\Event\CmsEvent;
use Nemundo\Process\Cms\Parameter\CmsParameter;
use Nemundo\Process\Cms\Site\CmsDeleteSite;
use Nemundo\Process\Cms\Site\CmsSortableSite;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Web\Site\Site;


// CmsContainerEditor
class CmsEditorContainer extends AbstractCmsContainer  // AbstractHtmlContainer
{


    /**
     * @var AbstractContentType
     */
    //public $contentType;


    //public $parentId;


    public function getContent()
    {


        $parentId = $this->contentType->getContentId();

        //(new Debug())->write($parentId);

        $dropdown = new CmsAddDropdown($this);
        $dropdown->parentContentType = $this->contentType;

        $contentTypeParameter = new ContentTypeParameter();
        $contentTypeParameter->contentTypeCheck = false;
        if ($contentTypeParameter->exists()) {

            $contentType = $contentTypeParameter->getContentType();
            $contentType->parentId = $parentId;
            $contentType->addEvent(new CmsEvent());

            $form = $contentType->getForm($this);
            $form->appendParameter = false;
            $form->redirectSite = new Site();
            $form->redirectSite->removeParameter(new ContentTypeParameter());

        }

        $sortableDiv = new JquerySortable($this);
        $sortableDiv->tagName = 'div';
        $sortableDiv->id = 'cms_sortable1';
        $sortableDiv->sortableSite = CmsSortableSite::$site;

        $reader = new CmsReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->filter->andEqual($reader->model->parentId, $parentId);
        $reader->addOrder($reader->model->itemOrder);
        foreach ($reader->getData() as $cmsRow) {

            $div = new Div($sortableDiv);
            $div->id = 'item_' . $cmsRow->id;
            $cmsRow->content->getContentType()->getView($div);

            $btn = new AdminIconSiteButton($div);
            $btn->site = clone(CmsDeleteSite::$site);
            $btn->site->addParameter(new CmsParameter($cmsRow->id));

        }

        return parent::getContent();

    }

}