<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Status\Status;

class StatusSetup extends AbstractBase
{

    //public function addStatus(AbstractStatus $status)
     public function addStatus(AbstractContentType $status)
    {

        $setup = new ContentTypeSetup();
        $setup->addContentType($status);

        $data = new Status();
        $data->updateOnDuplicate = true;
        $data->statusLabel = (new Translation())->getText( $status->label);
        $data->contentTypeId = $status->id;
        $data->save();

    }

}