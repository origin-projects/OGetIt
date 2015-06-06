<?php
namespace OGetIt\Technology;

use OGetIt\Technology\Entity\t202_Small_Cargo;
use OGetIt\Technology\Entity\t203_Large_Cargo;
use OGetIt\Technology\Entity\t408_Large_Shield_Dome;
use OGetIt\Technology\Entity\t407_Small_Shield_Dome;
use OGetIt\Technology\Entity\t406_Plasma_Turret;
use OGetIt\Technology\Entity\t405_Ion_Cannon;
use OGetIt\Technology\Entity\t404_Gauss_Cannon;
use OGetIt\Technology\Entity\t403_Heavy_Laser;
use OGetIt\Technology\Entity\t402_Light_Laser;
use OGetIt\Technology\Entity\t401_Rocket_Launcher;
use OGetIt\Technology\Entity\t215_Battlecruiser;
use OGetIt\Technology\Entity\t214_Deathstar;
use OGetIt\Technology\Entity\t213_Destroyer;
use OGetIt\Technology\Entity\t212_Solar_Satellite;
use OGetIt\Technology\Entity\t211_Bomber;
use OGetIt\Technology\Entity\t210_Espionage_Probe;
use OGetIt\Technology\Entity\t209_Recycler;
use OGetIt\Technology\Entity\t208_Colony_Ship;
use OGetIt\Technology\Entity\t207_Battleship;
use OGetIt\Technology\Entity\t206_Cruiser;
use OGetIt\Technology\Entity\t205_Heavy_Fighter;
use OGetIt\Technology\Entity\t204_Light_Fighter;

class OGetIt_Technology_Factory {
	
	/**
	 * @param integer $type
	 * @return OGetIt_Technology
	 */
	public static function create($type) {
		
		$technology = null;
		
		switch ($type) {
			//Ships			
			case 202: $technology = new t202_Small_Cargo();
			case 203: $technology = new t203_Large_Cargo();
			case 204: $technology = new t204_Light_Fighter();
			case 205: $technology = new t205_Heavy_Fighter();
			case 206: $technology = new t206_Cruiser();
			case 207: $technology = new t207_Battleship();
			case 208: $technology = new t208_Colony_Ship();
			case 209: $technology = new t209_Recycler();
			case 210: $technology = new t210_Espionage_Probe();
			case 211: $technology = new t211_Bomber();
			case 212: $technology = new t212_Solar_Satellite();
			case 213: $technology = new t213_Destroyer();
			case 214: $technology = new t214_Deathstar();
			case 215: $technology = new t215_Battlecruiser();
			
			//Defence
			case 401: $technology = new t401_Rocket_Launcher();
			case 402: $technology = new t402_Light_Laser();
			case 403: $technology = new t403_Heavy_Laser();
			case 404: $technology = new t404_Gauss_Cannon();
			case 405: $technology = new t405_Ion_Cannon();
			case 406: $technology = new t406_Plasma_Turret();
			case 407: $technology = new t407_Small_Shield_Dome();
			case 408: $technology = new t408_Large_Shield_Dome();
			
			/*
			 * default: throws new OGetIt_Exception('test');
			 */
		}	
		
		return $technology;
		
	} 
	
}