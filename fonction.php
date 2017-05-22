<?php


		function Pourcentage($Nombre, $Total) {
			$tmpPourcent = $Nombre * 100 / $Total;
			return round($tmpPourcent);
		}


		function humanTiming($time)
		{
			$time = time() - $time; // to get the time since that moment

			$tokens = array (
				31536000 => 'year',
				2592000 => 'month',
				604800 => 'week',
				86400 => 'day',
				3600 => 'hour',
				60 => 'min',
				1 => 'sec'
			);

			$result = '';
			$counter = 1;
			foreach ($tokens as $unit => $text) {
				if ($time < $unit) continue;
				if ($counter > 2) break;

				$numberOfUnits = floor($time / $unit);
				$result .= "$numberOfUnits $text ";
				$time -= $numberOfUnits * $unit;
				++$counter;
			}

			return "{$result}";
		}
		
		function fEspace($matches)
		{
		 $value = str_replace(' ', '_', $matches[0]);
				return $value;	
		}
		
		function fTblHostdown($nbrcol)
		{
			global $livestatus;
			$tmp_TblHostdown = shell_exec('echo "GET hosts\nColumns: host_name state last_check last_time_up address\nFilter: state = 1\nFilter: acknowledged = 0\nSeparators: 59 59\n" | unixcat '.$livestatus);
			$Tbl_HostDown = explode(";", $tmp_TblHostdown);
			$Nbr_TblHostDown=count($Tbl_HostDown);
			$Nbr_TblHostDown--;
			echo '<div class="col-md-'.$nbrcol.'">';
			echo '<div class="box box-solid box-info" >';
            echo '<div class="box-header">';
            echo '  <h3 class="box-title">Hôtes down</h3>';
            echo '</div>';
            echo '<div class="box-body table-responsive no-padding">';
            echo '  <table class="table table-hover">';
			echo '	<tr>';
            echo '      <th>Last Check</th>';
            echo '      <th>Host</th>';
			echo '	  <th>Address</th>';
            echo '      <th>State</th>';
			echo '	  <th>Duration</th>';
			echo '     </tr>';
								for($i=0;$i<$Nbr_TblHostDown;$i=$i+5)
									{
										echo '<tr>';
											$LastCheck_TblHostDown=humanTiming($Tbl_HostDown[$i+2]);
											$LastTimeOk_TblHostDown=humanTiming($Tbl_HostDown[$i+3]);
											echo '<td>'.$LastCheck_TblHostDown.'</td>';
											echo '<td> <a href="host_status.php?host='.$Tbl_HostDown[$i].'">'.$Tbl_HostDown[$i].'</a></td>';
											echo '<td>'.$Tbl_HostDown[$i+4].'</td>';											
											echo '<td>';
											if ($Tbl_HostDown[$i+1] == 2) :
												echo '<span class="label label-warning">Warning</span>';
											elseif($Tbl_HostDown[$i+1] == 1) :
												echo '<span class="label label-danger">Down</span>';
											else :
												echo '<span class="label label-warning">Ack</span>';
											endif;
											echo '</td>';
											echo '<td>'.$LastTimeOk_TblHostDown.'</td>';
										echo '</tr>';
									} 

            echo ' </table>';
			echo ' </div>';
			echo '</div>';
			echo '</div>';
	
		}
		
		
		
		
		
?>