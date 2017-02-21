<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/12/2016
 * Time: 11:50 AM
 */
$buses=get_buses();
foreach ($buses as $bus){
    $journey=add_jurney($bus)->journey;
    if($journey==null){

    }
    $count="0";
    $rs="0.00";
    $incom=get_total_income($bus->RegNumber);
//    if($income=get_total_income($bus->RegNumber)!=null){
    if($income["countt"]!=0) {
        $count=$income["countt"];
    }
    if($income["countt"]!=null){
        $rs=$income["summ"];

    }

      //select count(payment) as countt,SUM(payment) as summ from booking where ScheduleID in
    //(SELECT ScheduleID from schedule where BusJourneyID in
    //(SELECT BusJourneyID from busjourney where RegNumber='NW-0001'));
//    }


    echo "<div class=\"\"><div class=\"panel panel-success center\">
        <div class=\"panel-heading \">
            <div class=\"container-fluid\">
                <p><h2 class=\"\">{$bus->RegNumber}<span class=\"text-muted\"></span></h2></p>
            </div>
            <div class=\"container-fluid\"><span class=\"text-muted\">Active</span></div>
        </div>
        <div class=\"panel-body \">
            <div class=\"container-fluid\">
                <div class=\"row\">
                    <div class=\"col-sm-5\">
                        <img src=\"../Image/b4.jpg\" class=\"img-resize img-rounded img-bus\">
                    </div>
                    <div class=\"col-sm-7\">
                        <form action=\"more.php?Num={$bus->RegNumber}\" class=\"form-horizontal\" method=\"post\" >
                            <div class=\"form-group\">
                                <strong><span class=\"text-info\">Contact NO :</span></strong> <span class=\"text-muted\">{$bus->PhoneNumber}</span>
                            </div>
                            <div class=\"form-group\">
                                <strong><span class=\"text-info\">Route :</span></strong> <span class=\"text-muted\">{$journey->FromTownName}- {$journey->ToTownName}</span>
                            </div>
                            <div class=\"form-group\">
                                <strong><span class=\"text-info\">Route NO :</span></strong> <span class=\"text-muted\">{$journey->RouteID}</span>
                            </div>
                            <div class=\"form-group\">
                                <strong><span class=\"text-info\">Total bookings :</span></strong> <span class=\"text-muted\">{$count}</span>
                            </div>
                            <div class=\"form-group\">
                                <strong><span class=\"text-info\">Total income :</span></strong> <span class=\"text-muted\">{$rs}</span>
                            </div>
                            <P class=\"hidden\" name=\"RegNumber\" id=\"#RegNumber\">{}</P>
                            </form>
                        <a href='more.php?Num={$bus->RegNumber}' class=\"btn btn-info pull-right\" name=\"more\" value=\"{$bus->RegNumber}\">More</a>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class=\"panel-footer panel-success\"></div>
    </div>
</div>
";
}
?>
<!--<button class="btn btn-danger pull-right">Suspend</button>-->

