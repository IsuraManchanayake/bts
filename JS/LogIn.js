/**
 * Created by acer on 11/12/2016.
 */
function submitData(){
    if($('#name').val().length==0 || $('#password').val.length==0){
        alert('You must first fill data');
        return false;
    }
    return true;
}