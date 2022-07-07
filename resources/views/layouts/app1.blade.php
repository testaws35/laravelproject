<!DOCTYPE html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  -->
    <html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to Telungu  Viswakarma TN </title>

    <!-- Scripts --
    <script src="{{ asset('js/app.js') }}" defer></script>
    -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicons -->


  <link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/frontend_css/custom.css') }}" />
<link rel="stylesheet" href="{{ asset('css/frontend_css/plugins.css') }}" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('images/frontend_images/icons') }}" /> 
 <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" /> 
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.css') }} ">

	<!-- Modernizer js -->
<script src="{{ asset('js/frontend_js/vendor/modernizr-3.5.0.min.js') }}"></script>
       <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
         <!--  emoji -->
 <link rel="stylesheet" href="{{ asset('css/frontend_css/emoji.css')}}" />
        <!-- end emoji   -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

 
    
   <!-- Include Events and Members IMP -->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    -->




   <!-- Include Events and Members IMP -->
<!-- Include Events and Members IMP -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <!--<link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css">-->
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet"> -->
   <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    
    <script>
    $(document).ready(function() {
        $('body').bootstrapMaterialDesign();
    });</script>  <!-- End Include Events and Members -->


 @stack('css')   {{--Any styles you 'push' will go here --}}
<style>
               #myCarousel .carousel-inner > .next.left, #myCarousel .carousel-inner > .prev.right {
    left: 0 !important;
}

#myCarousel .carousel-inner .active.left  { left: -20%;             }
#myCarousel .carousel-inner .active.right { left: 20%;              }
#myCarousel .carousel-inner .next         { left: 20%               }
#myCarousel .carousel-inner .prev         { left: -20%              }
#myCarousel .carousel-control.left        { background-image: none; }
#myCarousel .carousel-control.right       { background-image: none; }
.img-responsive1{
    display: block;
    max-width: 100%;
    height:438px !important;
}
    </style>
    

</head>

<body>
    <!-- layout structure -->
    <div id="app">

        @include('inc.navbar')

        <main > <br/><!-- class="py-4"  -->
            @yield('content')
        </main>
    </div>

    @include('inc.footer')
    
    
    
     <!-- JS Files -->
     <script src="{{ asset('js/frontend_js/vendor/jquery-3.2.1.min.js') }}"></script> 
     <script src="{{ asset('js/frontend_js/popper.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/frontend_js/plugins.js') }}"></script>
    <script src="{{ asset('js/frontend_js/active.js') }}"></script> 
<!-- FlexSlider -->
        <script src="{{ asset('js/jquery.toast.js') }}"></script>

<!-- Begin emoji-picker JavaScript -->
    <script src="{{ asset('js/frontend_js/lib/js/config.js')}}"></script>
    <script src=" {{ asset('js/frontend_js/lib/js/util.js')}}"></script>
    <script src="{{ asset('js/frontend_js/lib/js/jquery.emojiarea.js')}}"></script>
    <script src="{{ asset('js/frontend_js/lib/js/emoji-picker.js')}}"></script> 
<!-- End emoji-picker JavaScript -->
    <!-- START emojiPicker -->
   
    <script>
          $(function() {
                // Initializes and creates emoji set from sprite sheet
                window.emojiPicker = new EmojiPicker({
                  emojiable_selector: '[data-emojiable=true]',
                  assetsPath: 'https://www.tecpleglobal.com/emoji-img',
                  popupButtonClasses: 'fa fa-smile-o'
                });
                // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
                // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
                // It can be called as many times as necessary; previously converted input fields will not be converted again
                window.emojiPicker.discover();
          });
    </script>
    <!-- END emojiPicker -->


    <script type="text/javascript">
    	$(function(){
    	  SyntaxHighlighter.all();
    	});
    	$(window).load(function(){
    	  $('.flexslider').flexslider({
    		animation: "slide",
    		start: function(slider){
    		  $('body').removeClass('loading');
    		}
    	  });
    	});
    </script>
    <!-- FlexSlider -->	
                <script>
                    $('input[type=text]').bind('input', function () {
                        var c = this.selectionStart,
                            r = /[^a-z 0-9 ,#'-.]/gi,
                            v = $(this).val();
                        if (r.test(v)) {
                            $(this).val(v.replace(r, ''));
                            c--;
                        }
                        this.setSelectionRange(c, c);
                    });
               </script>
                <script>
            
                    $('#comment').bind('textarea', function () {
                        var c = this.selectionStart,
                            r = /[^a-z 0-9 ]/gi,
                            v = $(this).val();
                        if (r.test(v)) {
                            $(this).val(v.replace(r, ''));
                            c--;
                        }
                        this.setSelectionRange(c, c);
                    });
               </script>
               <script>
                  function photocheck(){
                      valStr= $('input[type="file"]').val();
                      if(valStr == "")
                      {
                          
                          $('#Photo_error').html('Please choose the file');
                          
                      }
                      else
                      {
                          $('#Photo_error').html("");
                      }
                  }
               </script>
                <script>
                  function checkfile()
                  {
                      valStr= $('input[type="file"]').val();
                      if(!$('input[type="file"]').val()) 
                      {
                          // No file is uploaded, do not submit.
                          
                          return false;
                      }
                                    
                      var ext = valStr.substring(valStr.lastIndexOf('.') + 1).toLowerCase(); // get file extention 
                      if ($.inArray(ext, ['png', 'jpg', 'jpeg','bmp']) == -1) 
                      {
                              $('#Photo_error').html('Please choose the files of type .png,.jpg,.jpeg, .bmp');
                              $('input[type="file"]').val('');
                              return false;
                              event.preventDefault();
                      }
                      else
                      {
                          $('#Photo_error').html("");
                      }
                      var fileUpload = document.getElementById("Photo");
            
                      if (typeof (fileUpload.files) != "undefined") 
                      {
                              var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
                              if(size >1024)
                              {
                                  $('#Photo_error').html('Please choose the files within 1MB');                      
                                  $('input[type="file"]').val('');
                                  event.preventDefault();
                                  return false;
                              }
                              else
                              {
                                  $('#Photo_error').html("");
                              }
                      }
                      
                      var fileUpload_1 = document.getElementById("Photo_1");
                      if (typeof (fileUpload_1.files) != "undefined") 
                      {
                              var size = parseFloat(fileUpload_1.files[0].size / 1024).toFixed(2);
                              if(size >1024)
                              {
                                  $('#Photo_error').html('Please choose the files within 1MB');                      
                                  $('input[type="file"]').val('');
                                  event.preventDefault();
                                  return false;
                              }
                              else
                              {
                                  $('#Photo_error').html("");
                              }
                      }
                  }
                </script>
                <!--video validation-->
                <script>
                  function checkvideofile()
                  {
                      valStr= $('#Video').val();
                      if(valStr == "") 
                      {
                          // No file is uploaded, do not submit.
                          
                          return false;
                      }
                                    
                      var ext = valStr.substring(valStr.lastIndexOf('.') + 1).toLowerCase(); // get file extention 
                      if ($.inArray(ext, ['mp4']) == -1) 
                      {
                              $('#Video_error').html('Please choose the files of type .mp4');
                              $('input[type="file"]').val('');
                              return false;
                              event.preventDefault();
                      }
                      else
                      {
                          $('#Photo_error').html("");
                      }
                      var fileUpload = document.getElementById("Video");
            
                      if (typeof (fileUpload.files) != "undefined") 
                      {
                              var size = parseFloat(fileUpload.files[0].size / 2048).toFixed(2);
                              if(size >2048)
                              {
                                  $('#Video_error').html('Please choose the files within 2MB');                      
                                  $('input[type="file"]').val('');
                                  event.preventDefault();
                                  return false;
                              }
                              else
                              {
                                  $('#Video_error').html("");
                              }
                      }
                      
                      
                  }
                </script>
                
                
<script>
    

$('#myCarousel').carousel({
    interval: false
})

$('#myCarouselBig').on('slide.bs.carousel', function (event) {
    if (event.direction == 'left') $('#myCarousel').carousel('next');
    else {
        $('#myCarousel').carousel('prev');
        $('#myCarousel').carousel('pause');
    }
})
</script>
<script>
    
    function showsismarried()
    {
        var sisnum_marr =  document.getElementById("sisnum").value;
        if(sisnum_marr !== "0" && sisnum_marr !== "null")
        {
            $("#showsismrr").css('display','block');
        }
        else
        {
            
        }
    }
    
    function showbromarried()
    {
        var bronum_marr =  document.getElementById("bronum").value;
        if(bronum_marr !== "0" && bronum_marr !== "null")
        {
            $("#showbromrr").css('display','block');
        }
        else
        {
            
        }
    }
    
     function validatesismrr()
     {
         var sisnum_marr =  document.getElementById("sisnum").value;
         var sis_mrr =  document.getElementById("sismrr_no").value;
         if(sis_mrr == "")
         {
              $("#sismrr_no_error").css('display','block');
              $("#sismrr_no_error").fadeOut(6500);
              valid=false;
              event.preventDefault();
              return false;
         }
         else if(sis_mrr > sisnum_marr )
         {
              $("#sismrr_no_error_1").css('display','block');
              $("#sismrr_no_error_1").fadeOut(6500);
              valid=false;
              event.preventDefault();
              return false;
         }
         else
         {
             return true;
         }
     }
     
     function validatebromrr()
     {
         var bronum_marr =  document.getElementById("bronum").value;
         var bro_mrr =  document.getElementById("bromrr_no").value;
         if(bro_mrr == "")
         {
              $("#bromrr_no_error").css('display','block');
              $("#bromrr_no_error").fadeOut(6500);
              
               event.preventDefault();
               return false;
         }
         else if(bro_mrr > bronum_marr)
         {
              $("#bromrr_no_error_1").css('display','block');
              $("#bromrr_no_error_1").fadeOut(6500);
              
              event.preventDefault();
              return false;
         }
         {
             return true;
         }
     }
     
     function validatenatchithram()
     {
        var nat = $('#natchithram option:selected').val();
        if(nat == 0)
        {
            $("#natchithram_error").css('display','block');
            $("#natchithram_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     
     function validaterashi()
     {
        var rash = $('#rashi option:selected').val();
        if(rash == 0)
        {
            $("#rashi_error").css('display','block');
            $("#rashi_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     function validatedosam()
     {
        var dosam = $('#dosam option:selected').val();
        if(dosam == 0)
        {
            $("#dosam_error").css('display','block');
            $("#dosam_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     function validatestar()
     {
        var star = $('#star option:selected').val();
        if(star == 0)
        {
            $("#star_error").css('display','block');
            $("#star_error").fadeOut(6500);
            event.preventDefault();
            return false;
        }
         
         
     }
     
     
   
    
</script>

</body>
</html>
