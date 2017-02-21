
function checkNextSchedule(){

    if($('#nextScheduleID').val()!=$('#ScheduleID').val()){
        return true;
    }
    alert('No more Schedules for this bus');
    return false;
}
function checkBeforeSchedule(){
    if($('#beForeScheduleID').val()!=$('#ScheduleID').val()){
        return true;
    }
    alert('No more Schedules for this bus');
    return false;
}

function sort_table(tbody, col, asc)
{
    var rows = tbody.rows;
    var rlen = rows.length;
    var arr = new Array();
    var i, j, cells, clen;
    // fill the array with values from the table
    for(i = 0; i < rlen; i++)
    {
        cells = rows[i].cells;
        clen = cells.length;
        arr[i] = new Array();
        for(j = 0; j < clen; j++) { arr[i][j] = cells[j].innerHTML; }
    }
    // sort the array by the specified column number (col) and order (asc)
    arr.sort(function(a, b)
    {
        var retval=0;
        var fA=parseFloat(a[col]);
        var fB=parseFloat(b[col]);
        if(a[col] != b[col])
        {
            if((fA==a[col]) && (fB==b[col]) ){ retval=( fA > fB ) ? asc : -1*asc; } //numerical
            else { retval=(a[col] > b[col]) ? asc : -1*asc;}
        }
        return retval;
    });
    for(var rowidx=0;rowidx<rlen;rowidx++)
    {
        for(var colidx=0;colidx<arr[rowidx].length;colidx++){ tbody.rows[rowidx].cells[colidx].innerHTML=arr[rowidx][colidx]; }
    }
}
function sortOnDistance(){
    var body=document.getElementById('tableBody');
    var col=document.getElementById('tableDistance');
    sort_table(body,7,1);
}
function sortOnSeatNumber(){
    var body=document.getElementById('tableBody');
    var col=document.getElementById('tableDistance');
    sort_table(body,5,1);
}
function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
