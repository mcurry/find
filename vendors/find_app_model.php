<?php
/*
 * App Model custom find types
 * Copyright (c) 2009 Matt Curry
 * www.PseudoCoder.com
 * http://github.com/mcurry/find
 *
 * Thanks to Daniel Salazar for the inspiration on pagination support
 * http://code621.com/content/10/easy-pagination-using-matt-curry-s-custom-find-types
 *
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
      $return = $this->{$method}($options);
      
      if($return === null && !empty($this->query['paginate'])) {
        unset($this->query['paginate']);
        $query = $this->query;
        $this->query = null;
        return $query;
      }
			
			return $return;
    } else {
      $args = func_get_args();
      return call_user_func_array(array('parent', 'find'), $args);
    }
  }
  
  function beforeFind($query) {
    if(!empty($query['paginate'])) {
      $keys = array('fields', 'order', 'limit', 'page');
      foreach($keys as $key) {
        if($query[$key] === null || (is_array($query[$key]) && $query[$key][0] === null) ) {
          unset($query[$key]);
        }
      }
      
      $this->query = $query;
      return false;
    }
    
    return true;
  }
}
?>