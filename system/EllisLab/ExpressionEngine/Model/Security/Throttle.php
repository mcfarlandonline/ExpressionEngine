<?php
namespace EllisLab\ExpressionEngine\Model\Security;

use EllisLab\ExpressionEngine\Service\Model;

/**
 * ExpressionEngine - by EllisLab
 *
 * @package		ExpressionEngine
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2003 - 2014, EllisLab, Inc.
 * @license		http://ellislab.com/expressionengine/user-guide/license.html
 * @link		http://ellislab.com
 * @since		Version 3.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ExpressionEngine Throttle Model
 *
 * @package		ExpressionEngine
 * @subpackage	Security
 * @category	Model
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
class Throttle extends Model {
	// Meta data
	protected static $_primary_key = 'throttle_id';
	protected static $_gateway_names = array('ThrottleGateway');

	// Properties
	protected $throttle_id;
	protected $ip_address;
	protected $last_activity;
	protected $hits;
	protected $locked_out;

}
