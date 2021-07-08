<?php
include('../../config/config.php');

 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'applications_tbl';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

 // <th>Action</th>
 //                      <th>Fullname</th>
 //                      <th>Profile Image Path(Front)</th>
 //                      <th>Profile Image Path(Back)</th>
 //                      <th>DOB</th>
 //                      <th>State</th>
 //                      <th>Address</th>
 //                      <th>Zip</th>
 //                      <th>Gender</th>
 //                      <th>Driver's License</th>
 //                      <th>Weight</th>
 //                      <th>Current Job</th>
 //                      <th>Phone</th>
 //                      <th>Email</th>
 //                      <th>SSN</th>
 //                      <th>Age</th>
 //                      <th>Agree to Terms and Conditions?</th>
 //                      <th>Credit Score</th>
 //                      <th>Date Created</th>


$columns = array(
    // array( 'db' => 'unique_id', 'dt' => 0 ),
    array( 'db' => 'fullname', 'dt' => 0 ),
    array( 'db' => 'profile_front_path',  'dt' => 1 ),
    array(
        'db'        => 'profile_front_path',
        'dt'        => 1,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return '<a href="'.IMG_PATH.$d.'">'.$d.'</a>';
        }
    ),
     array(
        'db'        => 'profile_back_path',
        'dt'        => 2,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return '<a href="'.IMG_PATH.$d.'">'.$d.'</a>';
        }
    ),
    array(
        'db'        => 'dob',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return date( 'd F Y h:i:s a', strtotime($d));
        }
    ),
    array( 'db' => 'state',     'dt' => 4 ),
    array( 'db' => 'address',     'dt' => 5 ),
    array( 'db' => 'zip',     'dt' => 6 ),
    array( 'db' => 'gender',     'dt' => 7 ),
    array( 'db' => 'driver_license',  'dt' => 8 ),
    array( 'db' => 'weight',     'dt' => 9 ),
    array( 'db' => 'current_job',     'dt' => 10 ),
    array( 'db' => 'phone',     'dt' => 11 ),
    array( 'db' => 'email',     'dt' => 12 ),
    array( 'db' => 'ssn',     'dt' => 13 ),
    array( 'db' => 'age',     'dt' => 14 ),
    array( 'db' => 'city',     'dt' => 15 ),
    array( 'db' => 'agree_to_tnc',     'dt' => 16 ),
    array( 'db' => 'credit_score',     'dt' => 17 ),
    array(
        'db'        => 'date_created',
        'dt'        => 18,
        'formatter' => function( $d, $row ) {
            // return date( 'jS M y', strtotime($d));
            return date( 'd F Y h:i:s a', strtotime($d));
        }
    )

);
 
// SQL server connection information
$sql_details = array(
    'user' => USER,
    'pass' => PASSWORD,
    'db'   => DB_NAME,
    'host' => HOST
);
 
// $sql_details = array(
//     'user' => 'root',
//     'pass' => '',
//     'db'   => 'applications_db',
//     'host' => 'localhost'
// );
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);