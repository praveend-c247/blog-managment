$(document).ready(function() {
	$('.confirmation-form').on('click', function(e) {
	 	e.preventDefault();
	  	
	  	var urlType = '', title = '', url = '', type = '';
	  	var methodType = $(this).attr('data-methodType');
	  	console.log(methodType);
	  	if (methodType == 'restore') {
	  		title = 'Are you sure you want to Retrive this record?';
	  		url = $(this).data('url');
	  		type = 'GET';
	  		redirectUrl = '/admin/blogs-retrive';
	  	} else if (methodType == 'delete'){
	  		title = 'Are you sure you want to Delete this record?';
	  		url = $(this).data('url');
	  		type = 'DELETE';
	  		redirectUrl = '/admin/blogs';
	  	}
	  	Swal.fire({
	    	icon: 'warning',
	      	title: title,
	      	showDenyButton: false,
	      	showCancelButton: true,
	      	confirmButtonText: 'Yes'
	  	}).then((result) => {
	    	/* Read more about isConfirmed, isDenied below */
		    if (result.isConfirmed) {
		      $.ajax({
		        type: type,
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        },
		        url: url,
		        success: function (response, textStatus, xhr) {
		        	var res = JSON.parse(response);
		        	if (res.status == true) {
		        		toastr.success(res.msg);
		        		window.location = redirectUrl;
		        	}else{
		        		toastr.success(res.msg);
		        		window.location = redirectUrl;
		        	}
		        }
		      });
		    }
	  	});
	});
});