<?php

namespace EllisLab\ExpressionEngine\Service\Validation;

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
 * ExpressionEngine Validation Rule Interface
 *
 * Represents a Validation Rule that can be applied to a value during any
 * Validation stage.  This can be either form validation or validation of data
 * before it is committed to the database.  Will be loaded from a validation
 * string of the rule's name (first character lower case).
 *
 * For example, a rule to ensure that a required value is present might be
 * named "required".  It could be set in a validation string with other rules
 * such as "required|password".  The class definition would then look like
 * this::
 *
 * 	class Required extends ValidationRule {}
 *
 * @package		ExpressionEngine
 * @subpackage	Validation
 * @category	Service
 * @author		EllisLab Dev Team
 * @link		http://ellislab.com
 */
abstract class ValidationRule {

	protected $parameters = array();
	protected $parameter_names = array();

	/**
	 * Validate a Value
	 *
	 * Validate a value against this rule. If it is valid, return TRUE
	 * otherwise, return FALSE.
	 *
	 * @param  mixed   $value  The value to validate.
	 * @return boolean Success?
	 */
	abstract public function validate($value);


	/**
	 * Optional if you need access to other values
	 *
	 * Defaults to blank since we don't want to store
	 * all that information if we're not going to need it.
	 */
	public function setAllValues(array $values) { /* blank */ }
	/**
	 *
	 */
	public function setParameters(array $parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	 *
	 */
	public function assertParameters()
	{
		$names = func_get_args();

		$count_needed = count($names);
		$count_given = count($this->parameters);

		if ($count_needed > $count_given)
		{
			$this->throwNeedsParameters(array_slice($names, $count_given));
		}

		return $this->parameters;
	}

	public function stop()
	{
		return Validator::STOP;
	}

	public function skip()
	{
		return Validator::SKIP;
	}

	/**
	 *
	 */
	public function getName()
	{
		return strtolower(basename(str_replace('\\', '/', get_class($this))));
	}

	/**
	 *
	 */
	public function getParameters()
	{
		return $this->parameters;
	}

	/**
	 *
	 */
	protected function throwNeedsParameters($missing = array())
	{
		$rule_id = "the {$this->getName()} validation rule";

		if (count($missing) == 1)
		{
			throw new \Exception("Missing {$missing[0]} parameter for {$rule_id}.");
		}

		$last = array_shift($missing);
		$init = implode(', ', $missing);

		throw new \Exception("Missing {$init} and {$last} parameters for {$rule_id}.");
	}
}