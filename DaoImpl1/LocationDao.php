<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/18/2016
 * Time: 12:04 PM
 */
require_once '../include/connect.php';
require_once '../Modal/PhpClasses1.php';
class LocationDao
{
    public function insertLocation($conn, $TownID, $name, $GMAPLink, $Position)
    {

        $sql = "INSERT INTO Location VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->bind_Param('isss', $TownID, $name, $GMAPLink, $Position);
        $stmt->execute();
        if (mysqli_error($conn) != null) {
            throw new Exception('My SQl Error');
        };
    }

    public function selectNextTownID($conn)
    {

        $sql = "select TownID from Location order by TownID DESC limit 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $index = (int)$row['TownID']+1;
        }
        return $index;
    }


    public function getLocationsData($conn)
    {
        $sql = "select TownID,TownName,GMAPLink,Position from Location order by TownName";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $Locations = array();
        while ($row = $result->fetch_assoc()) {
            $Locations[] = new Location($row['TownID'], $row['TownName'], $row['GMAPLink'], $row['Position']);
        }

        $stmt->free_result();
        return $Locations;
    }

    public function getLocationsDatabylink($conn, $link)
    {
        $sql = "select TownID,TownName,GMAPLink,Position from Location where GMAPLink=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $link);
        $stmt->execute();
        if (mysqli_errno($conn) != null) {
            die("database Error");

        }
        $result = $stmt->get_result();
        $Location = null;
        while ($row = $result->fetch_assoc()) {
            $Location = new Location($row['TownID'], $row['TownName'], $row['GMAPLink'], $row['Position']);
        }

        $stmt->free_result();
        return $Location;
    }

    public function getLocationDataOnRoute($conn, $RouteID)
    {
        $sql = "select l.TownName,rd.Distance from Location l,RouteDestination rd where rd.RouteID=? and l.TownID=rd.TownID order by Distance";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('i', $RouteID);
        $stmt->execute();

        $result = $stmt->get_result();
        $Locations = array();
        while ($row = $result->fetch_assoc()) {
            $Locations[] = array($row['TownName'], $row['Distance']);//check the functionality of two tabled
        }

        $stmt->free_result();
        //$route=new Route($RouteID,$Locations);
        return $Locations;
    }

    public function getLocationDataNotOnRoute($conn, $RouteID)
    {
        $sql = "select TownName from Location where TownID not in(select TownID from RouteDestination where RouteID=?) order by TownName";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('i', $RouteID);
        $stmt->execute();

        $result = $stmt->get_result();
        $Locations = array();
        while ($row = $result->fetch_assoc()) {
            $Locations[] = new Location($row['TownName']);
        }

        $stmt->free_result();
        return $Locations;
    }

    public function modifyLocationName($conn, $name, $name1)
    {
        $sql = "UPDATE Location SET TownName=? WHERE TownName=?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('ss', $name, $name1);
        $stmt->execute();
    }

    function modifyLocationGMAPLink($conn, $GMAP, $name)
    {
        $sql = "UPDATE Location SET GMAPLink=:GMAP WHERE TownName=:name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':GMAP', $GMAP);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
    }

    public function lockLocationTable($conn)
    {
        $sql = "LOCK table Location write";
        mysqli_query($conn, $sql);
    }

    public function unlockLocationTable($conn)
    {
        $sql = "UNLOCK tables";
        mysqli_query($conn, $sql);
    }
}
?>