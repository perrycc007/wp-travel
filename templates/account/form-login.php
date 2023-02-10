<?php
/**
 * Login / Register Form template.
 *
 * @package WP_Travel
 */

// Print Errors / Notices.
wptravel_print_notices();

$nonce_value = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
$nonce_value = isset( $_POST['wp-travel-register-nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['wp-travel-register-nonce'] ) ) : $nonce_value;

$login_form_toogle = '';
$reg_form_toogle   = '';

$settings = wptravel_get_settings();

$enable_my_account_customer_registration = isset( $settings['enable_my_account_customer_registration'] ) ? $settings['enable_my_account_customer_registration'] : 'yes';

$generate_username_from_email = isset( $settings['generate_username_from_email'] ) ? $settings['generate_username_from_email'] : 'no';
$generate_user_password       = isset( $settings['generate_user_password'] ) ? $settings['generate_user_password'] : 'no';

if ( ! empty( $_POST['register'] ) && wp_verify_nonce( $nonce_value, 'wp-travel-register' ) ) {

	$login_form_toogle = 'style="display:none"';
	$reg_form_toogle   = 'style="display:block"';

}

?>
<div class="wp-travel-dashboard-form">
	<div class="login-page">
		<?php if ( has_custom_logo() ) : ?>
			<div class="login-logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php endif; ?>
		<div class="form">
		<?php if ( 'yes' === $enable_my_account_customer_registration ) : ?>
			<!-- Registration form -->
			<form method="post" class="register-form" <?php echo $reg_form_toogle; ?> >
				<h3><?php esc_html_e( '申請帳戶', 'wp-travel' ); ?></h3>
				<?php if ( 'no' === $generate_username_from_email ) : ?>
					<span class="user-name">
						<input name="username" type="text" placeholder="<?php echo esc_attr__( '電話 eg. 447120123235/85291929195', 'wp-travel' ); ?>"/>
					</span>
				<?php endif; ?>
				<span class="user-name">
						<input name="account_first_name" type="text" placeholder="<?php echo esc_attr__( 'First name:', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-name">
						<input name="account_last_name" type="text" placeholder="<?php echo esc_attr__( 'Last name:', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-email">
					<input name="email" type="text" placeholder="<?php echo esc_attr__( '個人電郵', 'wp-travel' ); ?>"/>
				</span>
					<span class="user-name">
						<input name="account_contact_name" type="text" placeholder="<?php echo esc_attr__( '聯絡人', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-name">
						<input name="account_contact_email" type="text" placeholder="<?php echo esc_attr__( '聯絡人電郵', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-name">
						<input name="account_contact_phone_number" type="text" placeholder="<?php echo esc_attr__( '聯絡人電話', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-name">
						<input name="account_contact_relationship" type="text" placeholder="<?php echo esc_attr__( '聯絡人關係', 'wp-travel' ); ?>"/>
					</span>
				<?php if ( 'no' === $generate_user_password ) : ?>
					<span class="user-password">
						<input name="password" type="password" placeholder="<?php echo esc_attr__( '密碼 (至少要有一個英文字,一個數字及由8個字組成)', 'wp-travel' ); ?>"/>
						
					</span>
					<span class="user-password">
						<input name="pass2" type="password" placeholder="<?php echo esc_attr__( '確認密碼', 'wp-travel' ); ?>"/>
					</span>
				<?php endif; ?>
				<?php do_action( 'wp_travel_after_registration_form_password', $settings ); ?>
					<div class="wrapper">
						<!--<div class="float-left">
							<input class="" name="terms-condition" type="checkbox" id="terms-condition" value="forever" />
							<label for="terms-condition"><span>I have read and agree to the <a href="#">Terms of Use </a>and <a href="#">Privacy Policy</a></span></label>
						</div> -->
					</div>

				<?php wp_nonce_field( 'wp-travel-register', 'wp-travel-register-nonce' ); ?>
				<button  type="submit" name="register" value="<?php esc_attr_e( 'Register', 'wp-travel' ); ?>" ><?php esc_attr_e( '申請帳戶', 'wp-travel' ); ?></button>
				<p class="message"><?php echo esc_attr__( '已有帳戶?', 'wp-travel' ); ?> <a href="#"><?php echo esc_attr__( '登入', 'wp-travel' ); ?></a></p>
			</form>
		<?php endif; ?>
			<!-- Login Form -->
			<form method="post" class="login-form" <?php echo esc_attr( $login_form_toogle ); ?> >
					<h3><?php esc_html_e( '登入', 'wp-travel' ); ?></h3>
					<span class="user-username">
						<input name="username" type="text" placeholder="<?php echo esc_attr__( '電話 eg. 447120123235/85291929195', 'wp-travel' ); ?>"/>
					</span>
					<span class="user-password">
						<input name="password" type="password" placeholder="<?php echo esc_attr__( '密碼', 'wp-travel' ); ?>"/>
					</span>
					<div class="wrapper">

						<div class="float-left">
							<input class="" name="rememberme" type="checkbox" id="rememberme" value="forever" />
							<?php wp_nonce_field( 'wp-travel-login', 'wp-travel-login-nonce' ); ?>
							<label for="rememberme"><?php esc_html_e( '記住帳戶', 'wp-travel' ); ?></label>
						</div>
						<div class="float-right">
							<p class="info">
								<a href="<?php echo esc_url( wptravel_lostpassword_url() ); ?>"><?php echo esc_html__( '忘記密碼 ?', 'wp-travel' ); ?></a>
							</p>
						</div>
					</div>
				<button  type="submit" name="login" value="<?php esc_attr_e( '登入', 'wp-travel' ); ?>" ><?php esc_attr_e( '登入', 'wp-travel' ); ?></button>
				<?php if ( 'yes' === $enable_my_account_customer_registration ) : ?>
					<p class="message"><?php echo esc_html__( '未有帳戶?', 'wp-travel' ); ?> <a href="#"><?php echo esc_html__( '創建新帳戶', 'wp-travel' ); ?></a></p>
				<!-- <p>
					<?php echo esc_html__( '未有帳戶?', 'wp-travel' ); ?>
					<a href="https://prodeeptravel.com/register/"><?php echo esc_html__( '申請帳戶', 'wp-travel' ); ?></a>
				</p> -->
				<?php endif; ?>
			</form>
		</div>
	</div>
</div>
