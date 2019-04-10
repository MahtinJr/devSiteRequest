$('#subDomainOne').hide();
$('#subDomainTwo').hide();

$('.dropdown').on('change', function() {
  if ( this.value == 'fresh install' ) {
    $('#subDomainOne').show();
    $('#subDomainTwo').hide();
  } else if ( this.value == 'copy of' ) { 
    $('#subDomainTwo').show();
    $('#subDomainOne').hide();
  }
});