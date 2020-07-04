<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Html\Form\Input\AcceptFileType;
use Nemundo\Package\Bootstrap\FormElement\BootstrapFileUpload;
use Nemundo\Package\Bootstrap\Image\BootstrapResponsiveImage;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Template\Content\File\AbstractFileContentForm;
use Nemundo\Process\Template\Content\File\AbstractFileContentType;

abstract class AbstractImageContentForm extends AbstractContentForm
{

    /**
     * @var AbstractImageContentType
     */
    public $contentType;

    /**
     * @var BootstrapFileUpload
     */
    protected $image;


    protected function loadContainer()
    {

        parent::loadContainer();

        $this->image = new BootstrapFileUpload($this);
        $this->image->label = 'Image';
        $this->image->multiUpload = false;
        //$this->image->acceptFileType = AcceptFileType::WEB_IMAGE;
        $this->image->acceptFileType = AcceptFileType::IMAGE;

        //parent::loadContainer();

    }

    protected function loadUpdateForm()
    {

        $imgRow = $this->contentType->getDataRow();

        $img=new BootstrapResponsiveImage($this);
        $img->src=$imgRow->image->getImageUrl($imgRow->model->imageAutoSize400);


    }


    protected function onSubmit()
    {

        $this->contentType->image->fromFileRequest($this->image->getFileRequest());
        $this->contentType->saveType();

    }



}