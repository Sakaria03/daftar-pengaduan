<?php

class Logout extends Controller {
	public function Index(){
		session_start();
		session_destroy();
		header('location: '. base_url . '/login');
	}
}