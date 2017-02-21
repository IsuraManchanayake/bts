<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 16/12/2016
 * Time: 08:36 PM
 */
include_once '../Modal/PhpClasses.php';
class RouteLocationDao
{
    public function getRouteLocation($conn,$routeId,$fromTownID,$toTownID){
        $sql="select d.TownID,l.TownName,l.GMAPLink,d.Distance from routeDestination d,Location l where ((d.distance between (select distance from RouteDestination where RouteId=? and townID=?) and  (select distance from RouteDestination where RouteId=? and townID=?)) || (d.distance between (select distance from RouteDestination where RouteId=? and townID=?) and  (select distance from RouteDestination where RouteId=? and townID=?))) and routeId=? and d.TownID=l.TownID;";
        $stmt = $conn->prepare($sql);

        $stmt->bind_Param('sssssssss',$routeId, $fromTownID,$routeId,$toTownID,$routeId, $toTownID,$routeId,$fromTownID,$routeId);
        $stmt->execute();

        $result = $stmt->get_result();
        $route=new Route();
        $route->setRouteID($routeId);
        $locations=array();
        while ($row = $result->fetch_assoc()) {
            $location=new Location($row['TownID'],$row['TownName'],$row['GMAPLink'],$row['Distance']);
            array_push($locations,$location);
        }
        $route->setLocations($locations);
        $stmt->free_result();
        return $route;
    }

}