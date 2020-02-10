<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Process\Group\Check\GroupCheck;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Web\Site\AbstractSite;



// GroupRestrictedSite
abstract class AbstractGroupRestrictionSite extends AbstractSite
{

    use GroupRestrictionTrait;

}