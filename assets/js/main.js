function changeHamburgerMenu(x) {
    x.classList.toggle("change");
}

let hamburger = document.querySelector('.hamburger')
let mobileOverlay = document.querySelector('.mobile-menu-overlay')
let bodyEl = document.querySelector('body')

hamburger.addEventListener('click', () => {
    mobileOverlay.classList.toggle('visible')
    bodyEl.classList.toggle('fixed-position')
})


$('#filter').change(function(){
    var filter = $('#filter');
    $.ajax({
        url:filter.attr('action'),
        data:filter.serialize(),
        type:filter.attr('method'),
        beforeSend:function(xhr){
            //filter.find('button').text('Processing...');
        },
        success:function(data){
            //filter.find('button').text('Filter');
            $('.archive-list-wrapper').html(data);
        }
    });
    return false;
});

var page = 1;

$("#more_posts").on("click", function(e) {

    $.ajax({
       // use the ajax object url
       url: ajaxurl,
       data: {
       action: "more_post_ajax", // add your action to the data object
       offset: page * 5 //  page # x your default posts per page
       },
       success: function(data) {
        // add the posts to the container and add to your page count
        page++;
        $('.archive-list-wrapper').append(data);

       },
       error: function(data) {
        // test to see what you get back on error
        console.log(data);
       }
    });

});