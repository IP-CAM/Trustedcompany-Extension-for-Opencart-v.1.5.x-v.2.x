<?php
class ControllerModuleTrustedcompanyacf extends Controller {

	public function index() {
		$this->load->model('localisation/language');
		$this->load->model('setting/setting');
		$this->load->model('setting/extension');
		$this->load->language('module/trustedcompany_acf');

		$this->data['token'] = $this->session->data['token'];

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('trustedcompany_acf', $this->request->post);  
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] 		= $this->language->get('heading_title');
		$this->data['button_save'] 			= $this->language->get('button_save');
		$this->data['button_cancel'] 		= $this->language->get('button_cancel');
		$this->data['text_tc_email'] 		= $this->language->get('text_tc_email');
		$this->data['texte_tc_dns'] 		= $this->language->get('texte_tc_dns');
		$this->data['text_tc_acf'] 		= $this->language->get('text_tc_acf');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/trustedcompany_acf', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);



        if ($this->config->get('trustedcompanyinboundemail')) {
        	$this->data['trustedcompanyinboundemail'] = $this->config->get('trustedcompanyinboundemail');
        } else {
        	$this->data['trustedcompanyinboundemail'] = '';
        }

        if ($this->config->get('trustedcompanydns')) {
        	$this->data['trustedcompanydns'] = $this->config->get('trustedcompanydns');
        } else {
        	$this->data['trustedcompanydns'] = '';
        }


        $this->data['action'] = $this->url->link('module/trustedcompany_acf', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/trustedcompany_acf.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());

	}
}



