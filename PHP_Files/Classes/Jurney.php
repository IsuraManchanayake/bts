<?php
/**
 * Created by PhpStorm.
 * User: Isham
 * Date: 12/15/2016
 * Time: 4:57 PM
 */

namespace Busses;


class Jurney
{
    public $BusJourneyID=null;
    public $RegNumber;
    public $RouteID="Not Assigned";
    public $FromTown=null;
    public $FromTownName="Not Assigned";
    public $ToTown=null;
    public $ToTownName="Not Assigned";
    public $Duration="Not Assigned";
    public $valid=1;
    public $Schedules=array();
}