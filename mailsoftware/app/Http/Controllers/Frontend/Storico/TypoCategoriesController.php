<?php

namespace App\Http\Controllers\Frontend\Storico;

use App\Http\Controllers\Controller;
use App\Models\TypoCategories;
use Illuminate\Http\Request;

class TypoCategoriesController extends Controller
{

    private $master_array = array();
    private $middle_array = array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_categories = TypoCategories::select('uid', 'title', 'parent')
            ->where('parent', 0)
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->OrderBy('parent')
            ->OrderBy('uid')
            ->get();

        $master_categories->each(function ($master_category){
            $this->master_array[] = $master_category->uid;
        });


        $middle_categories = TypoCategories::select('uid', 'title', 'parent')
            ->whereIn('parent', $this->master_array)
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->OrderBy('parent')
            ->OrderBy('uid')
            ->get();

        $middle_categories->each(function ($middle_category){
            $this->middle_array[] = $middle_category->uid;
        });

        $categories = TypoCategories::select('uid', 'title', 'parent')
            ->whereIn('parent', $this->middle_array)
            ->where('hidden', 0)
            ->where('deleted', 0)
            ->OrderBy('parent')
            ->OrderBy('title')
            ->get();

//        dd($categories);

        return view('frontend.spese.categories')
            ->with(compact('master_categories'))
            ->with(compact('middle_categories'))
            ->with(compact('categories'));
    }

}
