<?php
	$this->load->view('includes/head');
	$this->load->view($login); 
	$this->load->view($search);
	$this->load->view('includes/header.php');
	$this->load->view($navigation);
	$this->load->view('includes/left_sidebar');
	$this->load->view($content);
	$this->load->view('includes/right_sidebar');
	$this->load->view($footer);
?>