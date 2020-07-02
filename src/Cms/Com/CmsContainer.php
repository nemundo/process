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
use Nemundo\Process\Cms\Site\CmsSortableSite;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeCollectionDropdown;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Web\Site\Site;


// CmsContainerEditor
class CmsContainer extends AbstractHtmlContainer
{


    /**
     * @var AbstractContentType
     */
    public $contentType;


    public function getContent()
    {

        $p=new Paragraph($this);
        $p->content='CMS Container';

        $p=new Paragraph($this);
        $p->content='Parent Id:'.$this->contentType->getContentId();


        $reader=new CmsReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->filter->andEqual($reader->model->parentId, $this->contentType->getContentId());
        $reader->addOrder($reader->model->itemOrder);
        foreach ($reader->getData() as $cmsRow) {
            $div=new Div($this);
            $cmsRow->content->getContentType()->getView($div);
        }

        return parent::getContent();

    }


}