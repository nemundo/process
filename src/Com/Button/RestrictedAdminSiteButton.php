<?php


namespace Nemundo\Process\Com\Button;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;

class RestrictedAdminSiteButton extends AdminSiteButton
{

    use GroupRestrictionTrait;

}