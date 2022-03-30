<?php

namespace App\Mainframe\Features\Datatable;

use App\Mainframe\Features\Datatable\Traits\DatatableTrait;
use App\Module;
use Illuminate\Database\Eloquent\Model;

class Datatable
{
    use DatatableTrait;

    /** @var string */
    public $name;

    /** @var string */
    public $table;

    /** @var Module */
    public $module;

    /** @var Model */
    public $model;

    /** @var \Yajra\DataTables\DataTableAbstract */
    public $dt;

    /**
     * List of columns that is allowed for search/sort.
     *
     * @var array
     */
    public $whiteList = [];

    /**
     * List of columns that is not allowed for search/sort.
     *
     * @var array
     */
    public $blackList = [];

    /**
     * Set columns that should not be escaped. (HTML)
     * Optionally merge the defaults from config.
     *
     * @var string[]
     * @deprecated Automatically all columns are considered as raw(html) columns
     */
    public $rawColumns = ['tenant_sl', 'id', 'name', 'is_active', 'action'];

    /**
     * Data source URL
     *
     * @var string
     */
    public $ajaxUrl;

    /**
     * Default rows per page
     *
     * @var int
     */
    public $pageLength = 50;

    /**
     * Allow changing rows per page
     *
     * @var bool
     */
    public $bLengthChange = true;

    /**
     * Show hide search options
     *
     * @var bool
     */
    public $bFilter = true;

    /**
     * Milliseconds to wait before requesting ajax search call
     *
     * @var int
     */
    public $searchDelay = 2000;

    /**
     * Minimum character to type to initiate search
     *
     * @var int
     */
    public $minLength = 3;

    /**
     * Show pagination. You can hide pegination and show all data if
     * the data amount is small (<500 rows)
     *
     * @var bool
     */
    public $bPaginate = true;

    /**
     * Show table info
     *
     * @var bool
     */
    public $bInfo = true;

    /**
     * Defer render for performance optimization
     *
     * @var bool
     */
    public $bDeferRender = true;

    /**
     * Force hide some fields that are already included in the column list
     *
     * @var array
     */
    public $hidden;

    /**
     * Constructor for this class is very important as it boots up necessary features of
     * a module. First of all, it load module related meta information, then based
     * on context check(tenant context) it loads the tenant id. The it constructs the default
     * grid query and also add tenant context to grid query if applicable. Finally it
     * globally shares a couple of variables $name, $currentModule to all views rendered
     * from this controller
     *
     * @param $table
     */
    public function __construct($table = null)
    {
        $this->table = $table ?: $this->table;
    }

    /**
     * @param  Module|string  $module
     * @return Datatable|bool
     */
    public function setModule($module)
    {
        if (is_string($module)) {
            $module = Module::byName($module);
        }

        if (!$module) {
            return false;
        }

        $this->module = $module;
        $this->table = $this->module->tableName();
        $this->model = $this->module->modelInstance();

        return $this;
    }

    /**
     * @param  string  $table
     * @return $this
     */
    public function setTable(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @param  string  $ajaxUrl
     * @return $this
     */
    public function setAjaxUrl(string $ajaxUrl)
    {
        $this->ajaxUrl = $ajaxUrl;

        return $this;
    }

    /**
     * Ajax URL for json source
     *
     * @return string
     */
    public function ajaxUrl()
    {
        if (!$this->ajaxUrl) {
            $this->ajaxUrl = route('datatable.json', classKey($this)); // Default common route for dynamic datatables
        }

        // Pass the current request params to datatable
        $this->ajaxUrl = urlWithParams($this->ajaxUrl, parse_url(\URL::full(), PHP_URL_QUERY));

        return $this->ajaxUrl;
    }

    /**
     * Add additional params in the AJAX data URL
     *
     * @param  array  $params
     * @return string
     */
    public function addUrlParam($params = [])
    {
        $this->ajaxUrl = urlWithParams($this->ajaxUrl(), $params);

        return $this->ajaxUrl;
    }

    /**
     * Datatable page length
     *
     * @return int
     */
    public function pageLength()
    {
        return $this->pageLength ?? 25;
    }

    /**
     * Show rows-per-page options
     *
     * @return string
     */
    public function lengthMenu()
    {
        if (isset($this->lengthMenu)) {
            return $this->lengthMenu;
        }

        // # Option 1
        // This is a key->value mapping of the selection drop down. -1 means no pagination. This is risky for large data.
        // return "[[10, 25, 50, -1], [10, 25, 50, 'All']]";

        // # Option 2
        return "[5, 10, 25, 50, 100]";
    }

    /**
     * @return string
     */
    public function order()
    {
        if (isset($this->order)) {
            return $this->order;
        }

        return "[[0, 'desc']]";
    }

    /**
     * Allow datatable length change
     *
     * @return string
     */
    public function bLengthChange()
    {
        if ($this->bLengthChange == false) {
            return 'false';
        }

        return 'true';
    }

    /**
     * @return string
     */
    public function bPaginate()
    {
        if ($this->bPaginate == false) {
            return 'false';
        }

        return 'true';
    }

    /**
     * @return string
     */
    public function bFilter()
    {
        if ($this->bFilter == false) {
            return 'false';
        }

        return 'true';
    }

    /**
     * @return string
     */
    public function bInfo()
    {
        if ($this->bInfo == false) {
            return 'false';
        }

        return 'true';
    }

    /**
     * @return string
     */
    public function bDeferRender()
    {
        if ($this->bDeferRender == false) {
            return 'false';
        }

        return 'true';
    }

    /**
     * @return string
     */
    public function searchDelay()
    {
        return $this->searchDelay;
    }

    /**
     * @return string
     */
    public function minLength()
    {
        return $this->minLength;
    }

    /**
     * Hide fields/columns
     *
     * @return array
     */
    public function hidden()
    {
        return $this->hidden ?? [];
    }

}