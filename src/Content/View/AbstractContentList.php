<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Web\Parameter\AbstractUrlParameter;
use Nemundo\Web\Site\AbstractSite;

class AbstractContentList extends AbstractHtmlContainer
{

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    /**
     * @var AbstractUrlParameter
     */
    public $redirectParameter;


    protected function getRedirectSite($dataId) {

        $site = clone($this->redirectSite);
        $parameter = clone($this->redirectParameter);
        $parameter->setValue($dataId);
        $site->addParameter($parameter);
        return $site;
    }


}