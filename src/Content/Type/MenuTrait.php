<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Language\Translation;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\User\Access\UserRestrictionTrait;


trait MenuTrait
{

    /**
     * @var string[]
     */
    private $menuClassList = [];




    public function getMenuList()
    {

        /** @var AbstractContentType[] $statusList */
        $statusList = [];
        foreach ($this->menuClassList as $className) {
            $statusList[] = new $className();
        }
        return $statusList;

    }


    protected function addMenuClass($statusClass)
    {

        $this->menuClassList[] = $statusClass;
        return $this;

    }

}