<?php


namespace Nemundo\Process\Cms\Com\Container;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Block\Div;
use Nemundo\Package\JqueryUi\Sortable\JquerySortable;
use Nemundo\Process\Cms\Com\Dropdown\CmsAddDropdown;
use Nemundo\Process\Cms\Data\Cms\CmsReader;
use Nemundo\Process\Cms\Event\CmsEvent;
use Nemundo\Process\Cms\Parameter\CmsParameter;
use Nemundo\Process\Cms\Parameter\EditParameter;
use Nemundo\Process\Cms\Site\CmsDeleteSite;
use Nemundo\Process\Cms\Site\CmsSortableSite;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\Site;


class CmsEditorContainer extends AbstractCmsContainer
{

    public $editorName;


    public function getContent()
    {

        $parentId = $this->contentType->getContentId();

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
        $sortableDiv->id = 'cms_sortable_'.$this->editorName;
        $sortableDiv->sortableSite = CmsSortableSite::$site;

        $cmsReader = new CmsReader();
        $cmsReader->model->loadContent();
        $cmsReader->model->content->loadContentType();
        $cmsReader->filter->andEqual($cmsReader->model->parentId, $parentId);
        $cmsReader->addOrder($cmsReader->model->itemOrder);
        foreach ($cmsReader->getData() as $cmsRow) {


            $div = new Div($sortableDiv);
            $div->id = 'item_' . $cmsRow->id;

            $widget=  new AdminWidget($div);


            $editParameter = new EditParameter();
            if ($editParameter->exists()) {

                $contentParameter = new ContentParameter();
                $contentParameter->contentTypeCheck = false;
                //$contentParameter->addAllowedContentTypeCollection(new WikiContentTypeCollection());

                if ($contentParameter->getValue() == $cmsRow->contentId) {
                    $contentType = $contentParameter->getContentType();  // $contentRow->getContentType();
                    $form = $contentType->getForm($div);
                    $form->redirectSite=new Site();
                    $form->redirectSite->removeParameter(new EditParameter());
                }

            }


            $contentType = $cmsRow->content->getContentType();
            $contentType->getView($widget);

            $widget->widgetTitle=$contentType->getSubject();

            $btn = new AdminIconSiteButton($div);
            $btn->site = clone(CmsDeleteSite::$site);
            $btn->site->addParameter(new CmsParameter($cmsRow->id));

            $btn = new AdminSiteButton($div);
            $btn->site = new Site();
            $btn->site->addParameter(new EditParameter());
            $btn->site->addParameter(new ContentParameter($cmsRow->contentId));  //->contentTypeId));
            $btn->content = 'Edit';


        }

        return parent::getContent();

    }

}