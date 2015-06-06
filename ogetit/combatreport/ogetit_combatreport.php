<?php

namespace OGetIt\CombatReport;

use OGetIt\Common\OGetIt_Planet;
use OGetIt\Common\OGetIt_Player;
use OGetIt\Common\OGetIt_Fleet;
use OGetIt\Technology\OGetIt_Technology_Factory;

class OGetIt_CombatReport {
	
	const 	WINNER_ATTACKER = 'attacker',
			WINNER_DEFENDER = 'defender',
			WINNER_DRAW = 'draw';
	
	/**
	 * @var string
	 */
	private $_id;
	
	/**
	 * @var OGetIt_Planet
	 */
	private $_planet;
	
	/**
	 * @var integer
	 */
	private $_loot_percentage;
	
	/**
	 * @var string
	 */
	private $_winner;
	
	/**
	 * @var OGetIt_CombatParty
	 */
	private $_attacker_party;

	/**
	 * @var OGetIt_CombatParty
	 */
	private $_defender_party;
	
	/**
	 * @param string $api_data
	 * @return OGetIt_CombatReport
	 */
	public static function createCombatReport($api_data) {
				
		$generic = $api_data['generic'];
		
		$combatreport = new self(
			$generic['cr_id'], 
			$generic['combat_coordinates'], 
			$generic['combat_planet_type'],
			$generic['loot_percentage'],
			$generic['winner'],
			$generic['units_lost_attackers'],
			$generic['attacker_count'],
			$generic['units_lost_defenders'],
			$generic['defender_count']
		);

		$attackers = $api_data['attackers'];
		
		$combatreport->loadAttackers($attackers);
		
		$defenders = $api_data['defenders'];
		
		$combatreport->loadDefenders($defenders);
		
		return $combatreport;
		
	}
	
	/**
	 * @param string $id
	 * @param string $coordinates
	 * @param integer $planet_type
	 * @param integer $loot_percentage
	 * @param string $winner
	 * @param integer $attacker_losses
	 * @param integer $attacker_count
	 * @param integer $defender_losses
	 * @param integer $defender_count
	 */
	public function __construct($id, $coordinates, $planet_type, $loot_percentage, $winner, $attacker_losses, $attacker_count, $defender_losses, $defender_count) {
		
		$this->_id = $id;
		$this->_loot_percentage = $loot_percentage;
		$this->_winner = $winner;
		$this->_planet = new OGetIt_Planet($planet_type, $coordinates);
		
		$this->_attacker_party = new OGetIt_CombatParty($attacker_count, $attacker_losses);
		$this->_defender_party = new OGetIt_CombatParty($defender_count, $defender_losses);
		
	}
	
	/**
	 * @param array $attackers
	 */
	private function loadAttackers($attackers) {
		
		$players = $this->loadParty($attackers);
		
		$this->_attacker_party->setPlayers($players);
		
	}
	
	/**
	 * @param array $defenders
	 */
	private function loadDefenders($defenders) {
		
		$players = $this->loadParty($defenders);
		
		$this->_defender_party->setPlayers($players);
		
	}
	
	/**
	 * @param array $players
	 */
	private function loadParty($rawPlayers) {
		
		$players = array();
		
		foreach ($rawPlayers as $fleetData) {
			
			$rawPlayer = $fleetData['fleet_owner'];
			
			//Check if player already exists, if not create it & add it
			if (!isset($players[$rawPlayer])) {
				$players[$rawPlayer] = new OGetIt_Player($rawPlayer);
				$players[$rawPlayer]->setCombatTechnologies(
					$fleetData['fleet_armor_percentage'], 
					$fleetData['fleet_shield_percentage'], 
					$fleetData['fleet_weapon_percentage']
				);
			}
			
			$player = $players[$rawPlayer];
			$planet = new OGetIt_Planet(
				$fleetData['fleet_owner_planet_type'], 
				$fleetData['fleet_owner_coordinates'], 
				$fleetData['fleet_owner_planet_name']
			);
			$fleet = new OGetIt_Fleet($planet);
			
			foreach ($fleetData['fleet_composition'] as $rawTechnology) {
				
				$technology = OGetIt_Technology_Factory::create($rawTechnology['ship_type']);
				
				$fleet->addTechnology($technology, $rawTechnology['count']);
				
			}
			
			$player->addFleet($fleet);
			
		}
		
		return array_values($players);
		
	}
	
}