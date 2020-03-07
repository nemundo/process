<?php


namespace Nemundo\Process\Group\Check;


use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupRestrictionTrait
{


    //groupRestricted
    public $restrictedGroup = false;

    /**
     * @var AbstractGroupContentType[]
     */
    private $restrictionGroup = [];

    // addRestrictedGroup
    public function addRestrictedGroup(AbstractGroupContentType $groupContentType)
    {
        $this->restrictionGroup[] = $groupContentType;
        return $this;
    }


    public function checkUserVisibility()
    {

        $visible = true;

        if ($this->restrictedGroup) {

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