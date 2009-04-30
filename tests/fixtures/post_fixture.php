<?php

class PostFixture extends CakeTestFixture {
	var $name = 'Post';

	var $fields = array(
		'id' => array('type' => 'integer', 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false),
		'body' => 'text',
		'created' => 'datetime',
		'updated' => 'datetime'
	);

	var $records = array(
		array('id' => 1, 'title' => 'First Post', 'body' => 'First Post Body', 'created' => '2009-01-01 12:00:00', 'updated' => '2007-03-18 12:00:00'),
		array('id' => 2, 'title' => 'Second Post', 'body' => 'Second Post Body', 'created' => '2009-02-01 12:00:00', 'updated' => '2007-03-18 12:00:00'),
		array('id' => 3, 'title' => 'Third Post', 'body' => 'Third Post Body', 'created' => '2009-03-01 12:00:00', 'updated' => '2007-03-18 12:00:00')
	);
}
?>
