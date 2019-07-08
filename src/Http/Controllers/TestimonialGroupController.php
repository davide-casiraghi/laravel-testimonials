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
                        select('testimonial_group_translations.testimonial_group_id AS id', 'title', 'description', 'button_text', 'background_image', 'button_url', 'locale')
                        ->join('testimonial_group_translations', 'testimonial_groups.id', '=', 'testimonial_group_translations.testimonial_group_id')
                        ->orderBy('title')
                        ->where('title', 'like', '%'.$searchKeywords.'%')
                        ->where('locale', 'en')
                        ->paginate(20);
        } else {
            $testimonialGroups = TestimonialGroup::
                        select('testimonial_group_translations.testimonial_group_id AS id', 'title', 'description', 'button_text', 'background_image', 'button_url', 'locale')
                        ->join('testimonial_group_translations', 'testimonial_groups.id', '=', 'testimonial_group_translations.testimonial_group_id')
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
        return view('laravel-testimonials::testimonialGroups.create')
                    ->with('buttonColorArray', $this->getButtonColorArray());
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

        return view('laravel-testimonials::testimonialGroups.edit', compact('testimonialGroup'))
                    ->with('buttonColorArray', $this->getButtonColorArray());
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
                            ->with('success', 'Testimonial image updated succesfully');
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
                            ->with('success', 'Testimonial image deleted succesfully');
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
        $testimonialGroup->translateOrNew('en')->description = $request->get('description');
        $testimonialGroup->translateOrNew('en')->button_text = $request->get('button_text');
        $testimonialGroup->translateOrNew('en')->image_alt = $request->get('image_alt');

        $testimonialGroup->bkg_color = $request->get('bkg_color');
        $testimonialGroup->text_alignment = $request->get('text_alignment');
        $testimonialGroup->group_title_color = $request->get('group_title_color');
        $testimonialGroup->group_title_font_size = $request->get('group_title_font_size');
        $testimonialGroup->testimonial_title_color = $request->get('testimonial_title_color');
        $testimonialGroup->testimonial_title_font_size = $request->get('testimonial_title_font_size');
        $testimonialGroup->description_font_size = $request->get('description_font_size');
        $testimonialGroup->link_style = $request->get('link_style');
        $testimonialGroup->button_url = $request->get('button_url');
        $testimonialGroup->button_color = $request->get('button_color');
        $testimonialGroup->button_corners = $request->get('button_corners');
        $testimonialGroup->background_type = $request->get('background_type');
        $testimonialGroup->background_image = $request->get('background_image');
        $testimonialGroup->background_image_position = $request->get('background_image_position');
        $testimonialGroup->opacity = $request->get('opacity');
        $testimonialGroup->justify_content = $request->get('justify_content');
        $testimonialGroup->flex_wrap = $request->get('flex_wrap');
        $testimonialGroup->flex_flow = $request->get('flex_flow');
        $testimonialGroup->testimonials_flex = $request->get('testimonials_flex');
        $testimonialGroup->testimonials_padding = $request->get('testimonials_padding');
        $testimonialGroup->testimonials_box_sizing = $request->get('testimonials_box_sizing');
        $testimonialGroup->testimonials_round_images = $request->get('testimonials_round_images');
        $testimonialGroup->testimonials_images_width = $request->get('testimonials_images_width');
        $testimonialGroup->testimonials_images_hide_mobile = $request->get('testimonials_images_hide_mobile');
        $testimonialGroup->icons_size = $request->get('icons_size');

        //dd($testimonialGroup);

        // Testimonial group image upload
        $imageSubdir = 'testimonial_groups';
        $imageWidth = '1067';
        $thumbWidth = '690';
        $testimonialGroup->background_image = LaravelFormPartials::uploadImageOnServer($request->file('background_image'), $request->background_image, $imageSubdir, $imageWidth, $thumbWidth);

        $testimonialGroup->save();
    }

    /***************************************************************************/

    /**
     * Return and array with the button possible color options.
     *
     * @return array
     */
    public static function getButtonColorArray()
    {
        $ret = [
             'press-red' => 'Red',
             'press-pink' => 'Pink',
             'press-purple' => 'Purple',
             'press-deeppurple' => 'Deep purple',
             'press-indigo' => 'Indigo',
             'press-blue' => 'Blue',
             'press-lightblue' => 'Light blue',
             'press-cyan' => 'Cyan',
             'press-teal' => 'Teal',
             'press-green' => 'Green',
             'press-lightgreen' => 'Light green',
             'press-lime' => 'Lime',
             'press-yellow' => 'Yellow',
             'press-amber' => 'Amber',
             'press-orange' => 'Orange',
             'press-deeporange' => 'Deeporange',
             'press-brown' => 'Brown',
             'press-grey' => 'Grey',
             'press-bluegrey' => 'Blue grey',
             'press-black' => 'Black',
         ];

        return $ret;
    }
}
