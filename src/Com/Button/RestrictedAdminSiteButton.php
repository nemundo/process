<?php


namespace Nemundo\Process\Com\Button;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Process\Group\Check\GroupRestrictedTrait;

class RestrictedAdminSiteButton extends AdminSiteButton
{

    use GroupRestrictedTrait;

}