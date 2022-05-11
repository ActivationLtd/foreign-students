<?php /** @noinspection PhpVariableVariableInspection */

namespace App\Mainframe\Features\Form\Select;

use App\Module;

class SelectAjax extends SelectModel
{
    public $url;
    public $preload;
    public $minimumInputLength = 2;

    public function __construct($var = [], $element = null)
    {
        parent::__construct($var, $element);

        $this->preload = $this->var['preload'] ?? $this->preload();
        $this->containerClass = $this->var['container_class'] ?? $this->var['div'] ?? 'col-md-6';
        $this->params['class'] .= ' ajax ';
        $this->url = $this->var['url'] ?? $this->url();

        // Make the field readonly instead of disable
        if (!$this->isEditable) {
            unset($this->params['disabled']);
            $this->params['readonly'] = 'readonly';
        }

        $this->minimumInputLength = $this->var['minimum_input'] ?? 2;
    }

    /**
     * @return mixed
     */
    public function preload()
    {
        if ($this->value()) {
            $item = $this->getQuery()
                ->select([$this->valueField, $this->nameField])
                ->where($this->valueField, $this->value())
                ->first();

            $nameField = $this->nameField;
            if ($item) {
                return $item->$nameField;
            }
        }

        return $this->preload;
    }

    /**
     * Determine the URL to get the json list
     *
     * @return string|null
     */
    public function url()
    {
        if ($this->url) {
            return $this->url;
        }

        if ($this->table) {
            $moduleName = Module::fromTable($this->table)->name;

            return route("{$moduleName}.list-json")."?columns_csv={$this->valueField},".$this->nameField;
        }

        if ($this->model) {
            $moduleName = $this->model->module()->name;

            return route("{$moduleName}.list-json")."?columns_csv={$this->valueField},".$this->nameField;
        }

        return null;
    }

    /**
     * Select options
     *
     * @return array
     */
    public function options()
    {
        return []; // No option should be loaded initially
    }

}