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
        ->create([
            'name' => 'My project'
        ]);
        $this->assertDatabaseHas("projects", ['name' => 'My project']);
        //$this->assertEquals($project->name, 'My project');
    }

    public function testIfProjectNameIsOnProjectView()
    {
        Project::factory()
        ->count(5)
        ->create([
            'name'=> 'My project'
        ]);
        $response = $this->get('/project');
        $response->assertSee('My project', false);
    }


  
    public function testIfProjectNameIsOnProjectDetailsView()
    {
        Project::factory()
        ->create([
            'name'=> 'My project'
        ]);
        $response = $this->get('/project/1');
        $response->assertSee('My project', false);
    }



    public function testRelationBetweenProjectsAndUsers()
    {
        $userName ='SuperMan';
        $projectName = 'SuperProject';

        //given
        $user = User::factory()
            ->has(Project::factory()->state([
                'name' => $projectName
            ]))
            ->create();

        $project = Project::factory()
            ->for(User::factory()->state([
                'name' => $userName
            ]))
        ->create();

        //when
        $actualProjectUserName = $project->user->name;
        $actualUserProjectName = $user->projects()->first()->name;
        
        //then
        $this->assertEquals($userName, $actualProjectUserName);
        $this->assertEquals($projectName, $actualUserProjectName);

    }


    public function testIfAuthorProjectIsOnDetailsProjectView()
    {
        $userName = 'SuperCarotte';
        User::factory()
        ->has(Project::factory())
        ->create([
            'name'=> $userName
        ]);

        $response = $this->get('/project/1');
        $response->assertSee($userName, false);
    }


    public function testNewProjectRegister()
    {
        //given
        $testUser = User::factory()->create();
        $testNameForm = 'PostMan';
        $testDescrForm = 'PostDescription';

        //when
        $response=$this->post('/project', ['name'=> $testNameForm, 'description'=> $testDescrForm]);

        //then
        $this->assertDatabaseHas('projects', ['name'=> $testNameForm]);
    }

}