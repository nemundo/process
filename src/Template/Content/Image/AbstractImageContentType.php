<?php

namespace Nemundo\Process\Template\Content\Image;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Model\Data\Property\File\FileProperty;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImage;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImageDelete;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImageReader;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImageRow;
use Nemundo\Process\Template\Data\TemplateImage\TemplateImageUpdate;
use Nemundo\Process\Template\Data\TemplateImageIndex\TemplateImageIndex;
use Nemundo\Process\Template\Data\TemplateImageIndex\TemplateImageIndexDelete;

abstract class AbstractImageContentType extends AbstractTreeContentType
{

    /**
     * @var FileProperty
     */
    public $image;

    public function __construct($dataId = null)
    {

        $this->typeLabel[LanguageCode::EN] = 'Image';
        $this->typeLabel[LanguageCode::DE] = 'Bild';

        $this->formClass = ImageContentForm::class;
        $this->viewClass = ImageContentView::class;

        $this->image = new FileProperty();

        parent::__construct($dataId);

    }


    protected function onCreate()
    {

        $data = new TemplateImage();
        $data->active = true;
        $data->image->fromFileProperty($this->image);
        $this->dataId = $data->save();

    }


    protected function onIndex()
    {

        //$imageRow = (new TemplateImageReader())->getRowById($this->dataId);  // $this->getDataRow();


        // resize image

        if ($this->isActive()) {

            $imageRow = $this->getDataRow();

            $data = new TemplateImageIndex();
            $data->updateOnDuplicate = true;
            $data->parentId = $this->getParentId();
            $data->contentId = $this->getContentId();
            $data->urlSmall = $imageRow->image->getImageUrl($imageRow->model->imageAutoSize400);
            $data->urlLarge = $imageRow->image->getImageUrl($imageRow->model->imageAutoSize1200);
            $data->save();

        } else {

            $this->deleteImageIndex();

        }

        /*
        foreach ($this->getParentContent() as $parentRow) {

        $data = new TemplateImageIndex();
        $data->parentId = $parentRow->id;  // $this->getParentId();
        $data->contentId = $this->getContentId();
        $data->urlSmall = $imageRow->image->getImageUrl($imageRow->model->imageAutoSize400);
        $data->urlLarge = $imageRow->image->getImageUrl($imageRow->model->imageAutoSize1200);
        $data->save();
        }*/


    }


    protected function onActive()
    {

        $update = new TemplateImageUpdate();
        $update->active = true;
        $update->updateById($this->dataId);

    }


    protected function onInactive()
    {

        $update = new TemplateImageUpdate();
        $update->active = false;
        $update->updateById($this->dataId);

    }


    protected function onDelete()
    {

        (new TemplateImageDelete())->deleteById($this->dataId);

        $this->deleteImageIndex();

    }


    protected function deleteImageIndex()
    {

        $delete = new TemplateImageIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->getContentId());
        $delete->delete();

    }


    protected function onDataRow()
    {
        $this->dataRow = (new TemplateImageReader())->getRowById($this->dataId);
    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|TemplateImageRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
    }


    public function getSubject()
    {

        //$dataRow = (new TemplateImageReader())->getRowById($this->dataId);
        return $this->getDataRow()->image->getFilename();

    }


    protected function isActive()
    {
        return $this->getDataRow()->active;
    }

}