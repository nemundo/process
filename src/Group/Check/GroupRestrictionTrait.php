<?php


namespace Nemundo\Process\Group\Check;


use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupRestrictionTrait
{


    //groupRestricted
    public $groupRestriction = false;

    /**
     * @var AbstractGroupContentType[]
     */
    private $restrictionGroup = [];

    public function addRestrictionGroup(AbstractGroupContentType $groupContentType)
    {
        $this->restrictionGroup[] = $groupContentType;
        return $this;
    }


    public function checkUserVisibility()
    {

        //$visible = parent::checkUserVisibility();
        $visible = true;


        if ($this->groupRestriction) {

            $visible = false;

            foreach ($this->restrictionGroup as $restrictionGroup) {
                //if ((new GroupCheck())->isMemberOfGroup(new VerbesserungAdminGroup())) {
                    if ((new GroupCheck())->isMemberOfGroup($restrictionGroup)) {
                    $visible = true;
                }

            }
        }

        return $visible;

    }

}