$(document).ready(function() {
    var lastScrollTop = 0;
    $(window).scroll(function(){
        CurrentUrl = window.location.pathname;
        LastSegment = window.location.pathname.split("/").pop();
        if (window.location.pathname == '/blog-detail/'+LastSegment) {
            var scrollPosCur = $(this).scrollTop();
            if(scrollPosCur > lastScrollTop) {
                if (scrollPosCur > 400) {
                    console.log('down');
                    window.location = "/login";
                }
            }
            lastScrollTop = scrollPosCur;
        }
    });
});