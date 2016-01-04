<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faker extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user');
    }

	public function index()
	{
		require_once '../vendor/fzaninotto/faker/src/autoload.php';

		$faker = Faker\Factory::create();
		$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

		$this->db->truncate('users'); 

		foreach (range(1, 100) as $number) {
			$data = [
				'name'     => $faker->name,
				'email'    => $faker->email,
				'password' => md5($faker->randomDigit()),
				'role'     => $faker->randomElement(array('admin', 'user'))
			];
			
			$this->user->cadastrar($data);
		}
	}
}	