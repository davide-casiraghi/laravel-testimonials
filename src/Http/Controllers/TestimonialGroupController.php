<?php

namespace DavideCasiraghi\LaravelTestimonials\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\LaravelTestimonials\Models\Testimonial;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup;
use DavideCasiraghi\LaravelTestimonials\Facades\LaravelTestimonials;

class TestimonialGroupController extends Controller
{
    /* Restrict the access to this resource just to logged in users */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchKeywords = $request->input('keywords');
        //$searchCategory = $request->input('category_id');
        $countriesAvailableForTranslations = LaravelLocalization::getSupportedLocales();

        if ($searchKeywords) {
            $testimonialGroups = TestimonialGroup::
                        select('testimonial_group_translations.t_group_id AS id', 'title', 'locale')
                        ->join('testimonial_group_translations', 'testimonial_groups.id', '=', 'testimonial_group_translations.t_group_id')
                        ->orderBy('title')
                        ->where('title', 'like', '%'.$searchKeywords.'%')
                        ->where('locale', 'en')
                        ->paginate(20);
        } else {
            $testimonialGroups = TestimonialGroup::
                        select('testimonial_group_translations.t_group_id AS id', 'title', 'locale')
                        ->join('testimonial_group_translations', 'testimonial_groups.id', '=', 'testimonial_group_translations.t_group_id')
                        ->where('locale', 'en')
                        ->orderBy('title')
                        ->paginate(20);
        }

        return view('laravel-testimonials::testimonialGroups.index', compact('testimonialGroups'))
                     ->with('i', (request()->input('page', 1) - 1) * 20)
                     ->with('searchKeywords', $searchKeywords)
                     ->with('countriesAvailableForTranslations', $countriesAvailableForTranslations);
    }

    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laravel-testimonials::testimonialGroups.create');
    }

    /***************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonialGroup = new TestimonialGroup();

        // Set the default language to edit the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $testimonialGroup);

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  int $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function show($testimonialGroupId = null)
    {
        $testimonialGroup = Laraveltestimonials::getTestimonialGroup($testimonialGroupId);
        $testimonialGroupParameters = ($testimonialGroup) ? (Laraveltestimonials::getParametersArray($testimonialGroup)) : null;
        $testimonials = Laraveltestimonials::getTestimonialsByGroup($testimonialGroupId);
        //dd($testimonialGroup);
        return view('laravel-testimonials::testimonialGroups.show', compact('testimonialGroup'))
                ->with('testimonialGroup', $testimonialGroup)
                ->with('testimonialGroupParameters', $testimonialGroupParameters)
                ->with('testimonials', $testimonials);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function edit($testimonialGroupId = null)
    {
        $testimonialGroup = TestimonialGroup::find($testimonialGroupId);

        return view('laravel-testimonials::testimonialGroups.edit', compact('testimonialGroup'));
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $testimonialGroupId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $testimonialGroupId)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonialGroup = TestimonialGroup::find($testimonialGroupId);

        // Set the default language to update the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $testimonialGroup);

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group updated succesfully');
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $testimonialGroupId
     * @return \Illuminate\Http\Response
     */
    public function destroy($testimonialGroupId)
    {
        $testimonialGroup = TestimonialGroup::find($testimonialGroupId);
        $testimonialGroup->delete();

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group deleted succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\Laraveltestimonials\Models\TestimonialGroup  $testimonial
     * @return void
     */
    public function saveOnDb($request, $testimonialGroup)
    {
        $testimonialGroup->translateOrNew('en')->title = $request->get('title');
        $testimonialGroup->quotes_color = $request->get('quotes_color');
        $testimonialGroup->max_characters = $request->get('max_characters');
        $testimonialGroup->show_title = filter_var($request->show_title, FILTER_VALIDATE_BOOLEAN);
        $testimonialGroup->save();
    }
}
