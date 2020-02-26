<?php


namespace Nemundo\Process\Com\Hyperlink;


use Nemundo\Package\FontAwesome\Hyperlink\IconSiteHyperlink;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;

class RestrictedIconSiteHyperlink extends IconSiteHyperlink
{

    use GroupRestrictionTrait;

}