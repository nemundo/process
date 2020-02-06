<?php

namespace Nemundo\Process\Widget\UniqueId;


use Nemundo\Admin\Com\Widget\AbstractAdminWidget;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Content\View\AbstractContentView;


class UniqueIdContentView extends AbstractContentView
{


    public function getContent()
    {


//        $this->widgetTitle = 'Unique Id';

        $textbox = new BootstrapTextBox($this);
        $textbox->label = 'Unique Id';
        $textbox->value = (new UniqueId())->getUniqueId();

        return parent::getContent();

    }

}