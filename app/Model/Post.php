<?

class Post extends AppModel {

	public function beforeSave($options = array()) {
		// set the url slug
		if (isset($this->data[$this->alias]['title'])) {
			$this->data[$this->alias]['slug'] = strtolower(Inflector::slug($this->data[$this->alias]['title'], $replacement='-'));
		}
		// set p tags around the lead text
		if (isset($this->data[$this->alias]['lead'])) {
			$this->data[$this->alias]['lead'] = str_replace('<p>', '<p class="lead">', $this->data[$this->alias]['lead']);
		}
		// if published is set to 1 and there is no publish_date, set the publish_date to now.
		if ($this->data[$this->alias]['published'] == "1" && $this->data[$this->alias]['publish_date'] === FALSE) {
			$this->data[$this->alias]['publish_date'] = date('Y-m-d H:i:s');
		}

		return true;
	}

	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A title is required'
			)
		),
		'body' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A body is required'
			)
		)
	);

}
