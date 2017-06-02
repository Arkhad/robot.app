<?php

namespace App\Http\Controllers;

use DB;
use Cache;
use App\Tag; // alias pour composer
use App\Robot; // alias pour composer
use App\Category;
use Illuminate\Http\Request;

class FrontController extends Controller {

    public function __construct() {
        view()->composer('partials.nav', function ($view) {

            $categories = DB::table('categories')->select('title', 'id')->get();

            $currentId = (request()->segment(1) == 'category') ? request()->segment(2) : 'home';

            $view->with('categories', $categories);
            $view->with('currentId', $currentId);

        });
    }

    public function index() {
        $suffixe = request()->page == null ? 1 : request()->page;
        $key = 'home' .  $suffixe;  // http://locahost/?page = 1 affichera dans ce cas 1
       
        if(Cache::has($key)) {
            $robots = Cache::get($key);
        }else{
            $robots = Robot::with('tags', 'category')->published()->power()->paginate(env('PAGINATION'));
            Cache::put($key, $robots, \Carbon\Carbon::now()->addSeconds(30) );
        }

        $public = Robot::with('tags', 'category')->published()->count();

        return view('front.home', compact('robots', 'public'));
    }

    public function showRobot(int $id, string $slug = '') {

        $robot = Robot::findOrFail($id);
        $title = $robot->category ? $robot->category->title : 'Page Robot';

        return view('front.single', compact('robot', 'title')); // ['robot'=> $robot, 'title' => $title];
    }

    public function showRobotByTag(int $id) {

        $robots = Tag::findOrFail($id)->robots;
        $tagId = $id;

        return view('front.tag', compact('robots', 'tagId'));
    }

    public function showRobotByCategory(int $id) {

        $category = Category::findOrFail($id);
        $robots = $category->robots()->with('tags', 'category')->published('unpublished')->paginate(env('PAGINATION'));
        $title = $category->title;

        return view('front.category', compact('robots', 'title'));

    }
}
