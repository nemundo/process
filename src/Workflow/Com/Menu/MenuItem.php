<?php


namespace Nemundo\Process\Com\Menu;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Package\FontAwesome\AbstractFontAwesomeIcon;
use Nemundo\Web\Site\AbstractSite;

class MenuItem extends AbstractBase
{


    /**
     * @var AbstractFontAwesomeIcon
     */
    public $icon;

    /**
     * @var string
     */
    public $label;

    /**
     * @var bool
     */
    public $active = false;

    /**
     * @var bool
     */
    public $linked = true;

    /**
     * @var AbstractSite
     */
    public $site;

    /**
     * @var bool
     */
   // public $subMenu = false;


}