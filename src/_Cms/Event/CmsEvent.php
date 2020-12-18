<?php


namespace Nemundo\Process\Cms\Event;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Cms\Data\Cms\Cms;
use Nemundo\Process\Cms\Data\Cms\CmsCount;
use Nemundo\Process\Cms\Data\Cms\CmsValue;
use Nemundo\Process\Content\Event\AbstractContentEvent;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractType;

class CmsEvent extends AbstractContentEvent
{

    public function onCreate(AbstractType $contentType)
    {

        (new Debug())->write( $contentType->getParentId());

        $parentId =  $contentType->getParentId();


        $max = 0;
        $count = new CmsCount();
        $count->filter->andEqual($count->model->parentId,$parentId);  // $contentType->getContentId());
        if ($count->getCount() > 0) {
            $value = new CmsValue();
            $value->field = $value->model->itemOrder;
            $value->filter->andEqual($value->model->parentId, $parentId);  //$contentType->getContentId());
            $max = $value->getMaxValue();
            $max++;

            //(new Debug())->write('sdaf');

        }

        //(new Debug())->write($max);
        //exit;


        $data = new Cms();
        $data->parentId =$parentId;  // $contentType->getParentId();
        $data->contentId = $contentType->getContentId();
        $data->itemOrder = $max;
        $data->save();


    }

}