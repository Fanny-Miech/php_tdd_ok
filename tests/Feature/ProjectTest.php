<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Project;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ProjectTest extends TestCase
{

    use DatabaseMigrations;
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStatusIs200inGet_Project()
    {
        $response = $this->get('/project');

        $response->assertStatus(200);
    }

    public function testProjectContentsH1()
    {
        $response = $this->get('/project');
        $response->assertSee("<h1>Liste des projets</h1>", false);
    }

    public function testFannyIsInDatabase()
    {
        $user = User::factory()
        ->create([
            'name' => 'fanny',
        ]);
        $this->assertDatabaseHas("users", ['name'=>'fanny']);
        //$this->assertEquals($user->name, 'fanny');
    }

    public function testMyProjectIsInDatabase()
    {
        $project = Project::factory()
        ->create();
        //dump($project);
        $this->assertDatabaseHas("projects", ['name' => 'My project']);
        //$this->assertEquals($project->name, 'My project');
    }


    /*
    public function testProjectContentsTitleProject()
    {
        $response = $this->get('/project');
        $response->assertSee("Title project", false);
    }

    public function testDetailsProjectContentsTitleProject()
    {
        $response = $this->get('/project/id');
        $response->assertSee("Title project", false);
    }

    public function testRelationIfProjectHasUser()
    {
        //given

        //then

        //when

    }

    public function testDetailsProjectContentsAuthorProjectName()
    {
        $response = $this->get('/project/id');
        $response->assertSee("Author project name", false);
    }

    */
}