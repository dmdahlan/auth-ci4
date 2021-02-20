<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'login'      => \Myth\Auth\Filters\LoginFilter::class,
		'role'       => \Myth\Auth\Filters\RoleFilter::class,
		'permission' => \Myth\Auth\Filters\PermissionFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'honeypot',
			'login' => ['except' => [
				// '/', 'home/*',
				// 'home', 'home/*',
				'login', 'login/*',
				'register', 'register/*',
				'forgot', 'forgot/*',
				'reset-password', 'reset-password/*',
				'activate-account', 'activate-account/*',
				'resend-activate-account', 'resend-activate-account/*',
			]]
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			// 'login',
			'login' => ['except' => [
				'', 'home/*',
				'home', 'home/*',
				'error', 'error/*',
				'login', 'login/*',
				'register', 'register/*',
				'logout', 'logout/*',
				'forgot', 'forgot/*',
				'reset-password', 'reset-password/*',
				'activate-account', 'activate-account/*',
				'resend-activate-account', 'resend-activate-account/*',
			]]
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
