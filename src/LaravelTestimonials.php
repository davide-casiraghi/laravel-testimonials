<?php

namespace DavideCasiraghi\LaravelTestimonials;

use DavideCasiraghi\LaravelTestimonials\Models\Testimonial;
use DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup;

class LaravelTestimonials
{
    /**
     *  Provide the testimonial data array.
     *
     *  @param int $testimonialId
     *  @return  \DavideCasiraghi\LaravelTestimonials\Models\Testimonial    $ret
     **/
    public static function getTestimonial($testimonialId)
    {
        $ret = Testimonial::where('id', $testimonialId)->first();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Provide the testimonials of a specfied group.
     *
     *  @param int $testimonialId
     *  @return  \DavideCasiraghi\LaravelTestimonials\Models\Testimonial    $ret
     **/
    public static function getTestimonialsByGroup($testimonialGroupId)
    {
        $ret = Testimonial::where('testimonials_group', $testimonialGroupId)->get();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Provide the testimonial group data array.
     *
     *  @param int $testimonialGroupId
     *  @return  \DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup    $ret
     **/
    public static function getTestimonialGroup($testimonialGroupId)
    {
        $ret = TestimonialGroup::where('id', $testimonialGroupId)->first();

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Find the testimonial snippet occurances in the text.
     *
     *  @param string $text
     *  @return array $matches
     **/
    public static function getTestimonialGroupSnippetOccurrences($text)
    {
        $re = '/{\#
            \h+testimonial_group
            \h+(t_group_id)=\[([^]]*)]
            \h*\#}/x';

        if (preg_match_all($re, $text, $matches, PREG_SET_ORDER, 0)) {
            return $matches;
        } else {
            return;
        }
    }

    /**************************************************************************/

    /**
     *  Returns the plugin parameters.
     *
     *  @param array $matches
     *  @return array $ret
     **/
    public static function getSnippetParameters($matches)
    {
        $ret = [];

        // Get activation string parameters (from article)
        $ret['token'] = $matches[0];
        //dump($matches);

        $ret['t_group_id'] = $matches[2];

        return $ret;
    }

    /**************************************************************************/

    /**
     *  Return the same text with the testimonials HTML replaced
     *  where the token strings has been found.
     *
     *  @param string $text
     *  @return string $ret
     **/
    public function replace_testimonial_group_snippets_with_template($text)
    {
        $matches = self::getTestimonialGroupSnippetOccurrences($text);
        // aaaaaa

        if (! empty($matches)) {
            foreach ($matches as $key => $single_gallery_matches) {
                $snippetParameters = self::getSnippetParameters($single_gallery_matches);

                $testimonialGroupId = $snippetParameters['t_group_id'];

                $testimonialGroup = self::getTestimonialGroup($testimonialGroupId);
                $testimonialGroupParameters = ($testimonialGroup) ? (self::getParametersArray($testimonialGroup)) : null;
                $testimonials = self::getTestimonialsByGroup($testimonialGroupId);

                $testimonialView = self::showTestimonialGroup($testimonialGroup, $testimonialGroupParameters, $testimonials);
                $testimonialHtml = $testimonialView->render();

                // Substitute the testimonial html to the token that has been found
                $text = str_replace($snippetParameters['token'], $testimonialHtml, $text);
            }
        }

        $ret = $text;

        return $ret;
    }

    /***************************************************************************/

    /**
     * Show a Testimonial group.
     *
     * @param  \DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup $testimonialGroup
     * @param array $testimonialGroupParameters
     * @param  \DavideCasiraghi\LaravelTestimonials\Models\Testimonial $testimonials
     * @return \Illuminate\Http\Response
     */
    public function showTestimonialGroup($testimonialGroup, $testimonialGroupParameters, $testimonials)
    {
        return view('laravel-testimonials::show-testimonial-group', compact('testimonialGroup'))
        ->with('testimonialGroupParameters', $testimonialGroupParameters)
        ->with('testimonials', $testimonials);
    }

    /***************************************************************************/

    /**
     * Return an array with the parameters for the testimonial.
     * @param  \DavideCasiraghi\LaravelTestimonials\Models\TestimonialGroup  $testimonialGroup
     * @return array
     */
    public static function getParametersArray($testimonialGroup)
    {
        if ($testimonialGroup->show_title) {
            $title_style = 'display: block; ';
        } else {
            $title_style = 'display: none; ';
        }

        $ret = [
            'title_style' => $title_style,
        ];

        return $ret;
    }
}
