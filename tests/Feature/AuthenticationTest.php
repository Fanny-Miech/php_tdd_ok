<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Project;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;


class AuthenticationTest extends TestCase
{

    use DatabaseMigrations;
    

    public function testConnectedUserCanCreateANewProject()
    {
        //given
        $user = User::factory()->create();
        $testNameForm = 'PostMan';
        $testDescrForm = 'PostDescription';

        //when
        $response=$this->actingAs($user)->post('/project', ['name'=> $testNameForm, 'description'=> $testDescrForm]);

        //then
        $this->assertDatabaseHas('projects', ['name'=> $testNameForm]);
    }

    public function testUnauthenticatedUserCannotCreateANewProject()
    {
        $testNameForm = 'PostMan';
        $testDescrForm = 'PostDescription';
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $response = $this->post('/project', ['name'=> $testNameForm, 'description'=> $testDescrForm]);
    }



    public function testUnauthenticatedUserCannotShowDashboard()
    {
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $response = $this->get('/dashboard');
    }

    public function testAuthenticatedUserCanShowDashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard')->assertStatus(200);
    }



    public function testUnauthenticatedUserCannotShowTheFormToCreateANewProject()
    {
        $this->expectException(\Illuminate\Auth\Access\AuthorizationException::class);
        $response = $this->get('/project/create');
    }
}