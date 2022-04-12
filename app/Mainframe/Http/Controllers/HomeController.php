<?php

namespace App\Mainframe\Http\Controllers;

use App\Mainframe\DataBlocks\SampleDataBlock;
use App\Module;
use App\ModuleGroup;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->view('mainframe.dashboards.default.index');
        $sampleData = (new SampleDataBlock)->data();

        return $this->response()
            ->setViewVars(['sampleData' => $sampleData])
            ->send();
    }

    /**
     * @return bool
     */
    public function phpinfo()
    {
        return phpinfo();

    }

    public function moduleNamesConfig()
    {
        $modules = Module::withTrashed()->get();
        echo "<pre>[<br/>";
        foreach ($modules as $module) {
            echo "\"$module->name\",<br/>";
        }

        echo "]<br/></pre>";

        dd();
    }

    public function moduleConfig()
    {

        $modules = Module::withTrashed()->get();

        $skip = [
            "created_by",
            "updated_by",
            "created_at",
            "updated_at",
            "deleted_at",
            "deleted_by"
        ];

        echo "<pre>[<br/>";
        foreach ($modules as $module) {
            echo "\"$module->name\"  =>[<br/>";

            foreach ($module->tableColumns() as $column) {
                if (!in_array($column, $skip)) {
                    echo "      \"$column\" => ";

                    $val = $module->$column;

                    if (is_string($val)) {
                        echo "\"$val\"";
                    } else {
                        if (is_null($val)) {
                            echo 'null';
                        } else {
                            echo $val;
                        }
                    }
                    echo ",<br/>";

                }
            }

            echo "  ],<br/>";
        }

        echo "]<br/></pre>";

        dd();

    }

    public function moduleGroupConfig()
    {

        $modules = ModuleGroup::withTrashed()->get();

        $skip = [
            "created_by",
            "updated_by",
            "created_at",
            "updated_at",
            "deleted_at",
            "deleted_by"
        ];

        echo "<pre>[<br/>";
        foreach ($modules as $module) {
            echo "\"$module->name\"  =>[<br/>";

            foreach ($module->tableColumns() as $column) {
                if (!in_array($column, $skip)) {
                    echo "      \"$column\" => ";

                    $val = $module->$column;

                    if (is_string($val)) {
                        echo "\"$val\"";
                    } else {
                        if (is_null($val)) {
                            echo 'null';
                        } else {
                            echo $val;
                        }
                    }
                    echo ",<br/>";

                }
            }

            echo "  ],<br/>";
        }

        echo "]<br/></pre>";

        dd();

    }
}