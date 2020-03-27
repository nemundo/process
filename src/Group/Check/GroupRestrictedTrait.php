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
    private $restrictionGroup = [];
// groupRestrictedList


    public function addRestrictedGroup(AbstractGroupContentType $groupContentType)
    {
        $this->restrictionGroup[] = $groupContentType;
        return $this;
    }


    public function checkUserVisibility()
    {

        $visible = true;

        if ($this->groupRestricted) {

            $visible = false;
            foreach ($this->restrictionGroup as $restrictionGroup) {
                if ((new GroupCheck())->isMemberOfGroup($restrictionGroup)) {
                    $visible = true;
                }

            }

        }

        return $visible;

    }

}