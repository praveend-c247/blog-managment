$(document).ready(function() {
    var authcheck = $('meta[name="auth-check"]').attr('content');
    console.log(authcheck);
    var lastScrollTop = 0;
    $(window).scroll(function(){
        if (authcheck == 'false'){
            CurrentUrl = window.location.pathname;
            LastSegment = window.location.pathname.split("/").pop();
            if (window.location.pathname == '/blog-detail/'+LastSegment) {
                var scrollPosCur = $(this).scrollTop();
                if(scrollPosCur > lastScrollTop) {
                    if (scrollPosCur > 400) {
                        Swal.fire({
                          text: "For more content and features, please log in to the system",
                          icon: "error"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                setTimeout( function() {
                                    window.location = '/login';
                                },500)
                            }
                        });
                    }
                }
                lastScrollTop = scrollPosCur;
            }
        }
    });
});