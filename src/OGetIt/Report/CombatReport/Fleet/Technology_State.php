<?php
/*
 * Copyright © 2015 Klaas Van Parys
 * 
 * This file is part of OGetIt.
 * 
 * OGetIt is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * OGetIt is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public License
 * along with OGetIt.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace OGetIt\Report\CombatReport\Fleet;

use OGetIt\Technology\Technology;
use OGetIt\Technology\TechnologyCombat;
use OGetIt\Common\Resources;
use OGetIt\Common\Value;

class Technology_State implements Value {
	
	/**
	 * @var TechnologyCombat
	 */
	private $_technology;
	
	/**
	 * @var integer
	 */
	private $_count;
	
	/**
	 * @var integer|boolean
	 */
	private $_lost;	
	
	/**
	 * @param TechnologyCombat $technology
	 * @param integer $count
	 * @param integer $lost
	 */
	public function __construct($technology, $count, $lost=false) {
		
		$this->_technology = $technology;
		$this->_count = $count;
		$this->_lost = $lost;
		
	}

	/**
	 * @return Technology
	 */
	public function getTechnology() {
		
		return $this->_technology;
		
	}
	
	/**
	 * @return integer
	 */
	public function getCount() {
		
		return $this->_count;
		
	}
	
	/**
	 * @param integer $count
	 */
	public function addCount($count) {
		
		$this->_count += $count;
		
	}
	
	/**
	 * @return integer|boolean
	 */
	public function getLost() {
		
		return $this->_lost;
		
	}
	
	/**
	 * @param integer $lost
	 */
	public function addLost($lost) {
		
		$this->_lost += $lost;
		
	}
	
	/**
	 * @param boolean $byLosses
	 * @return Resources
	 */
	public function getValue($byLosses = false) {
		
		$count = $byLosses === true ? $this->_lost : $this->_count;
		
		return $this->_technology->getCosts($count);
		
	}
	
}