<?php
class ControllerModuleTrustedcompanyacf extends Controller {
	
	public function acf_email($order_id) {

		$order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int)$order_id . "'");

		if ($order_query->num_rows) {
			$order_info = array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'email'                   => $order_query->row['email'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $order_query->row['fax'],
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_method'          => $order_query->row['payment_method'],
				'payment_code'            => $order_query->row['payment_code'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_method'         => $order_query->row['shipping_method'],
				'shipping_code'           => $order_query->row['shipping_code'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'order_status_id'         => $order_query->row['order_status_id'],
				'order_status'            => $order_query->row['order_status'],
				'affiliate_id'            => $order_query->row['affiliate_id'],
				'commission'              => $order_query->row['commission'],
				'language_id'             => $order_query->row['language_id'],
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'ip'                      => $order_query->row['ip'],
				'forwarded_ip'            => $order_query->row['forwarded_ip'],
				'user_agent'              => $order_query->row['user_agent'],
				'accept_language'         => $order_query->row['accept_language'],
				'date_modified'           => $order_query->row['date_modified'],
				'date_added'              => $order_query->row['date_added']
			);

			// TrustedCompany ACF email
			if ($this->config->get('trustedcompanyacf_inbound_email')) {
				$trustedCompany_acf_email_subject = 'TrustedCompany ACF Email‏';
				
				// add the TAG to the email.						
				$trustedCompany_acf_email_tag = "acf email from : " . $order_info['store_name'] . "\ndomain name : " . $this->config->get('trustedcompanyacf_client_domain');

				$trustedCompany_acf_email_tag .= "\n";

				$trustedCompany_acf_email_tag .= "<!-- TC: " . $order_info['shipping_firstname'] . " " . $order_info['shipping_lastname'] . "," . $order_info['email'] . "," . $order_info['order_id'] ." -->";

				$mail = new Mail();
				$mail->protocol 		= $this->config->get('config_mail_protocol');
				$mail->smtp_hostname	= $this->config->get('config_mail_smtp_hostname');
				$mail->smtp_username	= $this->config->get('config_mail_smtp_username');
				$mail->smtp_password	= $this->config->get('config_mail_smtp_password');
				$mail->smtp_port		= $this->config->get('config_mail_smtp_port');
				$mail->smtp_timeout		= $this->config->get('config_mail_smtp_timeout');
				
				$mail->setTo($this->config->get('trustedcompanyacf_inbound_email'));
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order_info['store_name']);
				$mail->setSubject($trustedCompany_acf_email_subject);
				$mail->setText($trustedCompany_acf_email_tag);
				$mail->send();
			}	
		}
	}

}
