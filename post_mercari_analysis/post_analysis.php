<?php
/*
Plugin Name: Post Mercari Analysis
Plugin URI: 
Description: Show the analysis graph made from data base
Version: 1.0.0
Author:katomanz
Author URI: http://example.com
License: GPL2
*/
?>
<?php
/*  Copyright 2019 katomanz (email : kittokatto8083@gmail.com)
 
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
     published by the Free Software Foundation.
 
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
function oxy_hello_world() {
     global $wpdb;
     $table_name = "wp_merukari_sales_data";
     $table_search = $wpdb->get_results("SELECT * FROM {$table_name} LIMIT 10");
     var_dump($table_search);
     return $table_name;
}
?>

