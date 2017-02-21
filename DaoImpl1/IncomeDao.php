<?php
/**
 * Created by PhpStorm.
 * User: acer v5
 * Date: 12/19/2016
 * Time: 11:05 AM
 */
require_once '../include/connect.php';
require_once '../Modal/PhpClasses1.php';
class IncomeDao
{
    public function getIncome($conn)
    {
        $sql = "select sum(payment)  from booking ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $Costs = array();
        while ($row = $result->fetch_assoc()) {
            $payment = $row['sum(payment)'];
        }
        $stmt->free_result();
        return $payment;
    }

    public function getIncomeByMonth($conn)
    {
        $sql = "select sum(b.payment)  from booking b,schedule sh where b.scheduleID=sh.scheduleID and sh.FromTime between ( UNIX_TIMESTAMP(NOW( ))-2592000) and  UNIX_TIMESTAMP(NOW( ))";//edit from this
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $payment = $row['sum(b.payment)'];
        }

        $stmt->free_result();
        return $payment;
    }
}