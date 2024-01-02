$(document).ready(function() {
	$('.delete-form').on('submit', function(e) {
	 	e.preventDefault();
	  	var button = $(this);
	  	

	  Swal.fire({
	    icon: 'warning',
	      title: 'Are you sure you want to delete this record?',
	      showDenyButton: false,
	      showCancelButton: true,
	      confirmButtonText: 'Yes'
	  }).then((result) => {
	    /* Read more about isConfirmed, isDenied below */
	    if (result.isConfirmed) {
	      $.ajax({
	        type: 'post',
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url: button.data('route'),
	        data: {
	          '_method': 'delete'
	        },
	        success: function (response, textStatus, xhr) {
	        	Swal.fire(
			      'Deleted!',
			      'Your file has been deleted.',
			      'success'
			    ).then((result) =>{
			    	window.location='/admin/blogs'
			    })
	        }
	      });
	    }
	  });
	  
	});
});