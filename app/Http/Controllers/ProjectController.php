<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    use DatabaseMigrations;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     return view('projects', ['projects'=>Project::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // if (Auth::check()){
           // $this->authorize('create', Project::class);
            return view('add-project');
    //     }
    //    else return redirect('/dashboard');
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
            'name'=>'required | string | max:70',
            'description'=>'required | alpha_dash',
            'published_at'=>'date'
        ]);

        Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'published_at'=>now(),
            'author'=>Auth::id()
        ]);
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('project', ['project'=> $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check()){
            $project=Project::findOrFail($id);
            //dd($project);
            Gate::authorize('update-project', $project);
            $project_u=User::all();
            return view('editProject', ['project'=>$project, 'project_u'=>$project_u]);
        }
        else redirect('/dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::check()){
            $request->validate([
                'name'=> 'required | string | max:70',
                'description'=>'required'
            ]);
            Project::findOrFail($id)->update($request->all());
            return redirect('/project');
        }
        else redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()){
            $project_id=Project::where('id',$id)->delete();
            return redirect('/project');
        }
        else redirect('/dashboard');
    }
}
