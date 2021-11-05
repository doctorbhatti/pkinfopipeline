<?php


/*======
*
* Social Counter Widget
*
======*/
class wikilogy_TwitterAPIExchange {

	/** @var string OAuth access token */
	private $oauth_access_token;

	/** @var string OAuth access token secrete */
	private $oauth_access_token_secret;

	/** @var string Consumer key */
	private $consumer_key;

	/** @var string consumer secret */
	private $consumer_secret;

	/** @var array POST parameters */
	private $post_fields;

	/** @var string GET parameters */
	private $get_field;

	/** @var array OAuth credentials */
	private $oauth_details;

	/** @var string Twitter's request URL or endpoint */
	private $request_url;

	/** @var string Request method or HTTP verb */
	private $requestMethod;

	public function wikilogy_encode( $value ) {
		$func = 'base64' . '_encode';
		return $func( $value );
	}
	/** Class constructor */
	public function __construct( $settings ) {

		if ( ! isset( $settings['oauth_access_token'] )
			 || ! isset( $settings['oauth_access_token_secret'] )
			 || ! isset( $settings['consumer_key'] )
			 || ! isset( $settings['consumer_secret'] )
		) {
			return new WP_Error( 'twitter_param_incomplete', esc_html__( 'Make sure you are passing in the correct parameters', 'wikilogy' ) );
		}

		$this->oauth_access_token = $settings['oauth_access_token'];
		$this->oauth_access_token_secret = $settings['oauth_access_token_secret'];
		$this->consumer_key = $settings['consumer_key'];
		$this->consumer_secret = $settings['consumer_secret'];
	}


	/**
	 * Set postfields array, example: array('screen_name' => 'J7mbo')
	 *
	 * @param array $array Array of parameters to send to API
	 *
	 * @throws \Exception When you are trying to set both get and post fields
	 *
	 * @return TwitterAPIExchange Instance of self for method chaining
	 */
	public function wikilogy_setPostfields( array $array ) {
		$this->post_fields = $array;

		return $this;
	}


	/**
	 * Set getfield string, example: '?screen_name=J7mbo'
	 *
	 * @param string $string Get key and value pairs as string
	 *
	 * @throws \Exception
	 *
	 * @return \TwitterAPIExchange Instance of self for method chaining
	 */
	public function wikilogy_wikilogy_wikilogy_getGetfield( $string ) {
		$this->get_field = $string;

		return $this;
	}
	/**
	 * Get getfield string (simple getter)
	 *
	 * @return string $this->getfields
	 */
	public function wikilogy_getGetfield()
	{
		return $this->getfield;
	}
	/**
	 * Get postfields array (simple getter)
	 *
	 * @return array $this->postfields
	 */
	public function wikilogy_getPostfields()
	{
		return $this->postfields;
	}
	/**
	 * Build the Oauth object using params set in construct and additionals
	 * passed to this method. For v1.1, see: https://dev.twitter.com/docs/api/1.1
	 *
	 * @param string $url The API url to use. Example: https://api.twitter.com/1.1/search/tweets.json
	 * @param string $requestMethod Either POST or GET
	 *
	 * @throws \Exception
	 *
	 * @return \TwitterAPIExchange Instance of self for method chaining
	 */
	public function wikilogy_buildOauth( $request_url, $requestMethod ) {
		if ( ! in_array( strtolower( $requestMethod ), array( 'post', 'get' ) ) ) {
			return new WP_Error( 'invalid_request', esc_html__( 'Request method must be either POST or GET', 'wikilogy' ) );
		}

		$consumer_key = $this->consumer_key;
		$consumer_secret = $this->consumer_secret;
		$oauth_access_token = $this->oauth_access_token;
		$oauth_access_token_secret = $this->oauth_access_token_secret;

		$oauth_credentials = array(
			'oauth_consumer_key' => $consumer_key,
			'oauth_nonce' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_token' => $oauth_access_token,
			'oauth_timestamp' => time(),
			'oauth_version' => '1.0'
		);
		
		if ( ! is_null( $this->get_field ) ) {
			// remove question mark(?) from the query string
			$get_fields = str_replace( '?', '', explode( '&', $this->get_field ) );

			foreach ( $get_fields as $field ) {
				// split and add the GET key-value pair to the post array.
				// GET query are always added to the signature base string
				$split = explode( '=', $field );
				$oauth_credentials[ $split[0] ] = $split[1];
			}
		}

		// convert the oauth credentials (including the GET QUERY if it is used) array to query string.
		$signature = $this->wikilogy__build_signature_base_string( $request_url, $requestMethod, $oauth_credentials );

		$oauth_credentials['oauth_signature'] = $this->wikilogy__generate_oauth_signature( $signature );

		// save the request url for use by WordPress HTTP API
		$this->request_url = $request_url;

		// save the OAuth Details
		$this->oauth_details = $oauth_credentials;

		$this->requestMethod = $requestMethod;

		return $this;
	}


	/**
	 * Create a signature base string from list of arguments
	 *
	 * @param string $request_url request url or endpoint
	 * @param string $method HTTP verb
	 * @param array $oauth_params Twitter's OAuth parameters
	 *
	 * @return string
	 */
	private function wikilogy__build_signature_base_string( $request_url, $method, $oauth_params ) {
		// save the parameters as key value pair bounded together with '&'
		$string_params = array();

		ksort( $oauth_params );

		foreach ( $oauth_params as $key => $value ) {
			// convert oauth parameters to key-value pair
			$string_params[] = "$key=$value";
		}

		return "$method&" . rawurlencode( $request_url ) . '&' . rawurlencode( implode( '&', $string_params ) );
	}


	public function wikilogy__generate_oauth_signature( $data ) {

		// encode consumer and token secret keys and subsequently combine them using & to a query component
		$hash_hmac_key = rawurlencode( $this->consumer_secret ) . '&' . rawurlencode( $this->oauth_access_token_secret );

		$oauth_signature = $this->wikilogy_encode( hash_hmac( 'sha1', $data, $hash_hmac_key, true ) );

		return $oauth_signature;
	}


	/**
	 * Generate the authorization HTTP header
	 * @return string
	 */
	public function wikilogy_authorization_header() {
		$header = 'OAuth ';

		$oauth_params = array();
		foreach ( $this->oauth_details as $key => $value ) {
			$oauth_params[] = "$key=\"" . rawurlencode( $value ) . '"';
		}

		$header .= implode( ', ', $oauth_params );

		return $header;
	}


	/**
	 * Process and return the JSON result.
	 *
	 * @return string
	 */
	public function wikilogy_process_request() {

		$header = $this->wikilogy_authorization_header();

		$args = array(
			'headers' => array( 'Authorization' => $header ),
			'timeout' => 45,
			'sslverify' => false
		);

		if ( ! is_null( $this->post_fields ) ) {
			$args['body'] = $this->post_fields;

			$response = wp_remote_post( $this->request_url, $args );

			return wp_remote_retrieve_body( $response );
		}

		else {

			// add the GET parameter to the Twitter request url or endpoint
			$url = $this->request_url . $this->get_field;

			$response = wp_remote_get( $url, $args );

			return wp_remote_retrieve_body( $response );

		}

	}
}

class wikilogy_social_counter extends WP_Widget {
	function __construct(){

		$widget_ops = array(
			'classname' => 'wikilogy-social-counter-widget', 
			'description' => esc_html__( 'Use this widget to display your social counts.', 'wikilogy' ) 
		);
		
		parent::__construct(
			'wikilogy_social_counter_widget',
			esc_html__( 'Social Counter' , 'wikilogy' ),
			$widget_ops
		);
	}

	function widget( $args, $instance ) {

		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
		$target = isset( $instance[ 'target' ] ) ? $instance[ 'target' ] : false;

		if ( ! $target ) {
			$target = false;
		}

		$facebook_app_id = ( isset( $instance[ 'facebook_app_id' ] ) ) ? $instance[ 'facebook_app_id' ] : '';
		$facebook_app_secret = ( isset( $instance[ 'facebook_app_secret' ] ) ) ? $instance[ 'facebook_app_secret' ] : '';
		$facebook_page_id = ( isset( $instance[ 'facebook_page_id' ] ) ) ? $instance[ 'facebook_page_id' ] : '';
		$facebook_username = ( isset( $instance[ 'facebook_username' ] ) ) ? $instance[ 'facebook_username' ] : '';
		$youtube_username = ( isset( $instance[ 'youtube_username' ] ) ) ? $instance[ 'youtube_username' ] : '';
		$vimeo_channel = ( isset( $instance[ 'vimeo_channel' ] ) ) ? $instance[ 'vimeo_channel' ] : '';
		$instagram_api = ( isset( $instance[ 'instagram_api' ] ) ) ? $instance[ 'instagram_api' ] : '';
		$google_username = ( isset( $instance[ 'google_username' ] ) ) ? $instance[ 'google_username' ] : '';
		$google_api_key = ( isset( $instance[ 'google_api_key' ] ) ) ? $instance[ 'google_api_key' ] : '';
		$twitter_id = ( isset( $instance[ 'twitter_id' ] ) ) ? $instance[ 'twitter_id' ] : '';
		$access_token = ( isset( $instance[ 'access_token' ] ) ) ? $instance[ 'access_token' ] : '';
		$access_token_secret = ( isset( $instance[ 'access_token_secret' ] ) ) ? $instance[ 'access_token_secret' ] : '';
		$consumer_key = ( isset( $instance[ 'consumer_key' ] ) ) ? $instance[ 'consumer_key' ] : '';
		$consumer_secret = ( isset( $instance[ 'consumer_secret' ] ) ) ? $instance[ 'consumer_secret' ] : '';

		echo $before_widget;

		$target = ( $target ) ? "target='_blank'" : "";
		if ( $title ) { 
			echo $before_title . esc_attr( $title ) . $after_title; 
		}
		if ((isset($twitter_id)&&(strlen($twitter_id) != 0)) && (isset($access_token)&&(strlen($access_token) != 0)) && (isset($access_token_secret)&&(strlen($access_token_secret) != 0)) && (isset($consumer_key)&&(strlen($consumer_key) != 0)) && (isset($consumer_secret)&&(strlen($consumer_secret) != 0))){
			$interval = 600;
			$follow_count = 0;

			$settings = array(
				'oauth_access_token' => $access_token,
				'oauth_access_token_secret' => $access_token_secret,
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret
			);


			$url = 'https://api.twitter.com/1.1/users/show.json';
			$requestMethod = 'GET';
			$getfield = '?screen_name='.$twitter_id;
			
			$twitter = new wikilogy_TwitterAPIExchange($settings);
			$twitter_data = json_decode($twitter->wikilogy_wikilogy_wikilogy_getGetfield($getfield) ->wikilogy_buildOauth($url, $requestMethod) ->wikilogy_process_request());	
			
			$follow_count = $twitter_data->followers_count;
			update_option('twitter_cache_time', time() + $interval);
			update_option('twitter_followers', $follow_count);
		}
		if(isset($youtube_username)&&(strlen($youtube_username) != 0)){
			$interval = 600;
			$url = "https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=".$youtube_username."&key=AIzaSyB9OPUPAtVh3_XqrByTwBTSDrNzuPZe8fo";
			$json = wp_remote_get($url);
			$json_data = json_decode($json['body'], false);
				if($json_data != null){
					$subscriberCount = $json_data->items[0]->statistics->subscriberCount;
				}
				if (isset($subscriberCount) && ($subscriberCount > 0) ){
					update_option('youtube_cache_time', time() + $interval);
					update_option('youtube_subscribers', $subscriberCount );
				}	
		}
		if (isset($instagram_api)&&(strlen($instagram_api) != 0)){
			$interval = 600;
			$instagram_count = 0;
			$instagram_username = '';
			$instagram_userid = explode(".", $instagram_api);
			$url = 'https://api.instagram.com/v1/users/'.$instagram_userid[0].'/?access_token='.$instagram_api;
			$api = wp_remote_get( $url ) ;
			$request = json_decode(wp_remote_retrieve_body ($api), true);
			$instagram_count = $request['data']['counts']['followed_by'];
			$instagram_username = $request['data']['username'];
			$instagram_url = 'http://instagram.com/'.$instagram_username;
			if ($instagram_count >= 0 ) {
				update_option('instagram_cache_time', time() + $interval);
				update_option('instagram_followers', $instagram_count);
				update_option('instagram_link', $instagram_url);
			}
		}
		if(isset($vimeo_channel)&&(strlen($vimeo_channel) != 0)){
			$interval = 600;
			$url = "http://vimeo.com/api/v2/channel/".$vimeo_channel."/info.json";
			$json = wp_remote_get($url);

			if ( is_wp_error( $json ) ) {
				echo esc_attr( $error_string = $json->get_error_message() );
				return;
			}
			$data = wp_remote_retrieve_body( $json );
			$json_output = json_decode($data);
				
			
				if($json_output != null){
					$result = $json_output->total_subscribers;
				}
				if (isset($total_subscribers) && ($total_subscribers > 0) ){
					update_option('vimeo_cache_time', time() + $interval);
					update_option('vimeo_subscribers', $total_subscribers );
				}

			$total_subscribers = $result ? $result : 0;
		} 
		if ((isset($google_username)&&(strlen($google_username) != 0)) && (isset($google_api_key)&&(strlen($google_api_key) != 0))){
			$interval = 600;
			$circledByCount = 0;

			$request = @wp_remote_get( 'https://www.googleapis.com/plus/v1/people/' . $google_username . '?key=' . $google_api_key );
			if ( false == $request ) {
			 return null;
			}
			$response = json_decode( @wp_remote_retrieve_body( $request ) );
				if ( isset( $response->circledByCount ) ) {
					$followers = $response->circledByCount;
					update_option('google_cache_time', time() + $interval);
					update_option('google_followers', $followers);
				}
		}
		if ((isset($facebook_app_id)&&(strlen($facebook_app_id) != 0)) && (isset($facebook_app_secret)&&(strlen($facebook_app_secret) != 0)) && (isset($facebook_page_id)&&(strlen($facebook_page_id) != 0)) && (isset($facebook_username)&&(strlen($facebook_username) != 0))){
			$interval = 600;

			$secret = wp_remote_get('https://graph.facebook.com/oauth/access_token?type=client_cred&client_id='.$facebook_app_id.'&client_secret='.$facebook_app_secret.'');
				if (!is_wp_error($secret)) {
					$json = json_decode($secret['body']);
					$access_token = $json->access_token;
				}
			
			$secret = wp_remote_retrieve_body( $secret );
			$json_url = 'https://graph.facebook.com/'.$facebook_page_id.'?access_token='.$access_token.'&fields=name,likes,fan_count';

			$json = wp_remote_get($json_url);

			if ( is_wp_error( $json ) ) {
				echo esc_attr( $error_string = $json->get_error_message() );
				return;
			}
			$data = wp_remote_retrieve_body( $json );
				$json_output = json_decode($data);

				$likes = $json_output->fan_count ? $json_output->fan_count : 0;
		}

		if (!function_exists('wikilogy_abreviateTotalCount')) {
			function wikilogy_abreviateTotalCount($value = "") {
				$abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');
				foreach ($abbreviations as $exponent => $abbreviation) {
					if ($value >= pow(10, $exponent)) {
						return round(floatval($value / pow(10, $exponent)), 1) . $abbreviation;
					}
				}
			}
		}
			
		?>
		
		<div class="wikilogy-widget-inner">
			<ul class="wikilogy-social wikilogy-social-a">
				<?php if ((isset($facebook_app_id)&&(strlen($facebook_app_id) != 0)) && (isset($facebook_app_secret)&&(strlen($facebook_app_secret) != 0)) && (isset($facebook_page_id)&&(strlen($facebook_page_id) != 0)) && (isset($facebook_username)&&(strlen($facebook_username) != 0))){ ?>
					<li>
						<a href="https://www.facebook.com/<?php echo esc_attr( $facebook_username ); ?>" class="facebook" <?php echo esc_attr( $target ); ?>>
							<i class="fab fa-facebook-f"></i>
							<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($likes)); ?></div>
							<span> <?php echo esc_html__('Like', 'wikilogy'); ?> </span>
						</a>
					</li>
				<?php } ?>
				<?php if (isset($youtube_username)&&(strlen($youtube_username) != 0)){ ?>
					<li>
						<a href="http://www.youtube.com/user/<?php echo esc_attr( $youtube_username ); ?>" class="youtube" <?php echo esc_attr( $target ); ?>>
						<i class="fab fa-youtube"></i>
						<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($subscriberCount)); ?></div>
						<span> <?php echo esc_html__('Like', 'wikilogy'); ?> </span>	
						</a>
					</li>
				<?php } ?>
				<?php if (isset($instagram_api)&&(strlen($instagram_api) != 0)){ ?>
					<li>
						<a href="<?php echo get_option('instagram_link'); ?>" class="instagram" <?php echo esc_attr( $target ); ?>>
							<i class="fab fa-instagram"></i>
							<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($instagram_count)); ?></div>
							<span> <?php echo esc_html__('Followers', 'wikilogy'); ?> </span>	
						</a>			
					</li>
				<?php } ?>
				<?php if (isset($vimeo_channel)&&(strlen($vimeo_channel) != 0)){ ?>
					<li>
						<a href="https://vimeo.com/channels/<?php echo esc_attr( $vimeo_channel ); ?>" class="vimeo" <?php echo esc_attr( $target ); ?>>
							<i class="fab fa-vimeo-v"></i>
							<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($total_subscribers)); ?></div>
							<span> <?php echo esc_html__('Subscribers', 'wikilogy'); ?> </span>	
						</a>			
					</li>
				<?php } ?>
				<?php if ((isset($google_username)&&(strlen($google_username) != 0)) && (isset($google_api_key)&&(strlen($google_api_key) != 0))) { ?>
					<li>
						<a href="https://plus.google.com/u/0/<?php echo esc_attr( $google_username ); ?>" class="google" <?php echo esc_attr( $target ); ?>>
							<i class="fab fa-google-plus-g"></i>
							<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($followers)); ?></div>
							<span> <?php echo esc_html__('Followers', 'wikilogy'); ?> </span>	
						</a>			
					</li>
				<?php } ?>
				<?php if (isset($twitter_id)&&(strlen($twitter_id) != 0)){ ?>
					<li>
						<a href="http://twitter.com/<?php echo esc_attr( $twitter_id ); ?>" class="twitter" <?php echo esc_attr( $target ); ?>>
							<i class="fab fa-twitter"></i>
							<div class="wikilogy-counter"><?php echo wikilogy_abreviateTotalCount(esc_attr($follow_count)); ?></div>
							<span> <?php echo esc_html__('Followers', 'wikilogy'); ?> </span>	
						</a>			
					</li>
				<?php } ?>
			</ul>
		</div>
		<?php 
		echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
			$instance[ 'target' ] = isset( $new_instance[ 'target' ] ) ? (bool) $new_instance[ 'target' ] : false;

			$instance['facebook_app_id'] = $new_instance['facebook_app_id'];
			$instance['facebook_app_secret'] = $new_instance['facebook_app_secret'];
			$instance['facebook_page_id'] = $new_instance['facebook_page_id'];
			$instance['facebook_username'] = $new_instance['facebook_username'];
			$instance['youtube_username'] = $new_instance['youtube_username'];
			$instance['vimeo_channel'] = $new_instance['vimeo_channel'];
			$instance['instagram_api'] = $new_instance['instagram_api'];
			$instance['google_username'] = $new_instance['google_username'];
			$instance['google_api_key'] = $new_instance['google_api_key'];
			$instance['twitter_id'] = $new_instance['twitter_id'];
			$instance['consumer_key'] = $new_instance['consumer_key'];
			$instance['consumer_secret'] = $new_instance['consumer_secret'];
			$instance['access_token'] = $new_instance['access_token'];
			$instance['access_token_secret'] = $new_instance['access_token_secret'];

			return $instance;
		}

		function form( $instance ) {

			$title = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
			$target = isset( $instance[ 'target' ] ) ? (bool) $instance[ 'target' ] : false;

			$facebook_app_id = isset( $instance[ 'facebook_app_id' ] ) ? esc_attr( $instance[ 'facebook_app_id' ] ) : '';
			$facebook_app_secret = isset( $instance[ 'facebook_app_secret' ] ) ? esc_attr( $instance[ 'facebook_app_secret' ] ) : '';
			$facebook_page_id = isset( $instance[ 'facebook_page_id' ] ) ? esc_attr( $instance[ 'facebook_page_id' ] ) : '';
			$facebook_username = isset( $instance[ 'facebook_username' ] ) ? esc_attr( $instance[ 'facebook_username' ] ) : '';
			$youtube_username = isset( $instance[ 'youtube_username' ] ) ? esc_attr( $instance[ 'youtube_username' ] ) : '';
			$vimeo_channel = isset( $instance[ 'vimeo_channel' ] ) ? esc_attr( $instance[ 'vimeo_channel' ] ) : '';
			$instagram_api = isset( $instance[ 'instagram_api' ] ) ? esc_attr( $instance[ 'instagram_api' ] ) : '';
			$google_username = isset( $instance[ 'google_username' ] ) ? esc_attr( $instance[ 'google_username' ] ) : '';
			$google_api_key = isset( $instance[ 'google_api_key' ] ) ? esc_attr( $instance[ 'google_api_key' ] ) : '';
			$twitter_id = isset( $instance[ 'twitter_id' ] ) ? esc_attr( $instance[ 'twitter_id' ] ) : '';
			$consumer_key = isset( $instance[ 'consumer_key' ] ) ? esc_attr( $instance[ 'consumer_key' ] ) : '';
			$consumer_secret = isset( $instance[ 'consumer_secret' ] ) ? esc_attr( $instance[ 'consumer_secret' ] ) : '';
			$access_token = isset( $instance[ 'access_token' ] ) ? esc_attr( $instance[ 'access_token' ] ) : '';
			$access_token_secret = isset( $instance[ 'access_token_secret' ] ) ? esc_attr( $instance[ 'access_token_secret' ] ) : '';

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
			</p>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $target ); ?> id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" />
				<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open social links in a new window/tab?', 'wikilogy' ); ?></label>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_app_id' ) ); ?>"><?php esc_html_e( 'Facebook App ID:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_app_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_app_id' ) ); ?>" value="<?php echo esc_attr( $facebook_app_id ); ?>">
				<i>Facebook Application ID, available <a target="_blank" href="https://developers.facebook.com/apps/">here</a></i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_app_secret' ) ); ?>"><?php esc_html_e( 'Facebook App Secret ID:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_app_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_app_secret' ) ); ?>" value="<?php echo esc_attr( $facebook_app_secret ); ?>">
				<i>Facebook Application Secret, available <a target="_blank" href="https://developers.facebook.com/apps/">here</a></i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_page_id' ) ); ?>"><?php esc_html_e( 'Facebook Profile ID:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_page_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_page_id' ) ); ?>" value="<?php echo esc_attr( $facebook_page_id ); ?>">
				 <i>Facebook Page ID, you can use <a target="_blank" href="http://findmyfbid.com/">this page</a> to find your id</i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_username' ) ); ?>"><?php esc_html_e( 'Facebook Username:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook_username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_username' ) ); ?>" value="<?php echo esc_attr( $facebook_username ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'youtube_username' ) ); ?>"><?php esc_html_e( 'YouTube Username:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube_username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_username' ) ); ?>" value="<?php echo esc_attr( $youtube_username ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'vimeo_channel' ) ); ?>"><?php esc_html_e( 'Vimeo Channel Name:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'vimeo_channel' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'vimeo_channel' ) ); ?>" value="<?php echo esc_attr( $vimeo_channel ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_api' ) ); ?>"><?php esc_html_e( 'Instagram Access Token Key:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram_api' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_api' ) ); ?>" value="<?php echo esc_attr( $instagram_api ); ?>">
				<i>Get Instagram Access Token <a target="_blank" href="http://jelled.com/instagram/access-token">here</a></i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'google_username' ) ); ?>"><?php esc_html_e( 'Google Username:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_username' ) ); ?>" value="<?php echo esc_attr( $google_username ); ?>">
				<i>Your Google+ Username with leading +,</i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'google_api_key' ) ); ?>"><?php esc_html_e( 'Google API Key:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'google_api_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'google_api_key' ) ); ?>" value="<?php echo esc_attr( $google_api_key ); ?>">
				<i>Visit <a target="_blank" href="https://console.developers.google.com/project">https://console.developers.google.com/project</a> using your Google account, click on the Create Project button and fill the form to create a project.</i>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>"><?php esc_html_e( 'Twitter Username:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_id' ) ); ?>" value="<?php echo esc_attr( $twitter_id ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>"><?php esc_html_e( 'Twitter Consumer Key:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_key' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_key' ) ); ?>" value="<?php echo esc_attr( $consumer_key ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>"><?php esc_html_e( 'Twitter Consumer Secret:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumer_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumer_secret' ) ); ?>" value="<?php echo esc_attr( $consumer_secret ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Twitter Access Token:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" value="<?php echo esc_attr( $access_token ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>"><?php esc_html_e( 'Twitter Access Secret:', 'wikilogy' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token_secret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token_secret' ) ); ?>" value="<?php echo esc_attr( $access_token_secret ); ?>">
			</p>

		<?php

	}
}
add_action( 'widgets_init', 'wikilogy_social_counter_widget' );

function wikilogy_social_counter_widget() {
	register_widget( 'wikilogy_social_counter' );
}



/*======
*
* Latest Posts Widget
*
======*/
function wikilogy_latest_posts_register_widgets() {
	register_widget( 'wikilogy_latest_posts_widget' );
}
add_action( 'widgets_init', 'wikilogy_latest_posts_register_widgets' );

class wikilogy_latest_posts_widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'wikilogy_latest_posts_widget',
			esc_html__( 'Wikilogy Theme: Latest Posts Widget', 'wikilogy' ),
			array( 'description' => esc_html__( 'Latest posts widget.', 'wikilogy' ), )
		);
	}
	
	function widget( $args, $instance ) {
		echo $args['before_widget'];

			$latest_posts_widget_title = esc_attr( $instance['latest_posts_widget_title'] );
			if ( !empty( $instance['latest_posts_widget_title'] ) ) {
				echo '<div class="widget-title">'. esc_attr( $latest_posts_widget_title ) .'</div>';
			}

			if( $instance) {
				$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
				$latest_posts_widget_category = strip_tags( esc_attr( $instance['latest_posts_widget_category'] ) );
				$latest_posts_widget_exclude = strip_tags( esc_attr( $instance['latest_posts_widget_exclude'] ) );
				$latest_posts_widget_offset = strip_tags( esc_attr( $instance['latest_posts_widget_offset'] ) );
				$latest_posts_widget_post_count = strip_tags( esc_attr( $instance['latest_posts_widget_post_count'] ) );
			}
			
			/*------------- Exclude Start -------------*/
			if( !empty( $latest_posts_widget_exclude ) ) :
				$latest_posts_widget_exclude = $latest_posts_widget_exclude;
				$latest_posts_widget_exclude = explode( ',', $latest_posts_widget_exclude );
			else:
				$latest_posts_widget_exclude = "";
			endif;
			/*------------- Exclude End -------------*/
			?>
			<?php wikilogy_widget_before(); ?>
				<div class="latest-posts-widget">
					<?php
						$args_latest_posts = array(
							'posts_per_page' => $latest_posts_widget_post_count,
							'post_status' => 'publish',
							'post__not_in' => $latest_posts_widget_exclude,
							'offset' => $latest_posts_widget_offset,
							'ignore_sticky_posts'	=> true,
							'post_type' => 'post',
							'cat' => $latest_posts_widget_category
						); 
						$wp_query = new WP_Query($args_latest_posts);
						while ( $wp_query->have_posts() ) {
							$wp_query->the_post();
							echo wikilogy_post_list_style_8( $post_id = get_the_ID(), $image = "true", $date = "true" );
						}
						wp_reset_postdata();
					?>
				</div>
			<?php wikilogy_widget_after(); ?>

		<?php echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latest_posts_widget_title'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_title'] ) );
		$instance['latest_posts_widget_category'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_category'] ) );
		$instance['latest_posts_widget_exclude'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_exclude'] ) );
		$instance['latest_posts_widget_offset'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_offset'] ) );
		$instance['latest_posts_widget_post_count'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_post_count'] ) );

		return $instance;
	}

	function form($instance) {

		$latest_posts_widget_title = '';
		$latest_posts_widget_category = '';
		$latest_posts_widget_exclude = '';
		$latest_posts_widget_offset = '';
		$latest_posts_widget_post_count = '';

		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$latest_posts_widget_category = strip_tags( esc_attr( $instance['latest_posts_widget_category'] ) );
			$latest_posts_widget_exclude = strip_tags( esc_attr( $instance['latest_posts_widget_exclude'] ) );
			$latest_posts_widget_offset = strip_tags( esc_attr( $instance['latest_posts_widget_offset'] ) );
			$latest_posts_widget_post_count = strip_tags( esc_attr( $instance['latest_posts_widget_post_count'] ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>"><?php esc_html_e( 'Widget Title:', 'wikilogy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ); ?>"><?php esc_html_e( 'Post Count:', 'wikilogy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_post_count' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_post_count ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_category' ) ); ?>"><?php esc_html_e( 'Category:', 'wikilogy' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('latest_posts_widget_category') ); ?>" id="<?php echo esc_attr( $this->get_field_id('latest_posts_widget_category') ); ?>" class="widefat"> 
				<option value=""><?php echo esc_html__( 'All Categories', 'wikilogy' ); ?></option>
				<?php
				 $categories = get_categories('child_of=0'); 
				 foreach ($categories as $category) {
					$category_select_control = '';
					if ( $latest_posts_widget_category == $category->cat_ID )
					{
						$category_select_control = "selected";
					}
					$cat_name = $category->cat_name;
					echo '<option value="' . esc_attr( $category->cat_ID ) . '"' . $category_select_control . '>';
						if( !empty( $cat_name ) ) {
							echo esc_attr( $cat_name );
						}
					echo '</option>';
				 }
				?>
			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ); ?>"><?php esc_html_e( 'Exclude Posts:', 'wikilogy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_exclude' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_exclude ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ); ?>"><?php esc_html_e( 'Offset:', 'wikilogy' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_offset' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_offset ); ?>" />
		</p>

	<?php }
}