<?php

namespace Nemundo\Process\Cms\Index;


use Nemundo\Process\Cms\Data\Cms\Cms;

trait CmsIndexTrait
{

    public function saveCmsIndex()
    {

        $data = new Cms();
        $data->parentId = $this->getParentId();
        $data->contentId = $this->getContentId();
        $data->itemOrder = 0;
        $data->save();

    }

}