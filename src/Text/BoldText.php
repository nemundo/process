<?php


namespace Nemundo\Process\Text;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Html\Formatting\Bold;

class BoldText extends AbstractBase
{

    public function getBold($text)
    {

        $bold = new Bold();
        $bold->content = $text;
        return $bold->getBodyContent();

    }

}