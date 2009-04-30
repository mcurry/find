<?php
/*
 * App Model custom find types
 * Copyright (c) 2008 Matt Curry
 * www.PseudoCoder.com
 * http://github.com/mcurry/cakephp/tree/master/snippets/app_model_find
 * http://www.pseudocoder.com/archives/2008/10/24/cakephp-custom-find-queriescakephp-custom-find-queries/
 *
 * @author      Matt Curry <matt@pseudocoder.com>
 * @license     MIT
 *
 */
 
class FindAppModel extends Model {
  function find($type, $options = array()) {
    $method = null;
    if(is_string($type)) {
      $method = sprintf('__find%s', Inflector::camelize($type));
    }
    if($method && method_exists($this, $method)) {
      return $this->{$method}($options);
    } else {
      $args = func_get_args();
      return call_user_func_array(array('parent', 'find'), $args);
    }
  }
}
?>