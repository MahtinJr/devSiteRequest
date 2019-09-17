// clear input data when document reloaded
$(document).ready(function() {
	$('input').val('');
	$('textarea').val('');
	$(".dropdown").prop('selectedIndex', 0);
});

// hide the copy from copy to fields
$('#subDomainOne').hide();
$('#subDomainTwo').hide();

// show copy from copy to fields when copy of selected
$('.dropdown').on('change', function() {
  if ( this.value == 'fresh install' ) {
    $('#subDomainOne').show();
    $('#subDomainTwo').hide();
  } else if ( this.value == 'copy of' ) { 
    $('#subDomainTwo').show();
    $('#subDomainOne').hide();
  }
});

// add hyphen to ticket input
//$('input[name="ticket"]').keyup(function() {
	//$(this).attr('maxlength', '11');
	//$(this).val($(this).val().replace(/([a-z]{3})\-?(\d{3})\-?(\d{5})/,'$1-$2-$3'));
//});

//            $('input[name="ticket"]').keydown(function (e) {
//                $key = e.charCode || e.keyCode || 0;
//                $inputVal = $(this);
//		$(this).attr('maxlength', '13');
//
//               if ($inputVal.val().length === 3) {
//                    $inputVal.val($inputVal.val() + '-');
//                } 
//                if ($inputVal.val().length === 7) {
//                    $inputVal.val($inputVal.val() + '-');
//                }		       
//           });


// Wait for the DOM to be ready
$( document ).ready(function() {
  $("form[name='contactForm']").validate({
    // validation rules
    rules: {
      domain: "required",
      ticket: "required",
      request: {
        required: function() {
          if ($('.dropdown').val() == null) {
            return true
          }
        }
      },
      subDomain: {
        required: function() {
          if ($('.dropdown').val() == "fresh install") {
            return true
          } else {
            return false
          }
        }
      },
      subDomainFrom: {
        required: function() {
          if ($('.dropdown').val() == "copy of") {
            return true
          }
        }
      },
      subDomainTo: {
        required: function() {
          if ($('.dropdown').val() == "copy of") {
            return true
          }
        }
      },
      email: {
        required: true,
        email: true
      }
    },
    // validation error messages
    messages: {
      domain: "✘",
      ticket: "✘",
      request: "✘",
      subDomain: "✘",
      subDomainFrom: "✘",
      subDomainTo: "✘",
      email: "✘"
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
