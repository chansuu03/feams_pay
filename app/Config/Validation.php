<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use App\Validation\UserRules;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var string[]
	 */
	public $ruleSets = [
		Rules::class,
		FormatRules::class,
		FileRules::class,
		CreditCardRules::class,
		UserRules::class,
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array<string, string>
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
	public $users = [
		'username' => [
			'label' => 'Username', 
			'rules' => 'required|min_length[5]|max_length[30]|is_unique[users.username]|alpha_numeric'
		],
		'password' => [
			'label' => 'Password', 
			'rules' => 'required|min_length[5]|max_length[30]'
		],
	];

	public $roles = [
		'role_name' => [
			'label' => 'Role Name', 
			'rules' => 'required|min_length[3]|max_length[30]|alpha_numeric_space',
			'errors' => [
				'required' => 'Role name is required',
				'min_length' => 'Role name too short',
				'max_length' => 'Role name exceeds max characters',
				'alpha_numeric_space' => 'Role name only accepts alphanumeric characters'
			],
		],
	];

	public $role_perm = [
		'role_id' => [
			'label' => 'Role', 
			'rules' => 'required',
			'errors' => [
				'required' => 'Role is required',
			],
		],
		'perm_id' => [
			'label' => 'Permissions', 
			'rules' => 'required',
			'errors' => [
				'required' => 'Permission is required',
			],
		],
	];

	public $announcements = [
		'title' => [
			'label' => 'Title', 
			'rules' => 'required|min_length[2]|max_length[999]',
			'errors' => [
				'required' => 'Title field is required',
				'min_length' => 'Title field too short',
				'max_length' => 'Title field reached max character length',
			]
		],
		'description' => [
			'label' => 'Description', 
			'rules' => 'required|min_length[2]|max_length[999]',
			'errors' => [
				'required' => 'Description field is required',
				'min_length' => 'Description field too short',
				'max_length' => 'Description field reached max character length',
			]
		],
		'image' => [
			'label' => 'Image', 
			'rules' => 'uploaded[image]|is_image[image]',
			'errors' => [
				'uploaded' => 'No image uploaded',
				'is_image' => 'Uploaded file is not an image',
			]
		],
	];

	public $sliders = [
		'title' => [
			'label' => 'Title', 
			'rules' => 'required|min_length[2]|max_length[999]',
			'errors' => [
				'required' => 'Title field is required',
				'min_length' => 'Title field too short',
				'max_length' => 'Title field reached max character length',
			]
		],
		'description' => [
			'label' => 'Description', 
			'rules' => 'required|min_length[2]|max_length[999]',
			'errors' => [
				'required' => 'Description field is required',
				'min_length' => 'Description field too short',
				'max_length' => 'Description field reached max character length',
			]
		],
		'image' => [
			'label' => 'Image', 
			'rules' => 'uploaded[image]|is_image[image]',
			'errors' => [
				'uploaded' => 'No image uploaded',
				'is_image' => 'Uploaded file is not an image',
			]
		],
	];
}
