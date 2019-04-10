<?php

/**
 * The default email message that will be sent to users as they are approved.
 *
 * @return string
 */
function nua_default_approve_user_message() {
	$message = __( 'Votre accès au site {sitename} a été approuvé', 'new-user-approve' ) . "\r\n\r\n";
	$message .= "{username}\r\n\r\n";
	$message .= "{login_url}\r\n\r\n";
    $message .= __( 'Cliquez sur le lien ci-dessous pour définir votre mot de passe :', 'new-user-approve' ) . "\r\n\r\n";
    $message .= "{reset_password_url}";

	$message = apply_filters( 'new_user_approve_approve_user_message_default', $message );

	return $message;
}

/**
 * The default email message that will be sent to users as they are denied.
 *
 * @return string
 */
function nua_default_deny_user_message() {
	$message = __( 'L\'accès au site {sitename} vous a été refusé.', 'new-user-approve' );

	$message = apply_filters( 'new_user_approve_deny_user_message_default', $message );

	return $message;
}

/**
 * The default message that will be shown to the user after registration has completed.
 *
 * @return string
 */
function nua_default_registration_complete_message() {
	$message = sprintf( __( 'Un mail a été envoyé aux administrateurs du site. Après avoir vérifier vos informations, ils pourront vous accorder l\'accès au site.', 'new-user-approve' ) );
	$message .= ' ';
	$message .= sprintf( __( 'Vous recevrez plus tard un mail avec vos informations de connexion. Merci de votre patience.', 'new-user-approve' ) );

	$message = apply_filters( 'new_user_approve_pending_message_default', $message );

	return $message;
}

/**
 * The default welcome message that is shown to all users on the login page.
 *
 * @return string
 */
function nua_default_welcome_message() {
	$welcome = sprintf( __( 'Bienvenue sur le site {sitename}. Ce site est accessible uniquement aux utilisateurs approuvés. Pour être approuvé, vous devez vous enregistrer.', 'new-user-approve' ), get_option( 'blogname' ) );

	$welcome = apply_filters( 'new_user_approve_welcome_message_default', $welcome );

	return $welcome;
}

/**
 * The default notification message that is sent to site admin when requesting approval.
 *
 * @return string
 */
function nua_default_notification_message() {
	$message = __( '{username} ({user_email}) a demandé d\'être approuvé sur le site {sitename}', 'new-user-approve' ) . "\n\n";
	$message .= "{site_url}\n\n";
	$message .= __( 'Pour approuver ou refuser cet utilisateur, cliquez sur le liens ci-dessous :', 'new-user-approve' ) . "\n\n";
	$message .= "{admin_approve_url}\n\n";

	$message = apply_filters( 'new_user_approve_notification_message_default', $message );

	return $message;
}

/**
 * The default message that is shown to the user on the registration page before any action
 * has been taken.
 *
 * @return string
 */
function nua_default_registration_message() {
	$message = __( 'Une fois enregistré, votre demande sera transmise aux administrateurs du site. Vous reçevrez plus tard un mail avec plus d\'informations.', 'new-user-approve' );

	$message = apply_filters( 'new_user_approve_registration_message_default', $message );

	return $message;
}
