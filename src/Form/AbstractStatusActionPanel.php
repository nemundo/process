<?php


namespace Nemundo\Process\Form;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Web\Action\AbstractActionPanel;

abstract class AbstractStatusActionPanel extends AbstractActionPanel
{

    use RedirectTrait;
    use StatusFormTrait;


}