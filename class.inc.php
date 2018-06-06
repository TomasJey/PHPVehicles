<?php

class carImport {
	
	private $csvfile = "masinos.csv";
	
	public function importFromFile() {
		$carsar = array();
		$row = 1;
		
		if (($handle = fopen($this->csvfile, "r")) !== FALSE) {
			
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				$row++;
				for ($c=0; $c < $num; $c++) {
					$carsar[] = $data[$c];
				}
			}
			fclose($handle);
			
			$CarsArray = array();

			for($i = 0; $i < count($carsar); $i++) {
				$ranEl = explode( ';', $carsar[$i]);
				$CarsArray[] = array('nr' => $ranEl[0],
										'plate' => $ranEl[1]);
				$speedc = 1;
				for($c = 2; $c < count($ranEl); $c++) {
					if($CarsArray[$i]['plate'] == $ranEl[1]) {
						$CarsArray[$i]['speeds'][] = $ranEl[$c]; 
						$speedc++;
					}
				}
			} 
			return $CarsArray;
		}
	}
	
	public function sortArray($a, $b) {
		return strcmp($b["midspeed"], $a["midspeed"]);
	}
	
	public function cleanUp() {
		
		$finalArray = $this->importFromFile();
			
		$mids = $finalArray;
		foreach($finalArray as $key=>$val) {
			
			$midspeed = 0;
			$mids[$key]['plate'] = $val['plate']; 
				for($i = 0; $i < count($val['speeds']);$i++) {
					
					$midspeed = $midspeed + $val['speeds'][$i];
				}
				$mspeed = $midspeed / $i;
			$mids[$key]['midspeed'] = round($mspeed,2); 
		}
		
		usort($mids, function ($item1, $item2) {
			return $item2['midspeed'] <=> $item1['midspeed'];
		});
		
		return $mids;
	}
	
	
}