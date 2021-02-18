<?php

namespace App\Http\Controllers;

use App\Models\Coffee;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Symfony\Component\Console\Input\Input;

class CoffeeController extends Controller
{
    /**
     * Display the make coffee page
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index() : View
    {
        // Get Coffee's with Default Options
        $coffees = Coffee::with('options')->get();
        $options = Option::all();
        return view('welcome', compact('coffees', 'options'));
    }

    /**
     * Display the created coffee
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) : View
    {
        // Validate the Input
        $this->validate($request, [
            'options' => 'required',
            'options.*.id' => 'exists:options,id',
            'coffee' => 'required|exists:coffees,id',
        ]);
        
        // Realistically this would be much easier if we are creating a new model for the result,
        // Which then has a many-to-many relationship with options.
        // Because there is no new table to store the created coffees within the spec (or need to store them at all)
        // We will have to map the id's again, from the whereIn, this way we're still only doing on DB query.
        
        $coffee = Coffee::find($request->get('coffee'));
        $option_ids = collect($request->get('options'))->pluck('id');
        $optionsUnique = collect(Option::whereIn('id', $option_ids)->get()->getDictionary());
        
        // Allow retrieval of duplicated records by mapping the ID's to the Options returned
        $options = collect($option_ids)->map(function ($id) use ($optionsUnique) {
            return $optionsUnique->get($id); 
        })->all();

        // Manually set the relation to the coffee object.
        $coffee->setRelation('options', $options);
        return view('welcome', compact('coffee'));
    }
}
