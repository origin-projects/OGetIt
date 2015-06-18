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
namespace OGetIt;

use OGetIt\Http\OGetIt_HttpRequest;
use OGetIt\Exception\OGetIt_API_Exception;

class OGetIt_Api { 
	
	/**
	 * @var string
	 */
	const TYPE_COMBATREPORT = 'combat/report';

	/**
	 * @param integer $error
	 * @throws OGetIt_Exception
	 */
	private static function processError($error) {
	
		throw new OGetIt_API_Exception($error);
	
	}
	
	/**
	 * @param string $url
	 * @return mixed|boolean
	 * @throws OGetIt_Exception
	 */
	public static function getData($url, $username = false, $password = false) {
		
		$request = new OGetIt_HttpRequest($url);
		
		if ($username !== false && $password !== false) {
			$request->useAuthentication($username, $password);
		}
		
		$reponse = $request->send(true);
		
		
		if ($reponse !== false) {
		
			$reponseData = json_decode($reponse, true);
			
			if ($reponseData['RESULT_CODE'] === 1000) {
				return $reponseData['RESULT_DATA'];
			} else {
				self::processError($reponseData['RESULT_CODE']);
			}
			
		}
		
		return false;
		
	}
	
	/**
	 * @param string $path
	 * @param array $query
	 * @return string
	 */
	public static function constructUrl($path, OGetIt $ogetit, array $get = array()) {
				
		$url = "//s{$ogetit->getUniverseID()}-{$ogetit->getCommunity()}.ogame.gameforge.com/api/{$ogetit->getApiVersion()}/$path";
		
		if (!empty($get)) {
			$url .= '?' . http_build_query($get);
		}
		
		return ($ogetit->usesHttps() ? "https:" : "http:") . $url;
		
	}
	
}