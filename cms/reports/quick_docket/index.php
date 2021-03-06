<?php

/**********************************/
/* Pika CMS (C) 2007 Aaron Worley */
/* http://pikasoftware.com        */
/**********************************/


chdir('../../');

require_once('pika-danio.php'); 
pika_init();
require_once('pikaTempLib.php');

$report_title = "Quick Docket Report";
$report_name = "quick_docket";

$base_url = pl_settings_get('base_url');
if(!pika_report_authorize($report_name)) {
	$main_html = array();
	$main_html['base_url'] = $base_url;
	$main_html['page_title'] = $report_title;
	$main_html['nav'] = "<a href=\"{$base_url}/\">Pika Home</a>
    				  &gt; <a href=\"{$base_url}/reports/\">Reports</a> 
    				  &gt; $report_title";
	$main_html['content'] = "You are not authorized to run this report";

	$default_template = new pikaTempLib('templates/default.html', $main_html);
	$buffer = $default_template->draw();
	pika_exit($buffer);
}



$a = array();
$a['report_name'] = $report_name;

$main_html = array();
$main_html['base_url'] = $base_url;
$main_html['page_title'] = $report_title;
$main_html['nav'] = "<a href=\"{$base_url}/\">Pika Home</a>
      &gt; <a href=\"{$base_url}/reports/\">Reports</a> &gt; $report_title";
$template = new pikaTempLib("reports/{$report_name}/form.html", $a);
$main_html['content'] = $template->draw();


$default_template = new pikaTempLib('templates/default.html', $main_html);
$buffer = $default_template->draw();
pika_exit($buffer);


?>
