<?php
	function tahun_semester($tahun,$bln){
			switch ($bln){
					case 01: 
						return (date("Y")-1)."1";
						break;
					case 02:
						return (date("Y")-1)."2";
						break;
					case 03:
						return (date("Y")-1)."2";
						break;
					case 04:
						return (date("Y")-1)."2";
						break;
					case 05:
						return (date("Y")-1)."2";
						break;
					case 06:
						return (date("Y")-1)."2";
						break;
					case 07:
						return (date("Y")-1)."2";
						break;
					case '08':
						return (date("Y")-1)."2";
						break;
					case '09':
						return (date("Y")-1)."1";
						break;
					case 10:
						return (date("Y")-1)."1";
						break;
					case 11:
						return (date("Y")-1)."1";
						break;
					case 12:
						return (date("Y")-1)."1";
						break;
				}	 
	}	


	//echo tahun_semester(2019,08);
?>