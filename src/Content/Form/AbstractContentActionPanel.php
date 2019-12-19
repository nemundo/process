<?php


namespace Nemundo\Process\Content\Form;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Web\Action\AbstractActionPanel;

abstract class AbstractContentActionPanel extends AbstractActionPanel
{

    use ContentFormTrait;
    use RedirectTrait;

}