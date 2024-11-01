<?php
/**
 * Plugin Name: Tieq Viet
 * Plugin URI: https://wordpress.org/plugins/tieq-viet/
 * Description: The tool of converting into Vietnamsese uses the thanhtaivtt's library.
 * Version: 1.0.0
 * Author: Tuấn Anh
 * Author URI: https://wordpress.org
 * Requires at least: 4.4
 * Tested up to: 4.8
 *
 * Text Domain: tieq-viet
 * Domain Path: /languages/
 */


if ( !defined( 'ABSPATH' ) ) {
    exit;
}

define( 'TIEQ_VIET_DIR', dirname( __FILE__) );
define( 'TIEQ_VIET_ASSEST', plugins_url( '', __FILE__ ) );

if( ! class_exists('Tieg_Viet') ) {

	class Tieg_Viet{

	    /**
	     * @var null
	     *
	     * @since 0.0.1
	     */
	    private static $instance = null;

	    /**
	     * Get instance.
	     *
	     * @since 0.0.1
	     *
	     * @return null|NBT_Envato_API
	     */
	    public static function instance() {
	        if ( ! self::$instance ) {
	            self::$instance = new self();
	        }

	        return self::$instance;
	    }


	    /**
	     * Tieg_Viet constructor.
	     *
	     * @since 0.0.1
	     */
	    private function __construct() {
	    	add_shortcode( 'tieq_viet', array( $this, 'add_shortcode_tieq_viet') );
	    	add_action('wp_enqueue_scripts', array($this, 'embed_style'));

	    }

	    public function add_shortcode_tieq_viet() {
	    	wp_enqueue_script( 'tieq-viet' );

	    	?>
	    	<style type="text/css">
			    #inputtext {
			        margin-top: 50px;
			        display: block;
			        resize: none;
			        width: 100%;
			        box-sizing: border-box;
			    }

			    #restext {
			        background-color: #dddddd;
			        min-height: 150px;
			        margin: 10px 0;
			        box-sizing: border-box;
			        padding: 10px;
			    }
			    h6.tieqviet-result {
			    	padding-top: 0;
			    	margin-bottom: 0;
    				margin-top: 10px;
			    }
	    	</style>
			<textarea name="input" id="inputtext" cols="50" rows="10" autofocus="" placeholder="Nhập vào đoạn văn bạn muốn chuyển đổi">Phận sao phận bạc như vôi
Đã đành nước chảy hoa trôi lỡ làng
Ôi Kim Lang! Hỡi Kim Lang!
Thôi thôi thiếp đã phụ chàng từ đây!</textarea>
			<h6 class="tieqviet-result">Kết Quả</h6>
			<pre id="restext">Fận sao fận bạk n'ư vôi
Dã dàn' nướk cảy hoa kôi lỡ làq
Ôi Kim Laq! Hỡi Kim Laq!
Wôi wôi wiếp dã fụ càq từ dây!</pre>
		    <script type="text/javascript">
		    var input = document.getElementById('inputtext');
		    input.addEventListener('keyup', function() {
		        document.getElementById('restext').innerText = build(input.value);
		    });
		    </script>
			<?php
	    }

	    public function embed_style() {
	    	wp_register_script( 'tieq-viet', TIEQ_VIET_ASSEST .'/tieqviet.min.js' , '', '', true );
	    }
	}
	/**
	* Load plugin for Tieq Viet
	*
	* @since 2.5.3
	*
	* @return void
	**/
	add_action( 'plugins_loaded', array( 'Tieg_Viet', 'instance' ) );
}