<?php


namespace Nemundo\Process\Template\View;


use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;
use Nemundo\Process\Content\View\AbstractContentView;

class WebImageContentView extends AbstractContentView
{

    public function getContent()
    {

        $img = new BootstrapResponsiveImage($this);
        $img->src = 'http://bielenbahn.ch/images/webcam/livebild.jpg';
        $img->width = 500;

        return parent::getContent();
    }

}