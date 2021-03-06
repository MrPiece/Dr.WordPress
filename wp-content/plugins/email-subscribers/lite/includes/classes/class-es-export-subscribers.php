<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CSV Exporter bootstrap file
 */
class Export_Subscribers {

	/**
	 * Constructor
	 */
	public function __construct() {

		$report = ig_es_get_request_data( 'report' );
		$status = ig_es_get_request_data( 'status' );

		$can_access = ES_Common::ig_es_can_access( 'audience' );

		if ( $report && $status && $can_access ) {

			$status = trim( $status );

			$selected_list_id = 0;

			if ( 'select_list' === $status ) {
				$selected_list_id = ig_es_get_request_data( 'list_id', 0 );

				if ( 0 === $selected_list_id ) {
					$message = __( "Please Select List", "email-subscribers" );
					ES_Common::show_message( $message, 'error' );
					exit();
				}
			}

			$csv = $this->generate_csv( $status, $selected_list_id );

			$file_name = strtolower( $status ) . '-' . 'contacts.csv';

			if ( empty( $csv ) ) {
				$message = __( "No data available", 'email-subscribers' );
				ES_Common::show_message( $message, 'error' );
				exit();
			} else {
				header( "Pragma: public" );
				header( "Expires: 0" );
				header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
				header( "Cache-Control: private", false );
				header( "Content-Type: application/octet-stream" );
				header( "Content-Disposition: attachment; filename={$file_name};" );
				header( "Content-Transfer-Encoding: binary" );

				echo $csv;
				exit;
			}
		}

		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_action( 'parse_request', array( $this, 'parse_request' ) );
		add_action( 'admin_menu', array( $this, 'plugin_menu' ) );
	}

	public function plugin_menu() {
		add_submenu_page( null, 'Export Contacts', __( 'Export Contacts', 'email-subscribers' ), 'edit_posts', 'es_export_subscribers', array( $this, 'export_subscribers_page' ) );
	}

	public function prepare_header_footer_row() {

		?>

		<tr class="bg-gray-100 text-xs text-left leading-4 font-medium text-gray-500 uppercase tracking-wider border-b border-t border-gray-200 ">
			<th class="w-1/12 pl-8 py-4" scope="col"><?php _e( 'No.', 'email-subscribers' ); ?></th>
			<th class="w-2/12 pl-4 py-4" scope="col"><?php _e( 'Contacts', 'email-subscribers' ); ?></th>
			<th class="w-2/12 pl-8 py-4" scope="col"><?php _e( 'Total Contacts', 'email-subscribers' ); ?></th>
			<th class="w-2/12 pl-16 py-4" scope="col"><?php _e( 'Export', 'email-subscribers' ); ?></th>
		</tr>

		<?php
	}

	public function prepare_body() {

		$list_dropdown_html = "<select class='form-select sm:w-32 lg:w-40' name='list_id' id='ig_es_export_list_dropdown'>";
		$list_dropdown_html .= ES_Common::prepare_list_dropdown_options();
		$list_dropdown_html .= "</select>";

		$export_lists = array(

			'all'          => __( 'All Contacts', 'email-subscribers' ),
			'subscribed'   => __( 'Subscribed Contacts', 'email-subscribers' ),
			'unsubscribed' => __( 'Unsubscribed Contacts', 'email-subscribers' ),
			//'confirmed'    => __( 'Confirmed Contacts', 'email-subscribers' ),
			'unconfirmed'  => __( 'Unconfirmed Contacts', 'email-subscribers' ),
			'select_list'  => $list_dropdown_html
		);

		$i = 1;
		foreach ( $export_lists as $key => $export_list ) {
			/*$class = '';
			if ( $i % 2 === 0 ) {
				$class = 'alternate';
			}*/

			$url = "admin.php?page=download_report&report=users&status={$key}";

			?>

			<tr class="border-b text-sm font-normal text-gray-700 border-gray-200" id="ig_es_export_<?php echo $key; ?>">
				<td class="py-2 pl-10 w-1/12"><?php echo $i; ?></td>
				<td class="py-2 pl-4 w-2/12"><?php _e( $export_list, 'email-subscribers' ); ?></td>
				<td class="py-2 pl-8  w-2/12 font-medium ig_es_total_contacts"><?php echo $this->count_subscribers( $key ); ?></td>
				<td class="py-2 pl-8 w-2/12">
					<div class="inline-flex  pl-10"><a href="<?php echo $url; ?>" id="ig_es_export_link_<?php echo $key; ?>">
                		<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-indigo-600 hover:text-indigo-500 active:text-indigo-600"><path d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                		</svg>
                	</a>
                </div>
            </td>
        </tr>

        <?php
        $i ++;
    }

}

public function export_subscribers_page() {

	$audience_tab_main_navigation = array();
	$active_tab                   = 'export';
	$audience_tab_main_navigation = apply_filters( 'ig_es_audience_tab_main_navigation', $active_tab, $audience_tab_main_navigation );

	?>
	
	<div class="wrap ml-4">
		<header class="wp-heading-inline">
			<div class="mt-2">
				<h2 class="text-2xl font-medium text-gray-900 sm:leading-9 sm:truncate">
					<span class="text-base font-normal leading-7 text-indigo-600 sm:leading-9 sm:truncate"> <a href="admin.php?page=es_subscribers"><?php _e( 'Audience', 'email-subscribers' ); ?> </a> </span> <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4 mt-1 inline-block align-middle"><path d="M9 5l7 7-7 7"></path></svg> <?php _e('Export Contacts', 'email-subscribers'); ?> 
					<?php
					ES_Common::prepare_main_header_navigation( $audience_tab_main_navigation );
					?>
				</div>
			</h2>

		</header>
		<div><hr class="wp-header-end"></div>
		<div class="mt-6 shadow-lg rounded-md  overflow-hidden">
			<form name="frm_es_subscriberexport" method="post">
				<table class="min-w-full" id="straymanage">
					<thead>
						<?php $this->prepare_header_footer_row(); ?>
					</thead>
					<tbody class="bg-white">
						<?php $this->prepare_body(); ?>
					</tbody>
					<tfoot>
						<?php $this->prepare_header_footer_row(); ?>
					</tfoot>
				</table>
			</form>
		</div>
	</div>
<?php }


	/**
	 * @param string $status
	 *
	 * @return string|null
	 */
	public function count_subscribers( $status = 'all' ) {

		global $wpdb;

		switch ( $status ) {
			case 'all':
			return ES()->lists_contacts_db->get_all_contacts_count( 0, false );
			break;

			case 'subscribed':
			return ES()->lists_contacts_db->get_subscribed_contacts_count( 0, false );
			break;

			case 'unsubscribed':
			return ES()->lists_contacts_db->get_unsubscribed_contacts_count( 0, false );
			break;

			case 'confirmed':
			return ES()->lists_contacts_db->get_confirmed_contacts_count( 0, false );
			break;

			case 'unconfirmed':
			return ES()->lists_contacts_db->get_unconfirmed_contacts_count( 0, false );
			break;

			case 'select_list':
			default:
			return '-';
			break;
		}

	}


	/**
	 * Allow for custom query variables
	 */
	public function query_vars( $query_vars ) {
		$query_vars[] = 'download_report';

		return $query_vars;
	}

	/**
	 * Parse the request
	 */
	public function parse_request( &$wp ) {
		if ( array_key_exists( 'download_report', $wp->query_vars ) ) {
			$this->download_report();
			exit;
		}
	}

	/**
	 * Download report
	 */
	public function download_report() {
		?>

		<div class="wrap">
			<div id="icon-tools" class="icon32"></div>
			<h2>Download Report</h2>
			<p>
				<a href="?page=download_report&report=users"><?php _e( 'Export the Subscribers', 'email-subscribers' ); ?></a>
			</p>

			<?php
		}

	/**
	 * Generate CSV
	 * first_name, last_name, email, status, list, subscribed_at, unsubscribed_at
	 *
	 * @param string $status
	 * @param string $list_id
	 *
	 * @return string
	 */
	public function generate_csv( $status = 'all', $list_id = 0 ) {

		global $wpdb;

		ini_set( 'memory_limit', IG_MAX_MEMORY_LIMIT );
		set_time_limit( IG_SET_TIME_LIMIT );

		$email_subscribe_table = IG_CONTACTS_TABLE;

		$results = array();
		if ( 'all' === $status ) {
			$results = ES()->lists_contacts_db->get_all_contacts();
		} elseif ( 'subscribed' === $status ) {
			$results = ES()->lists_contacts_db->get_all_subscribed_contacts();
		} elseif ( 'unsubscribed' === $status ) {
			$results = ES()->lists_contacts_db->get_all_unsubscribed_contacts();
		} elseif ( 'confirmed' === $status ) {
			$results = ES()->lists_contacts_db->get_all_confirmed_contacts();
		} elseif ( 'unconfirmed' === $status ) {
			$results = ES()->lists_contacts_db->get_all_unconfirmed_contacts();
		} elseif ( 'select_list' === $status ) {
			$list_id = absint( $list_id );
			$results = ES()->lists_contacts_db->get_all_contacts_from_list( $list_id );
		}

		$subscribers = array();

		if ( count( $results ) > 0 ) {
			$contact_list_map = array();
			$contact_ids      = array();
			foreach ( $results as $result ) {

				if ( ! in_array( $result['contact_id'], $contact_ids ) ) {
					$contact_ids[] = $result['contact_id'];
				}

				$contact_list_map[ $result['contact_id'] ][] = array(
					'status'     => $result['status'],
					'list_id'    => $result['list_id'],
					'optin_type' => $result['optin_type']
				);
			}

			$contact_ids_str = "'" . implode( "' , '", $contact_ids ) . "' ";

			$query = "SELECT `id`, `first_name`, `last_name`, `email`, `created_at` FROM {$email_subscribe_table} WHERE id IN ({$contact_ids_str})";

			$subscribers = $wpdb->get_results( $query, ARRAY_A );
		}

		$csv_output = '';
		if ( count( $subscribers ) > 0 ) {

			$headers = array(
				__( 'First Name', 'email-subscribers' ),
				__( 'Last Name', 'email-subscribers' ),
				__( 'Email', 'email-subscribers' ),
				__( 'List', 'email-subscribers' ),
				__( 'Status', 'email-subscribers' ),
				__( 'Opt-In Type', 'email-subscribers' ),
				__( 'Created On', 'email-subscribers' )
			);

			$lists_id_name_map = ES()->lists_db->get_list_id_name_map();
			$csv_output        .= implode( ',', $headers );

			foreach ( $subscribers as $key => $subscriber ) {

				$data['first_name'] = trim( str_replace( '"', '""', $subscriber['first_name'] ) );
				$data['last_name']  = trim( str_replace( '"', '""', $subscriber['last_name'] ) );
				$data['email']      = trim( str_replace( '"', '""', $subscriber['email'] ) );

				$contact_id = $subscriber['id'];
				if ( ! empty( $contact_list_map[ $contact_id ] ) ) {
					foreach ( $contact_list_map[ $contact_id ] as $list_details ) {
						$data['list']       = $lists_id_name_map[ $list_details['list_id'] ];
						$data['status']     = ucfirst( $list_details['status'] );
						$data['optin_type'] = ( $list_details['optin_type'] == 1 ) ? 'Single Opt-In' : 'Double Opt-In';
						$data['created_at'] = $subscriber['created_at'];
						$csv_output         .= "\n";
						$csv_output         .= '"' . implode( '","', $data ) . '"';
					}
				}
			}
		}

		return $csv_output;
	}

}

