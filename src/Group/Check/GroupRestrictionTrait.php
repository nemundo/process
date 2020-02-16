<?php


namespace Nemundo\Process\Group\Check;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupRestrictionTrait
{


    //groupRestricted
    public $groupRestriction = false;

    /**
     * @var AbstractGroupContentType[]
     */
    private $restrictionGroup = [];

    // addRestrictedGroup
    public function addRestrictionGroup(AbstractGroupContentType $groupContentType)
    {
        $this->restrictionGroup[] = $groupContentType;
        return $this;
    }


    public function checkUserVisibility()
    {

       // (new Debug())->write('check');

        //$visible = parent::checkUserVisibility();
        $visible = true;


        if ($this->groupRestriction) {

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