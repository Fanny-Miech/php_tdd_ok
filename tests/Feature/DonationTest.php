<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use \App\Models\User;
use \App\Models\Project;
use \App\Models\Donation;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;


class DonationTest extends TestCase
{

    use DatabaseMigrations;
    

    public function testAuthenticatedUserCanMakeDonation()
    {
        //given
        $project = Project::factory()->create();

        //when
        $response=$this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> '10', 'project_id'=> $project->id])->assertStatus(302);

        //then
        $this->assertDatabaseHas('donations', ['amount'=> '10', 'user_id'=>$project->author, 'project_id'=>$project->id]);
    }


    public function testUnauthenticatedUserCannotMakeDonation()
    {
        $project=Project::factory()->create();
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $response = $this->post('/project/'.$project->id.'/donation', ['amount'=> '10', 'project_id'=> $project->id]);
    }



    public function testSeeDonationAmountOnDetailsDonationView()
    {
        //given
        $project = Project::factory()->create();
        $testAmount='10';

        //when
        $donation=$this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> $testAmount, 'project_id'=> $project->id]);
        $response=$this->actingAs($project->user)->get('/project/'.$project->id.'/donation');
       
        //then
        $response->assertSee($testAmount, false);

    }

    public function testIfUserCanDoSeveralDonations()
    {
        //given
        $project = Project::factory()->create();
        
        //when
        $this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> '10', 'project_id'=> $project->id]);
        $this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> '20', 'project_id'=> $project->id]);
        $this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> '30', 'project_id'=> $project->id]);

        //then
        $this->assertDatabaseHas('donations', ['amount'=> '10']);
        $this->assertDatabaseHas('donations', ['amount'=> '20']);
        $this->assertDatabaseHas('donations', ['amount'=> '30']);

    }



}