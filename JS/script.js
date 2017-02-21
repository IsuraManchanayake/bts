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
    if(check(pass) && check(name)){

        return false;
    }
    else if (check(pass)){
        return false;
    }
    else if(check(name)){
        return false;
    }


}
function check(elmnt){
    //alert("fuck!");
    if(elmnt.value==''){
        elmnt.className+=" alert-danger";
        //from.onsubmit = "return false"
        return true;

    }
    return false;

}
function city1_selected() {
    $cID=document.getElementById("city1");
    $val=$cID.selectedIndex;
    hide($cID[$val].id,"city2");
}
function city2_selected() {
    $cID=document.getElementById("city2");
    $val=$cID.selectedIndex;
    hide($cID[$val].id,"city1");
}
function hide($id,$city){
    $cID=document.getElementById($city);
    $nums=$cID.childElementCount;
    for ($i=1;$i<$nums;++$i){
        $cID[$i].className="";
        if($cID[$i].id==$id){
            $cID[$i].className+=" hidden";
            if($cID[$i].selected==true){
                $cID[0].selected=true;
                if($i==1){
                    $cID[0].selected=true;
                }
            }

        }
    }

}

function formValidate(){
        alert("script validation");
        normalize(document.getElementById("reg-num"));
        normalize(document.getElementById("pass1"));
        normalize(document.getElementById("pass2"));
        normalize(document.getElementById("types"));
        normalize(document.getElementById("seats"));
        normalize(document.getElementById("city2"));
        normalize(document.getElementById("city1"));
        normalize(document.getElementById("route"));
        normalize(document.getElementById("Time"));
        var reg_num=check(document.getElementById("reg-num"));
        var pass1=check(document.getElementById("pass1"));
        var pass2=check(document.getElementById("pass2"));
        var Time=check(document.getElementById("Time"));
        var types=checkSelect(document.getElementById("types"));
        var seats=checkSelect(document.getElementById("seats"));
        var city2=checkSelect(document.getElementById("city2"));
        var city1=checkSelect(document.getElementById("city1"));
        var route=checkSelect(document.getElementById("route"));


        if(reg_num || pass1 || pass2 || types || seats || city1 || city2 || route || Time || check_passwor()){
            return false;
        }


    }
function check(elmnt){
    if(elmnt.value.toString()==''){
        elmnt.className+=" alert-danger";
        return true;
    }
    return false;
}
function checkSelect(elmnt){
    if(elmnt.selectedIndex==0){
        elmnt.className+=" alert-danger";
        return true;
    }
    return false;
}
function normalize(elmnt) {
    elmnt.className="form-control"
}
function check_passwor() {
    var pa1=document.getElementById("pass1");
    var pa2=document.getElementById("pass2");
    if(pa2.value!=pa1.value){
        pa1.className+=" alert-danger";
        pa2.className+=" alert-danger";
        return true
    }
    return false;
}
