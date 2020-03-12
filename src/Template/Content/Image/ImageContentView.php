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

        $imageeRow = $this->contentType->getDataRow();

        $img = new BootstrapResponsiveImage($this);
        $img->src = $imageeRow->image->getImageUrl($imageeRow->model->imageAutoSize1200);

        //$img->width = 1200;


        return parent::getContent();

    }

}