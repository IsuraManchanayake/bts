<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/13/2016
 * Time: 11:55 PM
 */

function redirect_to($url){
    header("Location: {$url}");
    exit;
}
function message($message){
    echo "<script type='text/javascript'>alert(\"{$message}\")</script>";
}
function getJourneyDuration($duration){
    $hour=floor($duration/3600);
    $min=floor(($duration%3600)/60);
    if($min==0){
        $min="";
    }else{
        $min=$min." Mins";
    }
    return "".$hour." Hours ".$min;
}

function getTimeFromStringTimeStamp($timeStamp){
    list($day,$time)=explode (' ',$timeStamp);
    list($hour,$min,$sec)=explode(':',$time);
    return getComputedTime($hour,$min);
}
function getComputedTime($hour,$min){

    $postFix='';
    if(intval($hour)>12 || (intval($hour)==12 && intval($min)!=0)){
        $postFix=" P.M";
        $hour=intval($hour)-12;
        if($hour==0){
            $hour=12;
        }
    }else{
        if($hour==0){
            $hour="00";
        }
        $postFix=" A.M";
    }
    return "".$hour.".".$min.$postFix;
}
function getCallculatedDuration($duration,$distance,$fromDistance,$toDistance){
    return getJourneyDuration($duration*(abs($fromDistance-$toDistance)/$distance));
}
function getJourneyTime($duration,$busFromDistance,$busToDistance,$journeyFromDistance,$journeyToDistance,$totalDistance,$fromInt){
    $journeyTime=array();
    echo "<br>";
    echo gettype($fromInt);
    echo $busFromDistance;
    if($journeyFromDistance<$journeyToDistance){
        $fromTime=getTime($duration*(abs($journeyFromDistance-$busFromDistance)/$totalDistance)+$fromInt);
        array_push($journeyTime,$fromTime);
        $toTime=getTime($duration*(abs($journeyToDistance-$busFromDistance)/$totalDistance)+$fromInt);
        array_push($journeyTime,$toTime);
    }elseif($journeyFromDistance>=$journeyToDistance){
        $fromTime=getTime($duration*(abs($busToDistance-$journeyFromDistance)/$totalDistance)+$fromInt);
        array_push($journeyTime,$fromTime);
        $toTime=getTime($duration*(abs($busToDistance-$journeyFromDistance)/$totalDistance)+$fromInt);
        array_push($journeyTime,$toTime);
    }
    return $journeyTime;
}
function getTime($time){
    $time=intval($time);
    return getTimeFromStringTimeStamp(date('Y-m-d h:i:s',$time));
}
function getDateFromTimeStamp($time){
    list($day,$t)=explode(' ',date('Y-m-d h:i:s',$time));
    return $day;
}
function getActualTime(){
    $time=time();
    return $time;
}
function getDayBefore(){
    $time=time()-3600*24;
    return $time;
}
?>