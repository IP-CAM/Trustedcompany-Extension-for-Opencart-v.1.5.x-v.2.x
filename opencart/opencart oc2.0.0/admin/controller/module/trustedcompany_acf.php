<?php
class ControllerModuleTrustedcompanyacf extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/trustedcompany_acf');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('trustedcompany_acf', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] 			= $this->language->get('text_edit');

		$data['button_save'] 		= $this->language->get('button_save');
		$data['button_cancel'] 		= $this->language->get('button_cancel');
		$data['text_tc_domain'] 	= $this->language->get('text_tc_domain');
		$data['text_tc_email'] 		= $this->language->get('text_tc_email');
		$data['text_tc_text'] 		= $this->language->get('text_tc_text');



		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = array();
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/trustedcompany_acf', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/trustedcompany_acf', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];


        if ($this->config->get('trustedcompanydns')) {
        	$data['trustedcompanydns'] = $this->config->get('trustedcompanydns');
        } else {
        	$data['trustedcompanydns'] = '';
        }

        if ($this->config->get('trustedcompanyinboundemail')) {
        	$data['trustedcompanyinboundemail'] = $this->config->get('trustedcompanyinboundemail');
        } else {
        	$data['trustedcompanyinboundemail'] = '';
        }


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/trustedcompany_acf.tpl', $data));

	}


	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/trustedcompany_acf')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}


}



