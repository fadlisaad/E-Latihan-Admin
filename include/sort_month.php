<?php
				$month = date('F');
				
				switch ($month)
					{
					case ($month=='January'):
						$quarter = "<a href=\"senarai_jan.php\">Januari</a>";
						break;
					case ($month=='February'):
						$quarter = "<a href=\"senarai_feb.php\">Februari</a>";
						break;
					case ($month=='March'):
						$quarter = "<a href=\"senarai_mac.php\">Mac</a>";
						break;
					case ($month=='April'):
						$quarter = "<a href=\"senarai_april.php\">April</a>";
						break;
					case ($month=='May'):
						$quarter = "<a href=\"senarai_mei.php\">Mei</a>";
						break;
					case ($month=='June'):
						$quarter = "<a href=\"senarai_jun.php\">Jun</a>";
						break;
					case ($month=='July'):
						$quarter = "<a href=\"senarai_julai.php\">Julai</a>";
						break;
					case ($month=='August'):
						$quarter = "<a href=\"senarai_ogos.php\">Ogos</a>";
						break;
					case ($month=='September'):
						$quarter = "<a href=\"senarai_sept.php\">September</a>";
						break;
					case ($month=='October'):
						$quarter = "<a href=\"senarai_okt.php\">Oktober</a>";
						break;
					case ($month=='November'):
						$quarter = "<a href=\"senarai_nov.php\">November</a>";
						break;
					case ($month=='December'):
						$quarter = "<a href=\"senarai_dis.php\">Disember</a>";
						break;
					}
					echo 'Kursus sepanjang bulan '.$quarter;
				?>