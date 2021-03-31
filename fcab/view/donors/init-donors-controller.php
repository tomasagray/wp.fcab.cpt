<?php
namespace fcab\view\donors;

use fcab\view\Controller;
use fcab\view\PageTemplateloader;

// Create page controller & template loader
$controller = new DonorsPageController(new PageTemplateLoader());
add_action('init', [$controller, 'init']);
add_filter('do_parse_request', [$controller, 'dispatch'], PHP_INT_MAX, 2);
add_action(FCAB_DONOR_PAGES, function (Controller $controller) {
    $controller->addPage(new DonorsPage('/donations'))
        ->setTitle('Donations')
        ->setTemplate('donors/donors_page_template.php');
});
