/**
 * Created by Isham on 12/9/2016.
 */
$('.useredit').css({
     'min-height': $(window).height()-51

});

$('.main2').css({
    'min-height': $(window).height()-51
});

// $(document).load($(window).bind("resize", foo));


// $(window).resize(function () {
//     if ($(window).width() < 767) {
//         $('.useredit').css({
//             'height': 200
//
//         });}
// });
function foo(){
    if ($(window).width()<767){
        $('.useredit').css({
            'min-height': 250

        });
    }
    $('.useredit').css({
        'min-height': $(window).height()-51

    });

    $('.main2').css({
        'min-height': $(window).height()-51
    });


}


function  formvalidate() {
    var reg=document.getElementById("reg-num");
if(reg.value=='') {
    reg.className += " alert-danger";
    //from.onsubmit = "return false"
    return false;

}
}
function loginvalidate(){
    var name=document.getElementById("name");
    var pass=document.getElementById("pass");
    if(!(check(pass)&    check(name))){
        return false;
    }

}
function check(elmnt){
    if(elmnt.value==''){
        elmnt.className+=" alert-danger";
        //from.onsubmit = "return false"
        return false;

    }

}
