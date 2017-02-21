<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/18/2016
 * Time: 11:24 AM
 */
require_once '../include/connect.php';
require_once '../Modal/PhpClasses1.php';
class AdminDao
{
    public function updatePassword($conn, $name, $password)
    {
        $sql = "UPDATE Admin SET Password=(select password(?)) WHERE name=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('ss', $password, $name);
        $stmt->execute();
    }

    public function updateUserName($conn, $user1, $user2)
    {
        $sql = "UPDATE Admin SET name=? WHERE name=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('ss', $user1, $user2);
        $stmt->execute();
    }

    public function getAdminData($conn, $userName)
    {
        $sql = "select AdminID,name,Password from Admin where name=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_Param('s', $userName);
        $stmt->execute();

        $result = $stmt->get_result();
        $admin = null;
        while ($row = $result->fetch_assoc()) {
            $admin = new Admin($row['AdminID'], $row['Name'], $row['Password']);
        }

        $stmt->free_result();
        return $admin;

    }
}
?>