<<<<<<< HEAD
<?php 
return array(
  'roles'=>array( 
      'root'=>'Root',
      'super'=>'Superuser',
      'administrator'=>'Administrator',
      'onsite'=>'Onsite Officer',
      'registration'=>'Registration Officer'
    ),
  'access'=>array( 
      'all'=>'all',
      'restrict'=>'restrict',
      'client'=>'client',
      'vendor'=>'vendor'
    ),
  'permissions'=>array( 
      'create'=>'create',
      'update'=>'update',
      'delete'=>'delete',
      'import'=>'import'
      'approve'=>'approve',
      'share'=>'share'
      ),
=======
<?php return array(
  'roles'=>array( 'root'=>'Root','super'=>'Superuser','employee'=>'Employee','client'=>'Client','vendor'=>'Vendor'),
  'access'=>array( 'all'=>'all','restrict'=>'restrict','client'=>'client','vendor'=>'vendor'),
  'permissions'=>array('read'=>'read','create'=>'create','edit'=>'edit','delete'=>'delete','approve'=>'approve','share'=>'share'),
>>>>>>> 5891233d3b31fa74cf95400c4fd4ccfb43d310f7
  'aclobjects'=>array(
  		'document'=>'Document',
  		'user'=>'User',
  		'employee'=>'Employee',
  		'contact'=>'Contact',
  		'project'=>'Project',
  		'tender'=>'Tender',
  		'invoice'=>'Invoice',
  		'payroll'=>'Payroll',
  		'finance'=>'Finance',
  		'hr'=>'Human Resource'
  	)
);
