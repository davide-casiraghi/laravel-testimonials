

@if ($testimonialGroup)
    
    <div class='testimonials py-4 px-2' style='{{$testimonialGroupParameters['container_style']}}'>
        
        <h3 class='mb-4'>{{$testimonialGroup['title']}}</h3>
    
        <div class='wrapper' style='{{$testimonialGroupParameters['wrapper_style']}}'>
        
            {{-- Testimonials --}}
    		@foreach ($testimonials as $key => $testimonial)
                
                <aside class='aside-{{$key}}' style='flex: @if ($testimonial->testimonial_flex) {{$testimonial->testimonial_flex}} @else {{$testimonialGroup->testimonials_flex}} @endif; '>
                    
                    {{-- Image --}}
                    @if ($testimonial->image_file_name)
                        <img style='{{$testimonialGroupParameters['image_style']}}' class='{{$testimonialGroupParameters['image_class']}}' src='/storage/images/testimonials/{{$testimonial->image_file_name}}'/>
                    @endif
                    
                    {{-- Text --}}
                    <h4 style='{{$testimonialGroupParameters['title_style']}}'>{{$testimonial->title}}</h4>
                    <img class='start-quote' src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-src='".$siteUrl."media/mod_lifequoteoftheday/img/start-quote-".$parameters['quotes_color'].".png' alt='Start Quote'>
                    <p style='{{$testimonialGroupParameters['description_style']}}'>{{$testimonial->body}}</p> 
					<img class='end-quote' src='data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=' data-src='".$siteUrl."media/mod_lifequoteoftheday/img/end-quote-".$parameters['quotes_color'].".png' alt='End Quote'>		
                
                    {{-- Author --}}
                    <div class='author {{$testimonialGroupParameters['group_button_style']}}'>
		    			{{$testimonial->author}}
                        @if($testimonial->profession), {{$testimonial->profession}} @endif
	    			</div>
                    
                
                </aside>    
                
            @endforeach	
            
        </div>              
                        

    </div>
    
@else
    <div class='alert alert-warning' role='alert'>The testimonial group with the specified id has not been found.</div>
@endif
