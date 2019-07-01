<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'fsb_mbm' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'x^zSK:#X+m=h6^U-~qT!VMCwX}q#Zh/9xCj]t0*;@w( w|N,1Mzm,iGcvP2D^u[)' );
define( 'SECURE_AUTH_KEY',  '*Q~$}?R%K+Q]wg}<iyB0#(z9`c0S-CpVhg$_e{j-D]3 tT7a 3]dB/?PB&yd6f|s' );
define( 'LOGGED_IN_KEY',    'v+g3-Yp:/oD[`+Xvz:wiDy`[W3kdqrS?ZwZ*eSe/Kl Oi5Lvglv`Fs6lf).uhbCO' );
define( 'NONCE_KEY',        '|9j11poLpI,QU.(tjju#_:3KXwqc{JrD3H}1un0wH(7;cjVPMQlGp0(N`oM#OB.;' );
define( 'AUTH_SALT',        'Js19K$W*lWqXy@#^T/=>[LV;3D!TjB(,GPH1)#04Pd1rEM@AsM($Lli|i8*8L0Vb' );
define( 'SECURE_AUTH_SALT', '0jwCE%o}0Gruy;WnMvTx1Qo&r!i!wqf~OB4agk!)$4!N&`l<{mm/X> V[GxcVcW8' );
define( 'LOGGED_IN_SALT',   'WG]PTJwfpe2Q}V`!gAB>#:MK_/YK>CoXJfBYv{e8(2B]ymwmV/%.?<?te/B=3O?R' );
define( 'NONCE_SALT',       'UTFjGb~d?OWd6ok$-CE/E2UQ`UDHlOU1yf +?Zj}7)lXWD4v0)Gxv3VS{(i5vFi*' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
