<?

class PostsController extends AppController {

	public $components = array('Paginator', 'RequestHandler');

	public $helpers = array('Html', 'Form', 'Text');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		if ($this->RequestHandler->isRss()) {
			$posts = $this->Post->find('all', array(
				'conditions' => array('Post.published' => '1'),
				'limit' => 20,
				'order' => 'Post.publish_date DESC'
			));
			return $this->set(compact('posts'));
		}
		$limit = '10';
		if($this->Session->read('Auth.User')) {
			if($this->Session->read('Auth.User.role') == "admin" || $this->Session->read('Auth.User.role') == "editor") {
				$this->paginate = array(
					'limit' => $limit,
					'order' => 'Post.publish_date DESC'
				);
			} elseif($this->Session->read('Auth.User.role') == "author") {
				$this->paginate = array(
					'conditions' => array(
						array(
							'or' => array(
								'Post.published' => '1',
								'Post.author_id' => $this->Session->read('Auth.User.id')
							)
						)
					),
					'limit' => $limit,
					'order' => array('Post.publish_date' => 'DESC')
				);
			} else {
				$this->paginate = array(
					'conditions' => array('Post.published' => '1'),
					'limit' => $limit,
					'order' => array('Post.publish_date' => 'DESC')
				);
			}
		} else {
			$this->paginate = array(
				'conditions' => array('Post.published' => '1'),
				'limit' => $limit,
				'order' => array('Post.publish_date' => 'DESC')
			);
		}
		$this->set('posts', $this->paginate('Post'));
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $slug
	 * @return void
	 */
	public function view($slug=null) {
		if (is_null($slug)) {
			throw new NotFoundException(__('Not Found'));
		} else {
			$this->Post->updateAll(array('Post.views'=>'Post.views+1'), array('Post.slug'=>$slug));
			$post = $this->Post->find('first', array('conditions'=>array('Post.slug'=>$slug)));
			if (!$post) {
				throw new NotFoundException(__('Not Found'));
			} else {
				if($this->Session->read('Auth.User')) {
					if($this->Session->read('Auth.User.role') == "admin" || $this->Session->read('Auth.User.role') == "editor") {
						$this->set('title_for_layout', $post['Post']['title']);
						$this->set(compact('post'));
					} else {
						if($post['Post']['published'] != "0") {
							$this->set('title_for_layout', $post['Post']['title']);
							$this->set(compact('post'));
						} else {
							throw new NotFoundException(__('Not Found'));
						}
					}
				} else {
					if($post['Post']['published'] == "0") {
						throw new NotFoundException(__('Not Found'));
					} elseif($post['Post']['published'] == "1") {
						$this->set('title_for_layout', $post['Post']['title']);
						$this->set(compact('post'));
					}
				}
			}
		}
	}

	/**
	 * search method
	 *
	 * @return void
	 */
	public function search() {
		$limit = '10';
		$this->paginate = array(
			'conditions' => array(
				array(
					'or' => array(
						'Post.title LIKE' => '%'.$this->request->query['q'].'%',
						'Post.lead LIKE' => '%'.$this->request->query['q'].'%',
						'Post.body LIKE' => '%'.$this->request->query['q'].'%'
					),
					'Post.published' => '1'
				)
			),
			'limit' => $limit
		);
		$posts = $this->paginate('Post');
		$this->set('title_for_layout', "Search Results");
		$this->set(compact('posts'));
	}

	/**
	 * add method
	 *
	 * @todo add related info that every post will need to get started, i.e. global template
	 *
	 * @return void
	 */
	public function add() {
		if($this->Session->read('Auth.User')) {
			if ($this->request->is('post')) {
				if ($post = $this->Post->save($this->request->data)) {
					$this->Session->setFlash(__('The post has been saved.'), 'flash/success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'error');
				}
			}
			$this->set('posts', $this->Post->find('all'));
		} else {
			throw new NotFoundException(__('Not Found'));
		}
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $slug
	 * @return void
	 */
	public function edit($slug = null) {
		if($this->Session->read('Auth.User')) {
			if (is_null($slug)) {
				throw new NotFoundException(__('Page not found.'));
			}
			$post = $this->Post->findBySlug($slug);
			$this->Post->id = $post['Post']['id'];
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Post->save($this->request->data)) {
					$this->Session->setFlash(__('The post has been saved.'), 'flash/success');
					$this->redirect(array('action' => 'view', $slug));
				} else {
					$this->Session->setFlash(__('The post could not be saved. Please, try again.'), 'error');
				}
			}
			$this->request->data = $this->Post->findBySlug($slug);
			$this->set('post_id', $this->Post->id);
		} else {
			throw new NotFoundException(__('Not Found'));
		}
	}

	/**
	 * delete method
	 *
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($slug = null) {
		if($this->Session->read('Auth.User')) {
			if (!$this->request->is('post')) {
				throw new MethodNotAllowedException();
			}
			$post = $this->Post->findBySlug($slug);
			$this->Post->id = $post['Post']['id'];
			if (!$this->Post->exists()) {
				throw new NotFoundException(__('Invalid post'));
			}
			if ($this->Post->delete()) {
				$this->Session->setFlash(__('Post deleted.'), 'flash/success');
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Post was not deleted.'), 'error');
			$this->redirect(array('action' => 'index'));
		} else {
			throw new NotFoundException(__('Not Found'));
		}
	}
}