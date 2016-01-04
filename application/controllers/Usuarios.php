<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('user');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }

	public function index()
	{
        $data['users'] = $this->user->listar();

        //$config['base_url'] = 'http://code/usuarios/';
        $config["base_url"] =  base_url('usuarios');
        $config['total_rows'] = $this->user->count();
        $config['per_page'] = 20;
        $config["uri_segment"] = 3;
        //$config['num_links'] = 2;

        //$config['query_string_segment'] = 'page';
        //$config['prefix'] = '?';
        //$config['suffix'] = '?pages';        
        //$config['use_page_numbers'] = TRUE;
        //$config['page_query_string'] = TRUE;

        $choice = $config["total_rows"] / $config["per_page"];
        //$config["num_links"] = round($choice);


        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';
        $config['first_link'] = 'Primeira';
        //$config['first_tag_open'] = '<div>';
        //$config['first_tag_close'] = '</div>';
        $config['last_link'] = 'Ultima';
        //$config['last_tag_open'] = '<div>';
        //$config['last_tag_close'] = '</div>';
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        //$config['num_tag_open'] = '<div>';
        //$config['num_tag_close'] = '</div>';



//$config['use_global_url_suffix'] = FALSE;
//$config['attributes']['rel'] = FALSE;
//$config['suffix'] = '?content='.$page;
//$config['base_url'] = base_url().'usuarios/search/';


        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;        

        $data["results"] = $this->user->pagin($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();


		$this->load->view('header');
		$this->load->view('usuarios/index', $data);
		$this->load->view('footer');

        //echo $this->pagination->create_links();
	}

    function salvar() 
    {       
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        $this->form_validation->set_rules($validations);
        if ($this->form_validation->run() == FALSE) {
            //$this->index();
        } else {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
     
            //$this->load->model('pessoas_model');
            if ($this->user->cadastrar($data)) {
                //redirect('users');
            } else {
                //log_message('error', 'Erro no cadastro...');
            }
        }
    }

    function alterar() 
    {
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_error_delimiters('<span>', '</span>');
        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        /*$validations = array(
            array(
                'field' => 'nome',
                'label' => 'Nome',
                'rules' => 'required|min_length[4]|max_length[45]'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'trim|required|valid_email|max_length[45]'
            )
        );
        $this->form_validation->set_rules($validations);
        */

        if ($this->form_validation->run() == FALSE) {
            echo "porque?";
        } else {
            $data['id'] = $this->input->post('id');
            $data['nome'] = $this->input->post('nome');
            $data['email'] = $this->input->post('email');
     
            //$this->load->model('pessoas_model');
            if ($this->user->alterar($data)) {
                redirect('pessoas');
            } else {
                log_message('error', 'Erro na alteração...');
            }
        }
    }

    function editar($id)  
    {
        $data['titulo'] = "Editar";
     
        $data['user'] = $this->user->editar($id);
     
        $this->load->view('header');
        $this->load->view('usuarios/editar', $data);
        $this->load->view('footer');        
    }

    function deletar($id) 
    {
        if ($this->user->deletar($id)) {
            redirect('usuarios');
        } else {
            
        }
    }
}
