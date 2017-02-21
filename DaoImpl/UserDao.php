<?php

/**
 * Created by PhpStorm.
 * User: acer
 * Date: 20/12/2016
 * Time: 01:57 AM
 */
class UserDao
{
    public function getAllUserNames($conn){
        $sql="select userName from user";
        $result=mysqli_query($conn,$sql);
        $userNames=array();
        while ($row = $result->fetch_assoc()) {
            $userName=$row['userName'];
            array_push($userNames,$userName);
        }
        return $userNames;

    }

}