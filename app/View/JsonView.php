<?php

/**
 * Copyright 2008 Torrenegra IP, LLC.
 *
 * Licensed under the Merrcury License, Version 2.0 (the "License").
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
**/

class JsonView extends View {
	public $content = null;
	protected $type = 'json';
	
	function __construct(&$controller, $register = true) {
		parent::__construct($controller);
		if (is_object($controller) && isset($controller->viewVars[$this->type])) {
			$this->content = $controller->viewVars[$this->type];
		}
	}	

	function render($action = null, $layout = null, $file = null) {
		if ($this->content === null) {
			$data = '';
		} elseif (isset($_GET['jsonp_callback'])) {
            $callback = $_GET['jsonp_callback'];
            $data = $callback . '(' . json_encode($this->content) . ');';
		} else {
			$data = json_encode($this->content);
		}
		return $data;
	}
}