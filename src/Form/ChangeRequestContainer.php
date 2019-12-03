<?php


namespace Nemundo\Process\Form;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Container\AbstractHtmlContainer;

class ChangeRequestContainer extends AbstractHtmlContainer
{

    use RedirectTrait;
    use StatusFormTrait;

}