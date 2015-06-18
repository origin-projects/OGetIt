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
namespace OGetIt\CombatReport\Helper;

use OGetIt\Common\OGetIt_Value;
use OGetIt\Common\OGetIt_Resources;

trait OGetIt_Combat_ChildValue {
	
	/**
	 * @param OGetIt_Value[] $children
	 * @param string $byLosses
	 * @return OGetIt_Resources
	 */
	protected function getChildrenValue($children, $byLosses = false) {
		
		$value = new OGetIt_Resources(0, 0, 0);
		
		foreach ($children as $child) {
			$value->add($child->getValue($byLosses));
		}
		
		return $value;
		
	}
	
}