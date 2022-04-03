<?php /** @noinspection ALL */

namespace App\Mainframe\Helpers\Test;

use App\Mainframe\Features\Responder\Response;
use App\Module;

class SuperadminModularTestCase extends SuperadminTestCase
{

    /**
     * The module name that is being tested
     *
     * @var string
     */
    public $moduleName;

    /**
     * @var \App\Mainframe\Modules\Modules\Module
     */
    public $module;

    /**
     * Executes at the beginning of the class
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    /**
     * Executes at the end of the class
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        (new self())->setUp(); // Note: Need to instantiate the laravel app to access the classes

        fwrite(STDOUT, __METHOD__ . "\n");

        //        // Delete test entries
        //        fwrite(STDOUT, "🧹 Clean test data ... ");
        //        Division::where('name', 'LIKE', '%TEST--%')->forceDelete();
        //        fwrite(STDOUT, "Done \n");

    }

    /**
     * Set up the class. This works like constructor and run
     * before every test method
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->module = Module::byName($this->moduleName);

    }


    /*
    |--------------------------------------------------------------------------
    | Section: Helpers
    |--------------------------------------------------------------------------
    |
    | These are not actual tests rather helpers to fun the tests.
    |
    */

    /**
     * Input fields based on form order
     * @return array
     */
    public function inputs()
    {
        $name = 'TEST-- ';

        return [
            'name' => $name,
            'is_active' => 1
        ];

    }

    /**
     * Default errors
     * @return string[]
     */
    public function defaultErrors()
    {
        return [
            "Failed to create new " . \Str::singular($this->module->title),
            "The name field is required.",
            "The is_active field is required."
        ];
    }

    /**
     * Fields to be updated
     * @return array
     */
    public function updateValues()
    {
        $latest = $this->latest();

        $new_name = 'UPDATED ' . $latest->name;
        $new_code = $this->code;

        return [
            'name' => $new_name,
            'code' => $new_code,
        ];
    }

    /**
     * Grid columns in required order
     * @return string[]
     */
    public function gridColumns()
    {
        return ['ID', 'Name', 'Updater', 'Updated at', 'Active'];
    }

    /**
     * Array of HTML markups created for each input. This HTML should be available in the form
     * @return array
     */
    public function inputHtmlMarkupTexts()
    {
        return collect($this->inputs())->keys()
            ->map(function ($item, $key) {
                return 'id="' . $item . '"';   // "id="name""
            })->all();
    }

    /*
    |--------------------------------------------------------------------------
    | Section: HTML based tests
    |--------------------------------------------------------------------------
    |
    */
    public function test_user_can_see_create_form_input_fields()
    {
        $response = $this->get('/' . $this->module->route_path . '/create');

        $response->assertStatus(200) // HTTP OK response
        ->assertSee($this->module->title); // See the module title in header

        fwrite(STDOUT, "👁️ Expecting input fields in following order in the HTML form \n" . print_r($this->inputHtmlMarkupTexts(), true));
        $response->assertSeeInOrder($this->inputHtmlMarkupTexts(), false);

        return $response;

    }


    /**
     * User can not store invalid element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_not_store_invalid_element()
    {

        $response = $this->followingRedirects()
            ->post('/' . $this->module->route_path, []); // Pass an empty array


        $response->assertStatus(200)
            ->assertSee('Fail');


        fwrite(STDOUT, "👁️ Expecting following error message \n" . print_r($this->defaultErrors(), true));
        foreach ($this->defaultErrors() as $str) {
            fwrite(STDOUT, "🔍 Checking " . $str . "\n");
            $response->assertSee($str);
        }

        return $response;
    }

    /**
     * User can only store element that is valid
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @throws \Exception
     */
    public function test_user_can_store_valid_element()
    {
        $inputs = array_merge(
            $this->inputs(),
            ['redirect_success' => '#new']
        );

        fwrite(STDOUT, "HTTP POST :\n" . print_r($inputs, true));

        $response = $this->followingRedirects()
            ->post('/' . $this->module->route_path, $inputs);

        $response->assertStatus(200);
        foreach ($this->inputs() as $key => $value) {
            fwrite(STDOUT, "🔍 Checking " . $key . ": " . $value . "\n");
            $response->assertSee($value);
        }

        return $response;

    }


    /**
     * User can view list of elements in index page (module grid page)
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_list()
    {

        $response = $this->get('/' . $this->module->route_path);

        $response->assertStatus(200)
            ->assertSee($this->module->title)
            ->assertSeeInOrder([
                'Create a new ' . \Str::lower(\Str::singular($this->module->title)), // View create button
                '<i class="fa fa-plus-circle"></i>'
            ], false)
            ->assertSee(['View advanced report with filters, excel export etc.']); // View report button

        fwrite(STDOUT, "👁️ Expecting grid columns in following order :\n" . print_r($this->gridColumns(), true));

        $response->assertSeeInOrder($this->gridColumns()); // See data table titles

        // See data table JSON output
        $this->get('/' . $this->module->route_path . '/datatable/json')
            ->assertStatus(200);

        return $response;

    }


    /**
     * User can view the element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_an_element()
    {
        $latest = $this->latest();

        $response = $this->followingRedirects()
            ->get("/{$this->module->route_path}/$latest->id");
        $response->assertStatus(200);

        return $response;

    }


    /**
     * User can view edit page.
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_edit_element()
    {
        $latest = $this->latest();

        $response = $this->get("/{$this->module->route_path}/$latest->id/edit");
        $response->assertStatus(200)
            ->assertSee($latest->name);

        return $response;

    }

    /**
     * User can update an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_update_element()
    {
        $latest = $this->latest();
        $updates = $this->updateValues();

        $response = $this->followingRedirects()
            ->patch("/{$this->module->route_path}/$latest->id", $updates);

        $response->assertStatus(200)->assertSee('Success');


        fwrite(STDOUT, "👁️ Expecting following values visible in form :\n" . print_r($updates, true));

        foreach ($updates as $key => $value) {
            fwrite(STDOUT, "🔍 Checking " . $key . ": " . $value . "\n");
            $response->assertSee($value);
        }

        return $response;

    }

    /**
     * User can delete an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_delete_element()
    {
        sleep(1); // Add a bit of delay
        $latest = $this->latest();

        // delete with redirect_success to index route.
        $response = $this->followingRedirects()
            ->delete("/{$this->module->route_path}/$latest->id?redirect_success=" . route($this->module->name . '.index'));

        $response->assertStatus(200)
            ->assertSee($this->module->title);

        // Check if it has been soft deleted.
        $this->assertDatabaseMissing($this->module->module_table, ['id' => $latest->id, 'deleted_at' => null]);

        return $response;
    }

    /**
     * User can view report
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_user_can_view_report()
    {
        $response = $this->get('/' . $this->module->route_path . '/report?submit=Run');
        $response->assertStatus(200)
            ->assertSee($this->module->title);

        return $response;
    }




    /*
    |--------------------------------------------------------------------------
    | JSON based tests
    |--------------------------------------------------------------------------
    |
    */
    /**
     * User can not store invalid element
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_not_store_invalid_element()
    {
        $response = $this->post("/{$this->module->route_path}?ret=json", []); // Post empty array

        $response->assertStatus(200)
            ->assertJson([
                'code' => 422,
                'status' => 'fail',
                'errors' => [],
            ]);

        $errors = $this->errors($response);

        foreach ($this->defaultErrors() as $expectedError) {
            $this->assertContains($expectedError, $errors, "❌ This error was expected but not found : " . $expectedError . "\n");
        }

        return $response;
    }


    /**
     * User can create a new element if input is valid
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     * @throws \Exception
     */
    public function test_json_user_can_store_valid_element()
    {
        $inputs = $this->inputs();

        $response = $this->post("/{$this->module->route_path}?ret=json", array_merge(
            $inputs,
            ['redirect_success' => '#new']
        ));

        $response->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'status' => 'success',
                'data' => [],
            ]);

        fwrite(STDOUT, "👁️ Expecting following values in saved object \n" . print_r($inputs, true));
        $payload = $this->payload($response);

        fwrite(STDOUT, "⭐️Saved object/payload \n" . print_r($payload, true));

        foreach ($inputs as $key => $value) {
            $this->assertEquals($value, $payload[$key]);
        }

        return $response;


    }

    /**
     * Check duplicate fields
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_not_store_element_of_same_name()
    {
        $latest = $this->latest();

        $response = $this->post("/{$this->module->route_path}?ret=json",
            [
                'name' => $latest->name,
            ]);


        $response->assertStatus(200)
            ->assertJson([
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'status' => 'fail',
                'data' => [
                    'name' => $latest->name,
                ],
                'validation_errors' => [
                    'name' => ["The name has already been taken."]
                ]
            ]);

        return $response;
    }

    /**
     * User can view list of element
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_view_list()
    {

        $response = $this->get("/{$this->module->route_path}/list/json");

        $response->assertStatus(200)
            ->assertJsonStructure([
                    "data" => [
                        "current_page",
                        "first_page_url",
                        "from",
                        "last_page",
                        "last_page_url",
                        "links",
                        "next_page_url",
                        "path",
                        "per_page",
                        "prev_page_url",
                        "to",
                        "total",
                        "items" => []
                    ]
                ]
            );

        return $response;
    }

    /**
     * User can view element as a json object
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_view_element()
    {
        $latest = $this->latest();

        $response = $this->get("/{$this->module->route_path}/$latest->id?ret=json");

        $response->assertStatus(200)
            ->assertJson([
                "code" => 200,
                "status" => "success",
                "data" => $latest->toArray()
            ]);

        return $response;
    }

    /**
     * User can update an element with valid data
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_update_element()
    {
        $latest = $this->latest();
        $updates = $this->updateValues();

        $response = $this->followingRedirects()
            ->patch("/{$this->module->route_path}/$latest->id?ret=json", $updates);
        $response->assertStatus(200)
            ->assertJson([
                'code' => 200,
                'status' => 'success',
                'data' => $updates,
            ]);

        return $response;
    }

    /**
     * User can delete an element
     *
     * @return \Illuminate\Foundation\Testing\TestResponse|\Illuminate\Testing\TestResponse
     */
    public function test_json_user_can_delete_element()
    {
        sleep(1);
        $latest = $this->latest();

        // delete with redirect=success to index route.
        $response = $this->delete("/{$this->module->route_path}/$latest->id?ret=json");
        $response->assertJson([
            'code' => 200,
            'status' => 'success',
            'message' => "The " . \Str::singular($this->module->title) . " is deleted",
            'data' => [
                'code' => $latest->code,
                'name' => $latest->name,
            ],
        ]);

        // Check if it has been soft deleted.
        $this->assertDatabaseMissing($this->module->module_table, ['id' => $latest->id, 'deleted_at' => null]);

        return $response;

    }


}


