<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Error extends BaseController
{
	public function index()
	{
		$data = [
			'title'         => '404'
		];
		return view('errors/vw_error', $data);
	}
}
