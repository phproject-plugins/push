<?php
/**
 * @package  Push
 * @author   Alan Hardman <alan@phpizza.com>
 * @version  0.0.1
 */

namespace Plugin\Push;

class Base extends \Plugin {

	protected $_socket;

	/**
	 * Get a socket connection instance to the push server
	 * @return resource
	 */
	protected function _getSocket() {
		$f3 = \Base::instance();
		$host = $f3->get("pushconfig.host");
		$port = $f3->get("pushconfig.port");
		if (!$this->_socket) {
			$this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			if($f3->get("pushconfig.enabled")) {
				$result = @socket_connect($this->_socket, $host, $port);
				$f3->set("push_socket_status", $result);
				if(!$result) {
					$err = socket_last_error();
					$str = socket_strerror($err);
					$log = new \Log("push.log");
					$log->write("Failed to create socket connection: [$err] $str");
					$f3->set("error", "An error occurred connecting to the push server.");
				}
			}
		}
		return $this->_socket;
	}

	/**
	 * Initialize the plugin
	 * @todo load configuration and initialize socket connection
	 */
	public function _load() {
		$f3 = \Base::instance();
		if (!is_file(__DIR__ . "/config.php")) {
			throw new Exception("Push plugin requires a config.php file!");
		}
		$config = require("config.php");
		$config = $config + array("host" => $f3->get("HOST"));
		$f3->set("pushconfig", $config);
	}

	/**
	 * Generate page for admin panel
	 */
	public function _admin() {
		$f3 = \Base::instance();
		$f3->set("pushsocket", $this->_getSocket());
		// Render view
		echo \Helper\View::instance()->render("push/view/admin.html");
	}

}
