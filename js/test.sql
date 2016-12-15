
/*important queries */
select 
	id, regnumber, routeid, ftn, ttn, duration 
	from busjourney, 
		(
			select 
			id, townname as ftn, ttn 
			from location 
			right outer join 
				(
					select 
					busjourneyid as id, 
					fromtown, 
					townname as ttn 
					from busjourney 
					left outer join 
					location 
						on busjourney.totown = location.townid
				) as c 
			on  location.townid = c.fromtown
		) 
	as d 
	where d.id = busjourney.busjourneyid;

+------+-----------+---------+-------------+-------------+----------+
| id   | regnumber | routeid | ftn         | ttn         | duration |
+------+-----------+---------+-------------+-------------+----------+
| 4001 | NA-0001   |       6 | Pettah      | Kurunegala  | 03:00:00 |
| 4002 | NA-0001   |       6 | Pettah      | Polgahawela | 02:00:00 |
| 4003 | NA-0002   |       6 | Polgahawela | Kurunegala  | 01:00:00 |
| 4004 | NA-0002   |       6 | Warakapola  | Kurunegala  | 01:30:00 |
| 4005 | NA-0004   |     100 | Pettah      | Panadura    | 01:30:00 |
| 4007 | NA-0006   |     100 | Pettah      | Katubedda   | 01:00:00 |
| 4008 | NA-0007   |     100 | Pettah      | Wellawate   | 00:40:00 |
| 4010 | NA-0009   |     255 | Mt. Lavinia | Kottawa     | 01:30:00 |
| 4011 | NA-0009   |     255 | Kottawa     | Piliyandala | 00:45:00 |
+------+-----------+---------+-------------+-------------+----------+
