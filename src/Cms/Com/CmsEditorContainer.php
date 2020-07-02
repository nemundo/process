<?php


namespace Nemundo\Process\Cms\Com;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Html\Block\Div;
use Nemundo\Html\Block\Hr;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\JqueryUi\Sortable\JquerySortable;
use Nemundo\Process\App\Wiki\Group\WikiEditorGroup;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\App\Wiki\Site\ContentDeleteSite;
use Nemundo\Process\App\Wiki\Site\ContentEditSite;
use Nemundo\Process\App\Wiki\Site\ContentRemoveSite;
use Nemundo\Process\App\Wiki\Site\WikiSite;
use Nemundo\Process\App\Wiki\Type\WikiContentTypeCollection;
use Nemundo\Process\Cms\Data\Cms\CmsReader;
use Nemundo\Process\Cms\Event\CmsEvent;
use Nemundo\Process\Cms\Site\CmsSortableSite;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeCollectionDropdown;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Web\Site\Site;


// CmsContainerEditor
class CmsEditorContainer extends AbstractHtmlContainer
{


    /**
     * @var AbstractContentType
     */
    //public $contentType;


    public $parentId;


    public function getContent()
    {

        $p=new Paragraph($this);
        $p->content='CMS Container';

        //$p=new Paragraph($this);
        //$p->content='Parent Id:'.$this->contentType->getContentId();


        $dropdown = new ContentTypeCollectionDropdown($this);
        $dropdown->contentTypeCollection = new WikiContentTypeCollection();


        /*
        $dropdown->redirectSite = WikiSite::$site;
        $dropdown->redirectSite->addParameter(new WikiParameter());
        $dropdown->groupRestricted = true;
        $dropdown->addRestrictedGroup(new WikiEditorGroup());
        //$dropdown->visible=false;*/


        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->exists()) {

            $contentTypeParameter->addAllowedContentTypeCollection(new WikiContentTypeCollection());
            $contentType = $contentTypeParameter->getContentType();
            $contentType->parentId =$this->parentId;  // $this->contentType->getContentId();
            $contentType->addEvent(new CmsEvent());

            $form = $contentType->getForm($this);
            $form->appendParameter = false;
            $form->redirectSite = new Site();  // WikiSite::$site;
            $form->redirectSite->removeParameter(new ContentTypeParameter());
            //$form->redirectSite->addParameter(new WikiParameter());

        }





        $sortableDiv= new JquerySortable($this);
        $sortableDiv->tagName='div';
        $sortableDiv->id='cms_sortable1';
        $sortableDiv->sortableSite=CmsSortableSite::$site;


        $reader=new CmsReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->filter->andEqual($reader->model->parentId, $this->parentId);  // $this->contentType->getContentId());
        $reader->addOrder($reader->model->itemOrder);
        foreach ($reader->getData() as $cmsRow) {

            $div=new Div($sortableDiv);
            $div->id = 'item_'.$cmsRow->id;
            $cmsRow->content->getContentType()->getView($div);

        }





        /*
        foreach ($this->contentType->getChild() as $contentRow) {

            $contentType = $contentRow->getContentType();

            if ($contentType !== null) {

                if ($contentType->hasView()) {

                    $subtitle = new AdminSubtitle($layout->col2);
                    $subtitle->content = $contentType->getSubject() . ' - ' . $contentRow->dateTime->getShortDateTimeLeadingZeroFormat();

                    $btn = new AdminIconSiteButton($layout->col2);
                    $btn->site = clone(ContentDeleteSite::$site);
                    $btn->site->addParameter(new ContentParameter($contentRow->id));

                    $btn = new AdminIconSiteButton($layout->col2);
                    $btn->site = clone(ContentRemoveSite::$site);
                    $btn->site->addParameter(new ContentParameter($contentRow->id));
                    $btn->site->addParameter(new WikiParameter($wikiId));

                    $btn = new AdminIconSiteButton($layout->col2);
                    $btn->site = clone(ContentEditSite::$site);
                    $btn->site->addParameter(new ContentParameter($contentRow->id));
                    $btn->site->addParameter(new WikiParameter());

                    if ($contentType->hasViewSite()) {
                        $btn = new AdminSiteButton($layout->col2);
                        $btn->site = $contentType->getViewSite();
                    }

                    $div = new Div($layout->col2);
                    $contentType->getView($div);

                    (new Hr($layout->col2));

                }

            }

        }*/




        return parent::getContent(); // TODO: Change the autogenerated stub

    }


}