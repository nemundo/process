<?php


namespace Nemundo\Process\Form;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Container\AbstractHtmlContainer;

abstract class AbstractStatusContainer extends AbstractHtmlContainer
{

    use RedirectTrait;
    use StatusFormTrait;

}