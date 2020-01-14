<?php


namespace Nemundo\Process\Content\View;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\Web\Parameter\AbstractUrlParameter;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class AbstractContentList extends AbstractHtmlContainer
{

    public $showSearchForm = false;

    /**
     * @var AbstractSite
     */
    public $redirectSite;

    /**
     * @var AbstractUrlParameter
     */
    public $redirectParameter;


    protected function getRedirectSite($dataId)
    {

        if ($this->redirectSite == null) {
$this->redirectSite=new Site();
$this->redirectParameter=new DataParameter();
        }

        $site = null;
        if ($this->redirectSite !== null) {
            $site = clone($this->redirectSite);
            $parameter = clone($this->redirectParameter);
            $parameter->setValue($dataId);
            $site->addParameter($parameter);
        } else {
            (new LogMessage())->writeError('Redirect Site not defined.');
        }

        return $site;
    }


}