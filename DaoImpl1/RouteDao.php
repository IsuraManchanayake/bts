<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 09:58 PM
 */
require_once '../include/connect.php';
require_once '../Modal/PhpClasses1.php';
class RouteDao
{
    public function getRoutesData($conn)
    {
        $sql = "select RouteID from Route order by RouteID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $Route = array();
        while ($row = $result->fetch_assoc()) {
            $Route[] = new Route($row['RouteID']);
        }
        $stmt->free_result();
        return $Route;
    }


    public function AddRoute($conn, $RouteID)
    {
        $sql = "INSERT INTO Route VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('i', $RouteID);
        $stmt->execute();


    }

    public function insertLocationToRoute($conn, $routeID, $name1, $distance)
    {
        $sql = "INSERT INTO RouteDestination(RouteID,TownID,Distance) select ?,l.TownID,? from location as l where l.TownName=?";
        $stmt = $conn->prepare($sql);

        $stmt->bind_Param('iis', $routeID, $distance, $name1);
        $stmt->execute();
    }

    public function deletelocationFromRoute($conn, $routeID, $name)
    {
        $sql = "DELETE FROM RouteDestination rd WHERE RouteID=? and TownID=(select TownID from Location where TownName=?)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam('is', $routeID, $name);
        $stmt->execute();

    }

    public function deleteRoute($conn, $routeID)
    {
        $sql = "DELETE FROM Route WHERE RouteID=?";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam('i', $routeID);
        $stmt->execute();

    }

}
?>