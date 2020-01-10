<?php

namespace Nemundo\Process\Search\Com;


use Nemundo\Admin\Com\Button\AdminSearchButton;
use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Html\Character\HtmlCharacter;
use Nemundo\Package\Bootstrap\Autocomplete\BootstrapAutocompleteMultipleValueTextBox;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Process\Search\Site\SearchJsonSite;


class ContentSearchForm extends SearchForm
{

    /**
     * @var BootstrapTextBox
     */
    private $query;

    public function getContent()
    {

        $formRow = new BootstrapFormRow($this);

        /*$this->query = new BootstrapTextBox($formRow);
        $this->query->name = (new SearchQueryParameter())->parameterName;
        $this->query->searchItem = true;
        $this->query->placeholder = 'Search';
        $this->query->label = HtmlCharacter::NON_BREAKING_SPACE;
        $this->query->autofocus = true;*/

        $this->query = new BootstrapAutocompleteMultipleValueTextBox($formRow);
        $this->query->name = (new SearchQueryParameter())->parameterName;
        $this->query->seperator = ' ';
        $this->query->searchMode = true;
        $this->query->placeholder = 'Search';
        $this->query->label = HtmlCharacter::NON_BREAKING_SPACE;
        $this->query->sourceSite = SearchJsonSite::$site;


        new AdminSearchButton($formRow);

        return parent::getContent();

    }


    public function getSearchQuery()
    {

        $value = (new SearchQueryParameter())->getValue();
        return $value;


    }


    public function getWordId() {

        $wordId = md5(mb_strtolower( $this->getSearchQuery()));
        return $wordId;
    }


}