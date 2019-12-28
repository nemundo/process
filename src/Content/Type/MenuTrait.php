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


    /**
     * @var string
     */
    protected $nextMenuClass;

    /**
     * @var string
     */
    protected $previousMenuClass;


    // getNextContentType
    public function getNextMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->nextMenuClass !== null) {
            $className = $this->nextMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }


    public function getPreviousMenu()
    {

        /** @var AbstractMenuContentType $nextStatus */
        $nextStatus = null;

        if ($this->previousMenuClass !== null) {
            $className = $this->previousMenuClass;
            $nextStatus = new $className();
        }

        return $nextStatus;

    }



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