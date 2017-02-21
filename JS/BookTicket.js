/**
 * Created by acer on 06/12/2016.
 */
//var date = $('#datepicker').datepicker({ dateFormat: 'yyyy-mm-d' }).val();








var list = [];

var selectedSeats=[];
var copyOfAllSeats=availableSeats.slice();
var selectedSeatCount=0;
updateAvailableSeatList();
function updateAvailableSeatList() {
    $('#availableSeats')[0].options.length = 0;
    for (var i = 0; i < availableSeats.length; i++) {
        $("#availableSeats").append(new Option("" + availableSeats[i], "" + availableSeats[i]));
    }
    if (availableSeats.length == 0) {
        $("#availableSeats").append(new Option("No more available seats", "No more available seats"));
    }
}
function selectSeat() {

    var seatCount=parseInt($('#ticketCount').val());
    if (availableSeats.length !=0 && seatCount>selectedSeatCount) {
        var val = $('#availableSeats').val();
        $('#seatHolder').html($('#seatHolder').html() + "<button class='btn btn-info' style='margin: 2px;' type='button' onclick='removeSelectedSeat(this)' onsubmit='return false' value='"+val+"'>" + val + "</button>");
        var index = availableSeats.indexOf(parseInt(val));
        selectedSeats.push(val);
        availableSeats.splice(index, 1);
        updateAvailableSeatList();
        selectedSeatCount++;
        $('#selectedSeats').val(selectedSeats.toString());
    }
}
function removeSelectedSeat(item) {
    var val=item.value;
    console.log(val);
    availableSeats.push(parseInt(val));
    availableSeats.sort(sortNumber);
    updateAvailableSeatList();
    item.parentNode.removeChild(item);
    var index = selectedSeats.indexOf(parseInt(val));
    selectedSeatCount.splice(index, 1);
    selectedSeatCount--;
    $('#selectedSeats').val(selectedSeats.toString());
}
function sortNumber(a,b) {
    return a - b;
}

function ticketNoSelect(){
    $('#seatHolder').html('');
    availableSeats=copyOfAllSeats.slice();
    selectedSeatCount=0;
    updateAvailableSeatList();
    $('#ticketCountChildren')[0].options.length=0;
    var val=parseInt($('#ticketCount').val());
    for(var i=0;i<=val;i++){
        $("#ticketCountChildren").append(new Option("" + i, "" + i));
    }
    callcualatePayment();
}
function callcualatePayment(){
    console.log("sd"+$('#total'));
    var numSeat=parseInt($('#ticketCount').val());
    var children=parseInt($('#ticketCountChildren').val());
    numSeat-=children*0.5;
    var cost=parseFloat($('#cost').val())*parseFloat($('#distance').val());
    console.log(cost+" "+cost*numSeat);
    $('#total').html("Rs. "+(numSeat*cost).toFixed(2));
    $('#payment').val((numSeat*cost).toFixed(2));
    $('#selectedSeats').val(selectedSeats.toString());
}
function validateForm() {


    var nicE = document.getElementById("nic");
    var nameE = document.getElementById("name");
    var emailE = document.getElementById("email");
    var error = "";
    if (parseInt($('#ticketCount').val()) != selectedSeats.length) {
        error = 'You must select seat numbers fot the tickets\n';
    }

    var nic = $('#nic').val();
    var name = $('#name').val();

    if (nicE.value.toString() == '' || nic.length !== 9) {
        error += "You must enter a valid nic\n";
        nicE.className += " alert-danger";
    } else {
        nicE.className = " form-control";

    }
    if (nameE.value.toString() == "") {
        error += "Name must be entered and can not exceed length\n";
        nameE.className += " alert-danger";
    } else {
        nameE.className = "form-control";
    }
    if (emailE.value.toString() == "") {
        error += "Email must be entered\n";
        emailE.className += " alert-danger";
    } else {
        emailE.className = "form-control";
    }
    if (error != "") {
        alert(error);
        return false;
    }

    return true;

}

