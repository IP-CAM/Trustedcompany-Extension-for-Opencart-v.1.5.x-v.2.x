<?php
class ControllerModuleTrustedcompanyacf extends Controller {
	private $error = array();

	public function install() {
		$this->load->model('extension/event');
		$this->model_extension_event->addEvent('trustedcompanyacf', 'pre.order.history.add', 'module/trustedcompanyacf/acf_email');
	}
	
	public function uninstall() {
	    $this->load->model('extension/event');
	    $this->model_extension_event->deleteEvent('trustedcompanyacf');
	}

	public function index() {
		$this->load->language('module/trustedcompanyacf');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('trustedcompanyacf', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] 		= $this->language->get('heading_title');
		$data['texte_dns'] 			= $this->language->get('texte_dns');
		$data['texte_add_email'] 	= $this->language->get('texte_add_email');
		$data['text_acf'] 			= $this->language->get('text_acf');
		$data['text_edit'] 			= $this->language->get('text_edit');
		$data['button_save'] 		= $this->language->get('button_save');
		$data['button_cancel'] 		= $this->language->get('button_cancel');

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
			'text' => $this->language->get('texte_pour_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('head_titre'),
			'href' => $this->url->link('module/trustedcompanyacf', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('module/trustedcompanyacf', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];

        if ($this->config->get('trustedcompanyacf_client_domain')) {
        	$data['trustedcompanyacf_client_domain'] = $this->config->get('trustedcompanyacf_client_domain');
        } else {
        	$data['trustedcompanyacf_client_domain'] = '';
        }

        if ($this->config->get('trustedcompanyacf_inbound_email')) {
        	$data['trustedcompanyacf_inbound_email'] = $this->config->get('trustedcompanyacf_inbound_email');
        } else {
        	$data['trustedcompanyacf_inbound_email'] = '';
        }

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/trustedcompanyacf.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/trustedcompanyacf')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}
}



