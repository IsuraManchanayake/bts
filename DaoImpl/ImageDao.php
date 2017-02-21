<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 15/12/2016
 * Time: 09:57 PM
 */
class ImageDao
{
    public function getImagesForBus($conn,$RegNumber){
        $sql="select ImagePath from Image where RegNumber=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $RegNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $Images=[];
        while ($row = $result->fetch_assoc()) {
            $Image=$row['ImagePath'];
            array_push($Images,$Image);
        }

        $stmt->free_result();
        return $Images;
    }
}