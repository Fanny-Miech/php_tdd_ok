<?php

namespace Tests\Feature;

use App\Mail\DonationShipped;
use App\Mail\DonationShippedAuthor;
use App\Models\Donation;
use App\Models\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    use DatabaseMigrations;


    public function testDonationShippingToProjectDonatorAndAuthor()
    {
        //given
        $project = Project::factory()->create();
        $testAmount = '10';
        Mail::fake();

        // $donation = Donation::factory()->create([
        //     'project_id'=>$project->id
        // ]);

        //when
        $this->actingAs($project->user)->post('/project/'.$project->id.'/donation', ['amount'=> $testAmount, 'project_id'=> $project->id]);

        dump($project->donations->last()->id);

        //then
        Mail::assertSent(function (DonationShipped $mail) use ($project) {
            dump($mail->donation->id);
            return $mail->donation->id === $project->donations->last()->id;
        });
        Mail::assertSent(function (DonationShippedAuthor $mail) use ($project) {
            return $mail->donation->id === $project->donations->last()->id;
        });
    }
}

