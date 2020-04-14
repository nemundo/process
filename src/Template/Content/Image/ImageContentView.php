<?php


namespace Nemundo\Process\Template\Content\Image;

use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;
use Nemundo\Process\Content\View\AbstractContentView;

class ImageContentView extends AbstractContentView
{

    /**
     * @var ImageContentType
     */
    public $contentType;

    public function getContent()
    {

        $imageRow = $this->contentType->getDataRow();

        $img = new BootstrapResponsiveImage($this);
        $img->src = $imageRow->image->getImageUrl($imageRow->model->imageAutoSize1200);

        return parent::getContent();

    }

}