<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2010 Arno Dudek <webmaster@adgrafik.at>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Model: Layer.
 * Nearly the same like the Google Maps API
 * @see http://code.google.com/apis/maps/documentation/javascript/reference.html
 *
 * @version $Id:$
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License, version 2
 * @scope prototype
 * @entity
 * @api
 */
abstract class Tx_AdGoogleMaps_Domain_Model_AbstractEntity extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var array
	 */
	protected static $typoScriptCache;

	/**
	 * Returns the setting value instead of property value if is set. 
	 *
	 * @param string $propertyName
	 * @param mixed $this
	 * @param array $settings
	 * @return mixed
	 */
	public function getPropertyValue($propertyName, $settingsKey) {
		// Load settings.
		if (self::$typoScriptCache === NULL) {
			$typoScriptCache = Tx_AdGoogleMaps_Utility_BackEnd::getTypoScriptSetup($this->getPid(), 'tx_adgooglemaps');
		}
		$settings = $typoScriptCache[$settingsKey];

		$currentValue = NULL;
		if (array_key_exists($propertyName, get_object_vars($this))) {
			$currentValue = $this->$propertyName;
		}
		
		// Get settings value only if set and current value is "false", "0" or empty.
		if (array_key_exists($propertyName, $settings) === TRUE && !$currentValue) {
			$currentValue = $settings[$propertyName];
		}

		return $currentValue;
	}

}

?>