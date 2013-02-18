<?php

return array(
		'collectiontype' => array(
			'attendee'=>'Attendee',
			'visitor'=>'Visitor',
			'official'=>'Official',
			//'exhibitor' => 'Exhibitor'
			),
		'officials' => array(
			'COM'=>'Commitee',
			'MDA'=>'Media',
			'ORG'=>'Organizer',
			'CTR'=>'Contractor',
			'WRK'=>'Worker',
			'BA30'=>'Booth Assistant 30',
			'BA150'=>'Booth Assistant 150',
			'SVO'=>'Student Volunteer',
			'OTS'=>'On-Site Technical Support',
			'ECP'=>'EC Participant',
			'TAP'=>'Technical Assistant Pre-Event'
		),
		'visitors' => array(
			'VS'=>'Walk In Visitor',
			'VIP'=>'VIP',
			'VVIP'=>'VVIP',
			'OC'=>'Other Complimentary'
		),
		'galadinner'=>1,
		'reg_admin_email'=>'conventionipa2013@dyandra.com',
		'reg_admin_name'=>'37th IPA Convex Register',

		'reg_dyandra_admin_email'=>'conventionipa2013@dyandra.com',
		'reg_dyandra_admin_name'=>'37th IPA Convex Register',
		
		'reg_finance_email'=>'conventionipa2013@dyandra.com',
		'reg_finance_name'=>'37th IPA Convex Finance',
		

		'paystatus'=>array(
			'unpaid'=>'Unpaid',
			'paid'=>'Paid',
			'cancel'=>'Cancel'
		),

		'golfquota'=>100,

		'valid_heads'=>array(
			'no',
			'username',
			'inv_letter',
			'salutation',
			'firstname',
			'lastname',
			'position_division',
			'email',
			'mobile',
			'company',
			'companys_npwp',
			'address_1',
			'address_2',
			'city',
			'zip',
			'country',
			'company_country_code',
			'company_area_code',
			'phone',
			'fax_country_code',
			'fax_area_code',
			'fax',
			'invoice_address_conv',
			'registertype',
			'galadinner',
			'golf'
		),

		'valid_head_selects'=>array(
			'unmapped'=>'unmapped',
			'no'=>'no',
			'username'=>'username',
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position_division',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',
			'company_country_code'=>'company_country_code',
			'company_area_code'=>'company_area_code',
			'phone'=>'phone',
			'fax_country_code'=>'fax_country_code',
			'fax_area_code'=>'fax_area_code',
			'fax'=>'fax',
			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'registertype',
			'galadinner'=>'galadinner',
			'golf'=>'golf'
		),


		'attendee_map'=>array(
			'inv_letter'=>'inv_letter',
			'salutation'=>'salutation',
			'firstname'=>'firstname',
			'lastname'=>'lastname',
			'position_division'=>'position',
			'email'=>'email',
			'mobile'=>'mobile',
			'company'=>'company',
			'companys_npwp'=>'companys_npwp',
			'address_1'=>'address_1',
			'address_2'=>'address_2',
			'city'=>'city',
			'zip'=>'zip',
			'country'=>'country',

			'company_country_code'=>'companyphonecountry',
			'company_area_code'=>'companyphonearea',
			'phone'=>'companyphone',

			'fax_country_code'=>'companyfaxcountry',
			'fax_area_code'=>'companyfaxarea',
			'fax'=>'companyfax',

			'invoice_address_conv'=>'invoice_address_conv',
			'registertype'=>'regtype',
			'galadinner'=>'attenddinner',
			'golf'=>'golf'
		),

		'attendee_template'=>array(

			'address'=> '',
			'address_1'=> '',
			'address_2'=> '',
			'addressInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'invoice_address_conv'=>'',
			'attenddinner'=> '',
			'city'=> '',
			'cityInvoice'=> '',
			'company'=> '',
			'companyInvoice'=> '',


			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',

			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',


			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',


			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',

			'confirmation'=> 'none',
			'country'=> '',
			'countryInvoice'=> '',
			'email'=> '',
			'firstname'=> '',
			'golf'=> '',
			'golfSequence'=> 0,
			'lastname'=> '',
			'mobile'=> '',
			'npwp'=> '',
			'npwpInvoice'=> '',
			'pass'=> '',
			'golfPaymentStatus'=> 'unpaid',
			'conventionPaymentStatus'=> 'unpaid',
			'position'=> '',
			'registrationnumber'=> '',
			'regtype'=> '',
			'role'=> 'attendee',
			'salutation'=> '',
			'zip'=> '',
			'zipInvoice'=> ''
		),

		'attendee_csv_template'=>array(

			'address'=>'',
			'address_1'=> '',
			'address_2'=> '',
			'addressInvoice'=> '',
			'addressInvoice_1'=> '',
			'addressInvoice_2'=> '',
			'invoice_address_conv'=>'',
			'attenddinner'=> '',
			'city'=> '',
			'cityInvoice'=> '',
			'company'=> '',
			'companyInvoice'=> '',
			'companyfaxcountry'=> '',
			'companyfaxarea'=> '',
			'companyfax'=> '',
			'companyphonecountry'=> '',
			'companyphonearea'=> '',
			'companyphone'=> '',
			'companyphoneInvoiceCountry'=> '',
			'companyphoneInvoiceArea'=> '',
			'companyphoneInvoice'=> '',
			'companyfaxInvoiceCountry'=> '',
			'companyfaxInvoiceArea'=> '',
			'companyfaxInvoice'=> '',
			'confirmation'=> 'none',
			'country'=> '',
			'countryInvoice'=> '',
			'email'=> '',
			'firstname'=> '',
			'golf'=> '',
			'golfSequence'=> 0,
			'lastname'=> '',
			'mobile'=> '',
			'npwp'=> '',
			'npwpInvoice'=> '',
			'pass'=> '',
			'golfPaymentStatus'=> 'unpaid',
			'conventionPaymentStatus'=> 'unpaid',
			'position'=> '',
			'registrationnumber'=> '',
			'regtype'=> '',
			'role'=> 'attendee',
			'salutation'=> '',
			'zip'=> '',
			'zipInvoice'=> ''
		),





	);


?>