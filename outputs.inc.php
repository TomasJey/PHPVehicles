<?php 

class OutputArrays extends carImport {

	public function displayCars() {

		$maxspeed = 90;


		
		$unsorted = $this->importFromFile();
		
		
		echo '<div class="car_list_1"><h1>Mašinų sąrašas nesutvarkytas:</h1>';
		
		foreach($unsorted as $key=>$val) {
			echo '<div class="car_list">';
			echo '<h3>Numeris: <b>'.$val['plate'].'</b></h3>';
			echo 'Greičiai: <br><ul>';
			foreach($val['speeds'] as $skey => $sval) {
				echo '<li>'.$sval.' km/h</li>';
			}
			echo '</ul>';
			echo '</div>';
		}
		
		$sorted = $this->cleanUp();
		
		echo '</div><div class="car_list_2"><h1>Mašinų sąrašas sutvarkytas:</h1>';
		
		foreach($sorted as $key=>$val) {
			echo '<div class="car_list">';
			if($val['midspeed'] >= $maxspeed) {
				echo '<font color="red">';
			} else {
				echo '<font color="black">';
			}
			
			
			echo '<h3>Numeris: <b>'.$val['plate'].'</b> |  Vidutinis greitis: '.$val['midspeed'].'</h3></font>';
			
			
			
			echo 'Greičiai: <br><ul>';
			foreach($val['speeds'] as $skey => $sval) {
				echo '<li>'.$sval.' km/h</li>';
			}
			echo '</ul>';
			echo '</div>';
		}
		echo '</div>';
		return;
	}
}