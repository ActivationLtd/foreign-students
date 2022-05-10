<?php
/** @noinspection DuplicatedCode */

use App\Module;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateApplicationSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*---------------------------------
        | Create the table if doesnt exists
        |---------------------------------*/
        if (!Schema::hasTable('application_sessions')) {

            Schema::create('application_sessions', function (Blueprint $table) {

                /******* Default framework fields **********/
                $table->bigIncrements('id');
                $table->string('uuid', 64)->nullable()->default(null)->index();
                $table->unsignedInteger('project_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_id')->nullable()->default(null)->index();
                $table->unsignedInteger('tenant_sl')->nullable()->default(null)->index();
                $table->string('name', 250)->nullable()->default(null)->index();
                $table->string('name_ext', 500)->nullable()->default(null)->index();
                $table->string('slug', 50)->nullable()->default(null)->index();

                /******* Custom columns **********/
                // Todo: Add module specific fields and denormalized fields. In computing, denormalization is the process of
                //  improving the read performance of a database, at the expense of losing some write performance,
                //  by adding redundant copies of data or by grouping it.

                $table->text('description')->nullable()->default(null);
                $table->date('starts_on')->nullable()->default(null);
                $table->date('ends_on')->nullable()->default(null);
                //$table->text('field')->nullable()->default(null);
                /*********************************/

                $table->tinyInteger('is_active')->nullable()->default(1);
                $table->unsignedInteger('created_by')->nullable()->default(null)->index();
                $table->unsignedInteger('updated_by')->nullable()->default(null)->index();
                $table->timestamps();
                $table->softDeletes();
                $table->unsignedInteger('deleted_by')->nullable()->default(null)->index();
            });
        }

        /*---------------------------------
        | Update modules table
        |---------------------------------*/
        $name = 'application-sessions';

        $module = Module::firstOrNew(['name' => $name]);

        $module->title = str_replace('-', ' ', ucfirst($name));        // Todo: Give a human friendly name
        $module->module_group_id = 1;                                                 // Todo: Are you sure you want to put this in default module-group
        $module->description = 'Manage '.Str::plural($module->title); // Todo: human friendly name.
        $module->module_table = 'application_sessions';
        $module->route_path = 'application-sessions';
        $module->route_name = 'application-sessions';
        $module->class_directory = 'app/Projects\DgmeStudents\Modules\ApplicationSessions';
        $module->namespace = '\App\Projects\DgmeStudents\Modules\ApplicationSessions';
        $module->model = '\App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSession';
        $module->policy = '\App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSessionPolicy';
        $module->processor = '\App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSessionProcessor';
        $module->controller = '\App\Projects\DgmeStudents\Modules\ApplicationSessions\ApplicationSessionController';
        $module->view_directory = 'projects.dgme-students.modules.application-sessions';
        $module->icon_css = 'fa fa-ellipsis-v';
        $module->color_css = 'white';
        $module->is_visible = 1;
        $module->is_active = 1;
        $module->created_by = 1;

        $module->save();

        /*---------------------------------
        | Run following set of artisan commands
        |---------------------------------*/
        $output = new ConsoleOutput();
        $commands = [
            'cache:clear',
            'route:clear',
            'mainframe:create-root-models',
        ];
        foreach ($commands as $command) {
            $output->writeLn('php artisan '.$command);
            Artisan::call($command);
        }

        // if (env('APP_ENV') == 'local') {
        //     Artisan::call('ide-helper:model -W');
        // }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_sessions');
    }
}