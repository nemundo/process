<?php


namespace Nemundo\Process\Group\Check;


use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupRestrictedTrait
{

    /**
     * @var bool
     */
    public $groupRestricted = false;

    /**
     * @var AbstractGroupContentType[]
     */
    private $groupRestrictedList = [];


    public function addRestrictedGroup(AbstractGroupContentType $groupContentType)
    {
        $this->groupRestrictedList[] = $groupContentType;
        return $this;
    }


    public function checkUserVisibility()
    {

        $visible = true;

        if ($this->groupRestricted) {

            $visible = false;
            foreach ($this->groupRestrictedList as $restrictionGroup) {
                if ((new GroupCheck())->isMemberOfGroup($restrictionGroup)) {
                    $visible = true;
                }

            }

        }

        return $visible;

    }

}