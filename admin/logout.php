<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/admin.php';

logout_admin();
set_flash('admin_auth', 'You have been signed out of the admin area.');
admin_redirect('login.php');
