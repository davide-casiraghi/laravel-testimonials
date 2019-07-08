<?php

namespace DavideCasiraghi\LaravelTestimonials\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroupTranslation;

class TestimonialGroupTranslationController extends Controller
{
    /***************************************************************************/

    /**
     * Show the form for creating a new resource.
     * @param int $testimonialId
     * @param string $languageCode
     * @return \Illuminate\Http\Response
     */
    public function create($testimonialGroupId, $languageCode)
    {
        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-testimonials::testimonialGroupTranslations.create')
                ->with('testimonialGroupId', $testimonialGroupId)
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
    public function edit($testimonialGroupId, $languageCode)
    {
        $testimonialGroupTranslation = TestimonialGroupTranslation::where('testimonial_group_id', $testimonialGroupId)
                        ->where('locale', $languageCode)
                        ->first();

        $selectedLocaleName = $this->getSelectedLocaleName($languageCode);

        return view('laravel-testimonials::testimonialGroupTranslations.edit', compact('testimonialGroupTranslation'))
                    ->with('testimonialGroupId', $testimonialGroupId)
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
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonialGroupTranslation = new TestimonialGroupTranslation();

        $this->saveOnDb($request, $testimonialGroupTranslation, 'save');

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group translation added succesfully');
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
                'title' => 'required',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $testimonialGroupTranslation = TestimonialGroupTranslation::find($request->get('testimonial_group_translation_id'));

        //dd($testimonialGroupTranslation);
        $this->saveOnDb($request, $testimonialGroupTranslation, 'update');

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group translation added succesfully');
    }

    /***************************************************************************/

    /**
     * Save the record on DB.
     * @param  \Illuminate\Http\Request  $request
     * @param  \DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroupTranslation  $testimonialGroupTranslation
     * @return void
     */
    public function saveOnDb($request, $testimonialGroupTranslation, $saveOrUpdate)
    {
        //dd($testimonialTranslation);
        $testimonialGroupTranslation->title = $request->get('title');
        $testimonialGroupTranslation->description = $request->get('description');
        $testimonialGroupTranslation->button_text = $request->get('button_text');

        switch ($saveOrUpdate) {
            case 'save':
                $testimonialGroupTranslation->testimonial_group_id = $request->get('testimonial_group_id');
                $testimonialGroupTranslation->locale = $request->get('language_code');
                $testimonialGroupTranslation->save();
                break;
            case 'update':
                $testimonialGroupTranslation->update();
                break;
        }
    }

    /***************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $testimonialGroupTranslationId
     */
    public function destroy($testimonialGroupTranslationId)
    {
        $testimonialGroupTranslation = TestimonialGroupTranslation::find($testimonialGroupTranslationId);
        $testimonialGroupTranslation->delete();

        return redirect()->route('testimonialGroups.index')
                            ->with('success', 'Testimonial group translation deleted succesfully');
    }
}
