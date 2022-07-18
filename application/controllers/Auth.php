<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('Login_Process');
		$this->load->helper('captcha');
    }

	//  *****    Code for login  user    *****     // 
	public function index(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$captcha_insert = $this->input->post('captcha');
			$contain_sess_captcha = $this->session->userdata('valuecaptchaCode');

			$values = array(
				'word' => '',
				'word_length' => 8,
				'img_path' => './captcha/',
				'img_url' => base_url() .'captcha/',
				'font_path' => base_url() . 'assets/fonts/texb.ttf',
				'img_width' => '150',
				'img_height' => 50,
				'expiration' => 3600
				);
			$data = create_captcha($values);
				
			if ($captcha_insert === $contain_sess_captcha) {
				$user_id = $this->input->post('user_id');
				$user_pw = $this->input->post('user_pwd');
				$sess = SESSION_YEAR;
				$session_year_id = $this->master->f_get_particulars('md_fin_year',array('sl_no'),array('fin_year'=>$sess),1);
				$result  = $this->Login_Process->f_select_password($user_id);
				if($result){
					$match	 = password_verify($user_pw,$result->password);
					if($match){
						$user_data = $this->Login_Process->f_get_user_inf($user_id);
						$this->session->set_userdata('uloggedin',$user_data);
						$this->session->set_userdata('session_year_id',$session_year_id->sl_no);
						redirect('index.php/auth/dashboard');
					}else{
						$this->session->unset_userdata('valuecaptchaCode');
		                $this->session->set_userdata('valuecaptchaCode',$data['word']);
						$this->load->view('login',$data);
					}
				}else{
					$this->session->unset_userdata('valuecaptchaCode');
		            $this->session->set_userdata('valuecaptchaCode',$data['word']);
					$this->session->set_flashdata('error', 'Problem with User id ');
					$this->load->view('login',$data);
				}
		    }else{
				$this->session->set_flashdata('error', 'Problem with Captcha');
				$this->session->unset_userdata('valuecaptchaCode');
				$this->session->set_userdata('valuecaptchaCode',$data['word']);
				$this->load->view('login',$data);
			}
		}else{
			$values = array(
				'word' => '',
				'word_length' => 8,
				'img_path' => './captcha/',
				'img_url' => base_url() .'captcha/',
				'font_path' => base_url() . 'assets/fonts/texb.ttf',
				'img_width' => '150',
				'img_height' => 50,
				'expiration' => 3600
				);
			$data = create_captcha($values);
			$this->session->unset_userdata('valuecaptchaCode');
		    $this->session->set_userdata('valuecaptchaCode',$data['word']);
			$this->load->view('login',$data);
		}
			
	}

	//  *****    Code for Checking Phone number exist or not For registration *****     // 
	public function phnumber_check(){

		$phnumber = trim($this->input->post('pnnumber'));
		$query = $this->db->get_where('md_users', array('phone_no =' => $phnumber))->result();
		echo count($query);
	}
	public function email_check(){

		$email = trim($this->input->post('email'));
		$query = $this->db->get_where('md_users', array('email =' => $email))->result();
		echo count($query);
	}
	

	//  *****    Code for Register a  user    *****    // 
	public function register(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			$captcha_insert = $this->input->post('captcha');
			$contain_sess_captcha = $this->session->userdata('valuecaptchaCode');
			if ($captcha_insert === $contain_sess_captcha) {
				$otp = mt_rand(1111,9999);
				$data = array('first_name'=> trim($this->input->post('first_name')),
							'last_name' => trim($this->input->post('last_name')),
							'dept'      => trim($this->input->post('dept')),
							'email'     => trim($this->input->post('email')),
							'otp'       => $otp,
							'phone_no'  => trim($this->input->post('phone_no')),
							'designation'  => trim($this->input->post('desig')),
							'password'  => password_hash(trim($this->input->post('user_pwd')), PASSWORD_DEFAULT),
							'conifrm_pwd'=> password_hash(trim($this->input->post('conf_pwd')), PASSWORD_DEFAULT),
							'created_by' => trim($this->input->post('first_name')).' '.trim($this->input->post('last_name')),
							'created_dt' => date('Y-m-d H:i:s')
							);
			    $num = $this->master->f_insert('md_users',$data);
			if($num > 0 ) {
				$config = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'webmail.wbsmconfed.in',
					'smtp_port' => 25,
					'smtp_user' => 'admin@wbsmconfed.in',
					'smtp_pass' => 'Mi0#2m96j@WBsmConfed',
					'charset'=>'utf-8',
					'wordwrap'=> TRUE,
					'mailtype' => 'html'
				);
				$this->load->library('email');
				$to = trim($this->input->post('email'));
				$this->email->initialize($config);
                $this->email->set_newline("\r\n"); 
				$this->email->from('admin@wbsmconfed.in'); // change it to yours
				$emaildata['otp'] = $otp;
				$emaildata['username'] = trim($this->input->post('first_name'));
				$emaildata['email'] = trim($this->input->post('email'));
				$message = $this->load->view('common/emailtemplate',$emaildata,true);
				//$this->load->view('common/emailtemplate',$emaildata,true);
				$this->email->to($to);// change it to yours
				$this->email->subject('Registration');
				$this->email->message($message);
				if($this->email->send())
				{
					$this->session->set_flashdata("email_sent","Email sent successfully."); 
				}
				else
				{
					//show_error($this->email->print_debugger());
					$this->session->set_flashdata("email_sent","Error in sending Email."); 
				}
				$this->session->set_flashdata('success', 'Registration completed.');
				redirect('index.php/auth/register/');
			}else{
				$this->session->set_flashdata('error', 'Something Went wrong.');
			}
			
		   }else{

			$this->session->set_flashdata('success', 'Captch Not Found.');
			redirect('index.php/auth/register/');
		   }
		}else{
			
			 $values = array(
				'word' => '',
				'word_length' => 8,
				'img_path' => './captcha/',
				'img_url' => base_url() .'captcha/',
				'font_path' => base_url() . 'assets/fonts/texb.ttf',
				'img_width' => '150',
				'img_height' => 50,
				'expiration' => 3600
				);
				$data = create_captcha($values);
				// image will store in "$data['image']" index and its send on view page
			$this->session->unset_userdata('valuecaptchaCode');
		    $this->session->set_userdata('valuecaptchaCode',$data['word']);
			$data['dept'] = $this->master->f_get_particulars('md_department',NULL,NULL,0);
			$this->load->view('registration',$data);
		}
			
	}

	public function testmail(){
		$this->load->view('common/emailtemplate');
		// $this->load->library('email');
		// 	    $config = Array(
		// 		        'protocol' => 'smtp',
		// 				'smtp_host' => 'webmail.wbsmconfed.in',
		// 				'smtp_port' => 25,
		// 				'smtp_user' => 'admin@wbsmconfed.in',
		// 				'smtp_pass' => 'Mi0#2m96j@WBsmConfed',
		// 			);
		// 		  $message = 'Demo test email  for testing purpose';
        //   $this->email->initialize($config);
        //   $this->email->set_newline("\r\n");
		//  //$this->email->set_newline("\r\n");
		//   $this->email->from('admin@wbsmconfed.in'); // change it to yours
		//   //$this->email->to('lokesh@synergicsoftek.com');// change it to yours
		//   $this->email->to('lokesh@synergicsoftek.com','lk60588@gmail.com');// change it to yours
		//   $this->email->subject('Resume from JobsBuddy for your Job posting');
		//   $this->email->message($message);
		//   if($this->email->send())
		//   {
		// 	  echo 'Email sent.';
		//   }
		//   else
		//   {
		// 	  show_error($this->email->print_debugger());
		//   }

	}

	//  *****  Code for forgot password listing   ***** //
	public function forgotpass(){
		$this->load->view('forgot');
	}

    //  *****  Code for Dashboard listing   ***** //
	public function dashboard()
	{
		if($this->session->userdata('uloggedin')){
		$this->load->view('common/header');
		$this->load->view('dashboard');
		$this->load->view('common/footer');
		}else{
			$this->session->unset_userdata('uloggedin');
			redirect(base_url());
		}
	}

	//  *****  Code for logout User***** //
	public function logout(){

		if($this->session->userdata('uloggedin')){

			$this->session->unset_userdata('uloggedin');
			redirect(base_url());

		}else{
			redirect(base_url());

		}
	}

	//  *****  Code for New User Verification BY Administator ***** //
	public function verification(){

		if($_SERVER['REQUEST_METHOD']=="POST"){
			
			$user_id = $this->input->post('user_id');
			$user_pw = $this->input->post('user_pwd');
			$result  = $this->Login_Process->f_select_password($user_id);
			if($result){
				$match	 = password_verify($user_pw,$result->password);
				if($match){
					$user_data = $this->Login_Process->f_get_user_inf($user_id);
					$this->session->set_userdata('uloggedin',$user_data);
					//$this->session->set_userdata('sl_no',$this->Login_Process->f_audit_trail_value($user_id));
					redirect('index.php/verify/');
				}else{
					$this->load->view('uservalidation/login');
				}
		    }else{
				$this->session->set_flashdata('Error', 'Problem with User id');
				$this->load->view('uservalidation/login');
			}
		}else{
			$this->load->view('uservalidation/login');
		}
			
	}
	//
}
