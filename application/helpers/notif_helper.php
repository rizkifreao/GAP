<?php defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('success')) {
	function success($text) {
		$alert = "
		<script type='text/javascript'>
		$(document).ready(function(){
		 $.notify({
			icon:'done',
			message:'".$text."'},
			{type:'success',timer:3e3,placement:{from:'bottom',align:'right'}
			})
		})
		</script>
		";
		return $alert;
	}
}

if (! function_exists('error')) {
	function error($text) {
		$alert = "
		<script type='text/javascript'>
		$(document).ready(function(){
		 $.notify({
			icon:'close',
			message:'".$text."'},
			{type:'danger',timer:3e3,placement:{from:'bottom',align:'right'}
			})
		})
		</script>
		";

		return $alert;
	}
}
