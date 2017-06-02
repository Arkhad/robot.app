<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Gate;
use App\Tag;
use App\Robot;
use App\Category;
use App\Http\Requests\RobotRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RobotController extends Controller
{

    use UserAdmin;

    public function __construct()
    {
        $this->setUser();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $robots = Robot::with('tags', 'category', 'user')->orderBy('id', 'desc')->paginate(10);

        return view('back.robot.index', compact('robots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Robot::class);
        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');


        return view('back.robot.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RobotRequest $request)
    {
        $robot = Robot::create($request->all());
        $robot->tags()->attach($request->tags);
        $robot->user_id = $request->user()->id;
        $robot->save();

        if($request->hasFile('link'))
        {
            $ext = $request->link->extension();
            $linkName = str_random(12) . '.' . $ext;
            $request->link->storeAs('images', $linkName ); // config/filesystem.php et aller changer  **
            $robot->link = $linkName;
            $robot->save();
            
        }

        return redirect()->route('robot.index')->with('message', sprintf('merci pour votre insertion du robot %s', $robot->name));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Robot $robot)
    {
        $this->authorize('edit', $robot);
        $categories = Category::pluck('title', 'id');
        $tags = Tag::pluck('name', 'id');

        return view('back.robot.edit', compact('tags', 'categories', 'robot'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RobotRequest $request, Robot $robot)
    {
        $this->authorize('update', $robot);
        $robot->update($request->all());
        $robot->tags()->sync($request->tags);

        return redirect()->route('robot.index')->with('message', sprintf('Le robot %s a bien été modifié.', $robot->name));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Robot $robot)
    {
        $this->authorize('delete', $robot);
        $name = $robot->name;
        $robot->delete();

        return redirect()->route('robot.index')->with('message', sprintf('Le robot %s a bien été effacé.', $name));
    }

    
}
