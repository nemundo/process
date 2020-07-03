<?php


namespace Nemundo\Process\Cms\Com\Container;


use Nemundo\Html\Block\Div;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Cms\Data\Cms\CmsReader;
use Nemundo\Process\Content\Type\AbstractContentType;


class CmsContainer extends AbstractCmsContainer  // AbstractHtmlContainer
{


    /**
     * @var AbstractContentType
     */
    //public $contentType;


    public function getContent()
    {

        $reader = new CmsReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->filter->andEqual($reader->model->parentId, $this->contentType->getContentId());
        $reader->addOrder($reader->model->itemOrder);
        foreach ($reader->getData() as $cmsRow) {
            $div = new Div($this);
            $cmsRow->content->getContentType()->getView($div);
        }

        return parent::getContent();

    }

}