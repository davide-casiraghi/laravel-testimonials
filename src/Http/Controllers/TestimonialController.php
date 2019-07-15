<?php

namespace DavideCasiraghi\LaravelTestimonials\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use DavideCasiraghi\LaravelTestimonials\Models\Testimonial;
use Intervention\Image\ImageManagerStatic as Image;
use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup;
use DavideCasiraghi\LaravelTestimonials\Facades\LaravelTestimonials;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use DavideCasiraghi\LaravelFormPartials\Facades\LaravelFormPartials;

class TestimonialController extends Controller
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
            $testimonials = Testimonial::
                        select('testimonial_translations.testimonial_id AS id', 'name', 'body', 'image_file_name', 'locale')
                        ->join('testimonial_translations', 'testimonials.id', '=', 'testimonial_translations.testimonial_id')
                        ->orderBy('name')
                        ->where('name', 'like', '%'.$searchKeywords.'%')
                        ->where('locale', 'en')
                        ->paginate(20);
        } else {
            $testimonials = Testimonial::
                        select('testimonial_translations.testimonial_id AS id', 'name', 'body', 'image_file_name', 'locale')
                        ->join('testimonial_translations', 'testimonials.id', '=', 'testimonial_translations.testimonial_id')
                        ->where('locale', 'en')
                        ->orderBy('name')
                        ->paginate(20);
        }

        return view('laravel-testimonials::testimonials.index', compact('testimonials'))
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
        return view('laravel-testimonials::testimonials.create')
                    ->with('testimonialGroupsArray', $this->getTestimonialGroupsArray());
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
                'name' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonial = new Testimonial();

        // Set the default language to edit the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $testimonial);

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial added succesfully');
    }

    /***************************************************************************/

    /**
     * Display the specified resource.
     *
     * @param  int $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function show($testimonialId = null)
    {
        //$testimonial = Testimonial::find($testimonialId);
        $testimonial = Laraveltestimonials::getTestimonial($testimonialId);
        $testimonialParameters = ($testimonial) ? (Laraveltestimonials::getParametersArray($testimonial)) : null;

        return view('laravel-testimonials::testimonials.show', compact('testimonial'))
                ->with('testimonialParameters', $testimonialParameters);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function edit($testimonialId = null)
    {
        $testimonial = Testimonial::find($testimonialId);

        return view('laravel-testimonials::testimonials.edit', compact('testimonial'))
                    ->with('testimonialGroupsArray', $this->getTestimonialGroupsArray());
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $testimonialId)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonial = Testimonial::find($testimonialId);

        // Set the default language to update the quote in English
        App::setLocale('en');

        $this->saveOnDb($request, $testimonial);

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial updated succesfully');
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $testimonialId
     * @return \Illuminate\Http\Response
     */
    public function destroy($testimonialId)
    {
        $testimonial = Testimonial::find($testimonialId);
        $testimonial->delete();

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial deleted succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\Laraveltestimonials\Models\Testimonial  $testimonial
     * @return void
     */
    public function saveOnDb($request, $testimonial)
    {
        $testimonial->translateOrNew('en')->name = $request->get('name');
        $testimonial->translateOrNew('en')->body = $request->get('body');
        $testimonial->translateOrNew('en')->profession = $request->get('profession');

        $testimonial->testimonials_group = $request->get('testimonials_group');
        $testimonial->gender = $request->get('gender');
        $testimonial->image_file_name = $request->get('image_file_name');

        // Testimonial image upload
        $imageSubdir = 'testimonials';
        $imageWidth = '1067';
        $thumbWidth = '690';
        $testimonial->image_file_name = LaravelFormPartials::uploadImageOnServer($request->file('image_file_name'), $request->image_file_name, $imageSubdir, $imageWidth, $thumbWidth);

        $testimonial->save();
    }

    /***************************************************************************/

    /**
     * Return and array with the testimonial groups.
     *
     * @return array
     */
    public static function getTestimonialGroupsArray()
    {
        $ret = TestimonialGroup::listsTranslations('title')->orderBy('title')->pluck('title', 'id');

        return $ret;
    }
}
