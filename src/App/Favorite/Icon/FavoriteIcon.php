<?php


namespace Nemundo\Process\App\Favorite\Icon;


use Nemundo\Package\FontAwesome\AbstractFontAwesomeIcon;

class FavoriteIcon extends AbstractFontAwesomeIcon
{

    protected function loadContainer()
    {

        $this->icon = 'star';

    }

}