<?php


namespace Nemundo\Process\Group\Site;


use Nemundo\Process\Group\Check\GroupCheck;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;
use Nemundo\Process\Group\Type\AbstractGroupContentType;
use Nemundo\Web\Site\AbstractSite;


abstract class AbstractGroupRestrictedSite extends AbstractSite
{

    use GroupRestrictedTrait;

}