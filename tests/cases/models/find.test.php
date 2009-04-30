<?php
App::import('Model', 'Find.app_model');

class Post extends FindAppModel {
	var $name = 'Post';
  
  function __findLatest() {
    return $this->find('first', array('order' => 'created desc'));
  }
}

class FindTestCase extends CakeTestCase {
  var $Post = null;
  var $fixtures = array('plugin.find.post');

  function start() {
    parent::start();
    $this->Post = & ClassRegistry::init('Post');
  }

  function testPostInstance() {
    $this->assertTrue(is_a($this->Post, 'Post'));
  }
  
  function testFindNative() {
    $count = $this->Post->find('count');
    $this->assertEqual(3, $count);
  }
  
  function testFindLatest() {
    $latest = $this->Post->find('latest');
    $this->assertEqual(array('Post' => array('id' => 3,
                                           'title' => 'Third Post',
                                           'body' =>
                                           'Third Post Body',
                                           'created' => '2009-03-01 12:00:00',
                                           'updated' => '2007-03-18 12:00:00')),
                     $latest);
  }

}