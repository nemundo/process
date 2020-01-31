<?php


namespace Nemundo\Process\Search\Parameter;


use Nemundo\Web\Parameter\AbstractUrlParameter;

class SearchQueryParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName = 'q';
    }


    public function getWordId()
    {

        $wordId = md5(mb_strtolower($this->getValue()));
        return $wordId;

    }

}