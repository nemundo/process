<?php


namespace Nemundo\Process\Template\Content\ImageList;


use Nemundo\Package\Bootstrap\Carousel\BootstrapImageCarousel;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Template\Data\TemplateImageIndex\TemplateImageIndexReader;

class ImageListContentView extends AbstractContentView
{

    /**
     * @var ImageListContentType
     */
    public $contentType;

    public function getContent()
    {

        $carousel = new BootstrapImageCarousel($this);
        $carousel->slideEffect = false;
        $reader = new TemplateImageIndexReader();
        $reader->filter->andEqual($reader->model->parentId, $this->contentType->getContentId());
        foreach ($reader->getData() as $row) {
            $carousel->addImage($row->urlSmall);
        }

        return parent::getContent();

    }

}