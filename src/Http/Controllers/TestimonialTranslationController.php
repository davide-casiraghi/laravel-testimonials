<?php

namespace DavideCasiraghi\LaravelTestimonials\Http\Controllers;

use DavideCasiraghi\LaravelTestimonials\Models\TestimonialTranslation;
use Illuminate\Http\Request;
use Validator;

class TestimonialTranslationController extends Controller
{
    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     * @param int $testimonialId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function create($testimonialId, $languageCode)
    {
        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-testimonials::testimonialsTranslations.create')
                ->with('testimonialId', $testimonialId)
                ->with('languageCode', $languageCode)
                ->with('selectedLocaleName', $selectedLocaleName);
    }

    /***************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $testimonialTranslationId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function edit($testimonialId, $languageCode)
    {
        $testimonialTranslation = TestimonialTranslation::where('testimonial_id', $testimonialId)
                        ->where('locale', $languageCode)
                        ->first();

        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-testimonials::testimonialsTranslations.edit', compact('testimonialTranslation'))
                    ->with('testimonialId', $testimonialId)
                    ->with('languageCode', $languageCode)
                    ->with('selectedLocaleName', $selectedLocaleName);
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

        $testimonialTranslation = new TestimonialTranslation();

        $this->saveOnDb($request, $testimonialTranslation, 'save');

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $testimonialTranslationId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Validate form datas
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonialTranslation = TestimonialTranslation::find($request->get('testimonial_translation_id'));

        //dd($testimonialTranslation);
        //$eventCategoryTranslation = EventCategoryTranslation::where('id', $request->get('event_category_translation_id'));

        //dd($testimonialTranslation);
        $this->saveOnDb($request, $testimonialTranslation, 'update');

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\LaravelTestimonials\Models\TestimonialTranslation  $testimonialTranslation
     * @return void
     */
    public function saveOnDb($request, $testimonialTranslation, $saveOrUpdate)
    {
        //dd($testimonialTranslation);
        $testimonialTranslation->name = $request->get('name');
        $testimonialTranslation->body = $request->get('body');
        $testimonialTranslation->profession = $request->get('profession');

        switch ($saveOrUpdate) {
            case 'save':
                $testimonialTranslation->testimonial_id = $request->get('testimonial_id');
                $testimonialTranslation->locale = $request->get('language_code');
                $testimonialTranslation->save();
                break;
            case 'update':
                $testimonialTranslation->update();
                break;
        }
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $testimonialTranslationId
     */
    public function destroy($testimonialTranslationId)
    {
        $testimonialTranslation = TestimonialTranslation::find($testimonialTranslationId);
        $testimonialTranslation->delete();

        return redirect()->route('testimonials.index')
                            ->with('success', 'Testimonial translation deleted succesfully');
    }
}
