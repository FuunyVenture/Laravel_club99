<?php
/**
 * PnP.php
 *
 * Contains PnP class
 *
 * @package PnP
 */

/**
 * Implements the Plug N Pay API, as described in the API documentation
 * on plugnpay.com. See API documentation for more details, as well as
 * for methods that may not yet have been implemented here.
 *
 * Please be aware that the API exposed by this module is not firm yet.
 * In particular, functions that are not explicitly defined in the
 * documented PnP API might change somewhat over the next few weeks as I
 * try to figure out what is actually needed in this interface. Thanks
 * for your patience.
 *
 * @package PnP
 */

namespace App\PaymentGateways;


use Log;

class PnP {

    protected $apiurl = 'https://pay1.plugnpay.com/payment/pnpremote.cgi';
    protected $publisher_name     = 'websoftebu';
    protected $publisher_password = '21d0157d9a79d1ed';

    /**
     * Object constructor
     *
     * Get a new object, in order to make a payment:
     * <code>
     * $pnp = new PnP();
     * </code>
     *
     * or reopen a previous one, to query a payment
     * <code>
     * $pnp = new PnP( array( 'orderID' => '12345' ));
     * $status = $php->query_trans();
     * </code>
     *
     * @param array Object construction array. At present, only supports
     * creating an object with a set orderID.
     */
    function __construct( $args = array() ) {
        if ( isset( $args['orderID'] ) ) {
            $this->orderID = $args['orderID'];
        }
    }

    /*
    Section 1. Remote Auth

    Methods in this section are documented under 'Section 1. Remote Auth' in
    the official PnP API documentation. Most of these methods are not
    documented, because they rely on additional account options that we
    don't have on our account.
    */

    /**
     * Process a payment against the Plug n Pay payment gateway.
     *
     * <code>
     * $pnp = new PnP();
     * $response = $pnp->payment( $payment_values );
     * </code>
     *
     * Values expected to be in the payment array are:
     *
     * <code>
     * card-number
     * card-name
     * card-amount
     * card-exp
     * email
     * ship-name
     * address1
     * address2
     * city
     * state
     * zip
     * country
     * card-cvv (optional)
     * </code>
     *
     * Finally, the payment_values array may contain an array named
     * 'packages', containing the packages which were ordered:
     *
     * <code>
     * $packages = array( 1 => array( 'packages_id' => 1,
     *                                'final_price' => 2,
     *                                'quantity'    => 3,
     *                              )
     *                  )
     * </code>
     *
     * Return value will look like:
     *
     * <code>
     *  Array
     * (
     *     [FinalStatus] => fraud
     *     [IPaddress] => 192.168.1.153
     *     [MStatus] => badcard
     *     [User_Agent] =>
     *     [address1] => 1421 Main Street
     *     [auth_code] =>
     *     [auth_date] => 20080613
     *     [auth_msg] =>  Invalid Credit Card CVV2/CVC2 Number.|
     *     [authtype] => authonly
     *     [card_amount] => 0.02
     *     [card_name] => Homer Simpson
     *     [card_type] => MSTR
     *     [cc_cvv] => 000
     *     [city] => Springfield
     *     [convert] => underscores
     *     [currency] => usd
     *     [dontsndmail] => yes
     *     [easycart] => 1
     *     [email] =>
     *     [errdetails] => card-cvv|CVV invalid length.|
     *     [errlevel] => 1
     *     [ipaddress] => 192.168.1.153
     *     [merchant] => pnpusername
     *     [mode] => auth
     *     [orderID] => 121345678090645094
     *     [paymethod] => credit
     *     [publisher_email] => test@example.com
     *     [publisher_name] => pnpusername
     *     [resp_code] => P56
     *     [ship_name] => Homer Simpson
     *     [shipinfo] => 1
     *     [sresp] => E
     *     [state] => UT
     *     [success] => no
     *     [zip] => 40997
     *     [MErrMsg] => Invalid Credit Card CVV2/CVC2 Number.|
     *     [a] => b
     *
     * )
     * </code>
     *
     *
     * @param array $payment_array payment details.
     * @return StdClass Response array - example shown above.
     */
    function auth($args=array()){

        if ( !count($args)) {
            return array();
        }

        $post_vals = array(
            'publisher-name' => $this->publisher_name,
            'mode'           => 'auth',
            'ipaddress'      => $_SERVER['REMOTE_ADDR'],

            // Metainfo
            'convert'     => 'underscores',
            'easycart'    => '1',
            'shipinfo'    => '1',
            'authtype'    => 'authonly',
            'paymethod'   => 'credit',
            'dontsndmail' => 'yes',
        );

        $post_vals = array_merge( $post_vals, $args );

        // What packages were purchased?
        /*if ( isset( $args['packages'] )) {
            for($i = 0; $i < count($args['packages']); $i++){
                $j = $i + 1;
                $post_vals["item$j"]     = $args['packages'][$i]['packages_id'];
                $post_vals["cost$j"]     = $args['packages'][$i]['final_price'];
                $post_vals["quantity$j"] = $args['packages'][$i]['quantity'];
                $post_vals["description$j"] =
                    $all_packages[$args['packages'][$i]['packages_id']]['packages_name'];
            }
        }*/

        $return = $this->pnp_results( $post_vals );
       /* $this->orderID = $return->orderID;*/
        return $return;
    }

    /*
    Section 2. Remote Transaction Administration

    Methods in this section are documented under 'Section 2. Remote
    Transaction Administration' in the official PnP API documentation. We
    will probably want to implement everything in this section, but will do
    so as needed, rather than implementing everything up front. If we end up
    releasing this under an Open Source license, this would be a great place
    for other folks to contribute by implementing the methods that they are
    interested in.
    */

    /**
     * Cancels the most recent transaction operation of the given orderID.
     *
     * Mandatory argument 'card-amount', which must not exceed the amount of
     * the original transaction. You may wish to obtain that amount ahead of
     * time by calling $pnp->query_trans();
     * Optional argument 'notify-email', where email notification can be
     * sent for transaction problems.
     *
     * @param array Argument array
     * @return StdClass Return object
     */
    function void( $args = array()) {

        $args = array_merge( $args, array(
            'mode'               => 'void',
            'publisher-name'     => $this->publisher_name,
            'publisher-password' => $this->publisher_password,
            'orderID'            => $this->orderID,
            'txn-type'           => 'auth',
        ));

        return $this->pnp_results( $args );
    }

    /**
     * Do a new authorizaction, using information from a previous
     * authorization, so that you don't need to know the payment information
     * again.
     *
     * You may explicitly pass the prevorderid in the argument list, or you
     * may create a PnP object with the orderID of the previous transaction
     * - which ever is more convenient.
     *
     * <code>
     * $pnp = new PnP( array( 'orderID' => $prevorderID ));
     * $results = $pnp->authprev( array( 'card-amount' => '123.45' ));
     * $neworderid = $pnp->orderID;
     * <code>
     *
     * Or i f you prefer:
     *
     * <code>
     * $pnp = new PnP();
     * $results = $pnp->authprev( array( 'prevorderid' => $prevorderID,
     *                                   'card-amount' => '123.45' ));
     * $neworderid = $pnp->orderID;
     * </code>
     *
     * 'card-amount' is a required argument.
     *
     * 'reauthtype' is an optional argument.
     *
     * @param array Argument array
     * @return StdClass Return object
     */
    function authprev( $args = array() ) {
        // If an object already has an orderID, assume that's the
        // prevorderid, otherwise, require that one was passed in.
        if ( isset( $this->orderID ) ) {
            $prevorderid = $this->orderID;
        } elseif ( isset( $args['prevorderid'] ) ) {
            $prevorderid = $args['prevorderid'];
        } else {
            error_log( 'You must specify the previous orderID, either by creating a PnP object with that ID, or by explicitly passing it in the argument list. Please see the documentation.' );
            return false;
        }

        if ( !isset( $args['card-amount']) || $args['card-amount'] == 0 ) {
            error_log( 'card-amount is a required argument to authprev.' );
            return false;
        }

        $args = array_merge( $args, array(
            'mode'               => 'authprev',
            'prevorderid'        => $prevorderid,
            'publisher-name'     => $this->publisher_name,
            'publisher-password' => $this->publisher_password,
        ));

        return $this->pnp_results( $args );
    }

    /**
     * Query for the status of a completed transaction
     *
     * @param array Arguments. Can specify the 'startdate' if you wish.
     * @return StdClass Return object of response values, as per the documentation
     */
    function query_trans( $args = array() ) {

        if ( !isset( $args['startdate'] ) ) {
            $args['startdate'] = '19710101';
        }
        if ( !$this->orderID ) {
            error_log("Can't request transaction status without an orderID");
            return array();
        }

        $post_vals = array(
            'publisher-name'     => $this->publisher_name,
            'publisher-password' => $this->publisher_password,
            'mode'               => 'query_trans',
            'orderID'            => $this->orderID,
            'startdate'          => $args['startdate']
        );

        return $this->pnp_results( $post_vals );
    }

    /*
    Section 3. Remote Membership Administration

    Methods in this section impelent the section of the API documented as
    'Remote Membership Administration', which deals primarily with storing
    credit card information on the PnP database, and then scheduling
    payments to those accounts at a later date.
    */

    /**
     * List all active/expired profiles and related password info
     *
     * <code>
     * $pnp = new PnP();
     * $members = $pnp->list_members( array( 'status' => 'active' ) );
     * </code>
     *
     * Possible arguments are 'status' ('active', 'expired', or 'all') and
     * 'crypt' ('crypt', 'md5', or 'none')
     *
     * Return object contains 5 attributes: FinalStatus, auth-msg, MErrMsg,
     * TranCount, and members. TranCount contains the number of members.
     * members contains a StdClass object for each of those members. Each
     * member contains attributes username, password, enddate, and
     * purchaseid, and also an attribute 'key' which indicates the axxxxx
     * key where the original data appears in the return object.
     *
     * There will also be methods a00000 - axxxxx for numbers from 0 to
     * TranCount, which will return a url-encoded version of the member
     * data, which you can parse_str() and do with as you like.
     *
     * @param array Argument array, documented in example code
     * @return StdClass Object of return values, documented in example code
     */
    function list_members( $args = array( 'status' => 'all' ) ) {

        $args = array_merge( $args, array (
            'mode'               => 'list_members',
            'publisher-name'     => $this->publisher_name,
            'publisher-password' => $this->publisher_password
        ));

        $members = $this->pnp_results( $args );

        if ( isset( $members->TranCount )) {
            $count = $members->TranCount;

            for ( $c = 0; $c < $count; $c++ ) {
                $key = 'a' . sprintf('%05d', $c);
                parse_str( $members->$key, $m );
                $m['key'] = $key;
                $members->members[] = (object)$m;
            }
        }

        return $members;
    }

    /*
    Section 4. Remote Coupon Administration
    */

    /*
    Section 5. Mercury Payment GiftCard
    */

    /*
    The methods below here are helper functions and are not part of the
    documented Plug n Pay API.
    */

    /**
     * Description
     *
     * @param array HTTP Post values
     * @return StdClass Response values from the query
     */
    function pnp_results( $post_args = array() ) {
        if ( !count( $post_args) ) {
            return array();
        }

        $http_query = str_replace("&amp;", "&",
            ( http_build_query( $post_args ) ));

        // init curl handle
        $pnp_ch = curl_init( $this->apiurl );
        curl_setopt($pnp_ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($pnp_ch, CURLOPT_POSTFIELDS, $http_query );
        curl_setopt($pnp_ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // Upon problem, uncomment for additional Windows 2003 compatibility

        // perform post
        $response = curl_exec($pnp_ch);

        parse_str( $response, $results_array );
        /*Log::info($results_array);*/


        $results = (object) $results_array;
        return $results;
    }

    /**
     * Catch-all method which allows us to handle undocumented, or
     * not-yet-implemented API methods.
     *
     * <code>
     * $p = new PnP;
     * $return = $p->undocumented_method( $args );
     * </code>
     *
     * @param string Method to be called (handled automatically when called
     * as an object method).
     * @param array Argument array, if any
     * @return StdObj Return object
     */
    function __call( $method, $args) {

        $args = array_merge( $args, array (
            'mode'               => $method,
            'publisher-name'     => $this->publisher_name,
            'publisher-password' => $this->publisher_password
        ));

        $return = $this->pnp_results( $args );

        if ( $return->MErrMsg == 'Invalid Mode' ) {
            error_log( 'Invalid method ' . $method . ' called' );
        }

        return $return;
    }

}