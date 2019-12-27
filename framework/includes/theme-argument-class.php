<?php
/**
 * Theme arguments. Allows to pass variables to template when get_template_part is used
 * Usage:
 * $oArgs = ThemeArguments::getInstance('inc/post-info');
 * $oArgs -> set('title','Your title');
 * get_template_part('content');
 *
 * When in template:
 * $oArgs = ThemeArguments::getInstance('inc/post-info');
 * $title = $oArgs -> get('title');
 * $oArgs -> reset(); //it's a good practice to reset values after they are used
 */

final class ThemeArguments
{
    /**
     * Instance of the class TsArguments
     *
     * @var object
     * @access private
     */
    private static $oInstance = false;

  /**
     * Current context
     *
     * @var string
     * @access private
     */
    private $context = null;

  /**
     * Arguments array
     *
     * @var string
     * @access private
     */
    private $args = array();

    /**
     * Returns instance of the object TsArguments
     *
     * @return TsArguments
     * @access public
     * @static
     */
    public static function getInstance($context)
    {
        if( self::$oInstance == false )
        {
            self::$oInstance = new ThemeArguments();
        }
    self::$oInstance -> setContext($context);
        return self::$oInstance;
    }

   public function setContext($context) {
    $this -> context = $context;
   }

  /**
   * Set many arguments, accept an array array(argument_name => argument_value)
   * @param array $args
   * @return boolean
   */
  public function setMany($args) {
    if (is_array($args)) {
      $this -> args[$this -> context] = $args;
      return true;
    }
    return false;
  }

  /**
   * Set an argument
   * @param string $name
   * @param mix $value
   * @return boolean
   */
  public function set($name, $value) {
    if (!empty($name)) {
      $this -> args[$this -> context][$name] = $value;
      return true;
    }
    return false;
  }

  /**
   * Get an argument
   * @param string $name
   * @return mix
   */
  public function get($name) {
    if (isset($this -> args[$this -> context][$name])) {
      return $this -> args[$this -> context][$name];
    }
    return false;
  }

  /**
   * Reset current context arguments
   * @return boolean
   */
  public function reset() {
    $this -> args[$this -> context] = array();
    return true;
  }

    private function __construct() {}
}

