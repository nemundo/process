<?php


namespace Nemundo\Process\Cms\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Cms\Data\CmsType\CmsType;
use Nemundo\Process\Cms\Data\CmsType\CmsTypeDelete;
use Nemundo\Process\Cms\Data\CmsType\CmsTypeUpdate;
use Nemundo\Process\Content\Type\AbstractType;

class CmsSetup extends AbstractBase  // ContentTypeSetup
{

    /*
    public function __construct(AbstractApplication $application = null)
    {
        parent::__construct($application);
    }*/


    public function __construct(AbstractType $parentContentType = null)
    {
        $this->parentContentType = $parentContentType;
    }


    /**
     * @var AbstractType
     */
    public $parentContentType;

    public function addContentType(AbstractType $contentType)
    {

        //parent::addContentType($contentType);

        $data = new CmsType();
        $data->updateOnDuplicate = true;
        $data->setupStatus = true;
        $data->parentContentTypeId = $this->parentContentType->typeId;
        $data->cmsContentTypeId = $contentType->typeId;
        $data->save();

        return $this;


    }


    public function resetSetupStatus()
    {

        $update = new CmsTypeUpdate();
        $update->setupStatus = false;
        $update->update();

    }


    public function removeSetupStatus()
    {

        $delete = new CmsTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }


}