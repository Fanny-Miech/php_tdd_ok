<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

use App\Mail\DonationShipped;
use App\Mail\DonationShippedAuthor;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate ([
            'amount'=>'required | integer',
            // 'project_id'=>'required | integer'
        ]);

        if (Auth::check()){
            $donation = Donation::create([
                'amount'=>$request->amount,
                'project_id'=>$request->project_id,
                'user_id'=>Auth::id()
            ]);


            //Send a mail to the donator
            Mail::to(Auth::user()->email)->send(new DonationShipped($donation));

            //Send a mail to the project owner
            $projectOwner = $donation->project->user;
            Mail::to($projectOwner->email)->send(new DonationShippedAuthor($donation));

            return redirect("/project/{$request->project_id}/donation");
            //return view('validateDonation', ['donation'=>$donation]);
        }
        else return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }


    // public function ship(Request $request, $donationId)
    // {
    //     $donation = Donation::findOrFail($donationId);

    //     //ship order

    //     Mail::to($request->user())->send(new DonationShipped($donation));
    // }

    // public function ship($donationId)
    // {
    //     $donation = Donation::findOrFail($donationId);

    //     event(new DonationShipped($donation));
    // }
}
