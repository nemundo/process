<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Process\Group\Check\GroupCheck;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Web\Site\AbstractSite;
use Schleuniger\App\Verbesserung\Group\VerbesserungAdminGroup;

abstract class AbstractGroupRestrictionSite extends AbstractSite
{


    public $groupRestriction = true;

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

        $visible = parent::checkUserVisibility();


        if ($this->groupRestriction) {

            // multi group

            $visible = false;

            //$visibleGroup=false;

            foreach ($this->restrictionGroup as $restrictionGroup) {
                if ((new GroupCheck())->isMemberOfGroup(new VerbesserungAdminGroup())) {
                    $visible = true;
                } //else {
                //$visible = false;
                //$p = new Paragraph($this);
                //$p->content='no access';
                //}

            }
        }


        // $visible = false;

        return $visible;


    }


}