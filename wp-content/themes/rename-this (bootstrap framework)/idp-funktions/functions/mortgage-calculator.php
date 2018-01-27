<?php

/*

Title: Mortgage Calculator

Version: 1.0

Last Updated: July 17, 2013

Description: Add shortcode [mortgage-calculator] to display a mortgage calculator on any page.

*/

//Version 1.0

if( !class_exists('MortCalc') ):

	class MortCalc{

		function MortCalc(){

			add_shortcode('mortgage-calculator', array($this, 'Output') );

			add_action('wp_footer', array($this, 'Scripts') );

		}

		

		function Output($atts){

			extract( shortcode_atts( array(

		'price' => '300,000',

	), $atts ) );

			$output .= "<div class='clearfix'></div><form id='MortCalc' class='form-horizontal'>";

			$output .= "
						<div class='form-group'>
							<label for='mortgage_amount' class='col-sm-4 control-label'>Mortgage Amount:</label>
							<div class='col-sm-8'>
								<div class='input-group'>
									<span class='input-group-addon'>$</span>
									<input type='text' name='mortgage_amount' class='form-control' id='mortgage_amount' value='".$price."' tabindex='1' />
								</div>
							</div>
						</div>
						
						<div class='form-group'>
							<label for='interest_rate' class='col-sm-4 control-label'>Interest Rate:</label>
							<div class='col-md-4'>
								<div class='input-group'>
									<input type='text' name='interest_rate' class='form-control' id='interest_rate'  value='2.5' tabindex='2' />
									<span class='input-group-addon'>%</span>
								</div>
								
							</div>
							<div class='col-md-4'>
								<a href='http://www.ratehub.ca/best-mortgage-rates' target='_blank' class='btn btn-small btn-default'>View Current Rates</a>
							</div>
						</div>
						
						<div class='form-group'>
							<label for='term' class='col-sm-4 control-label'>Ammortization:</label>
							<div class='col-sm-8'>
								<div class='input-group'>
									
									<input type='text' name='term' class='form-control' id='term' value='25' tabindex='3' />
									<span class='input-group-addon'>years</span>
								</div>
							</div>
						</div>
						<div class='form-group hidden'>
							<div class='col-sm-offset-4 col-sm-8'>
							  <button type='button' class='btn btn-default' name='update' tabindex='4'>Update</button>
							</div>
						  </div>
						

						<div class='form-group'>
							<label for='pmt' class='col-sm-4 control-label'>Monthly Payments:</label>
							<div class='col-sm-8  has-success'>
								<div class='input-group'>
									<span class='input-group-addon'>$</span>
									<input type='text' name='pmt' class='form-control' id='pmt' value='".$price."' disabled tabindex='5' />
								</div>
							</div>
						</div>

						<p><small>NOTE: This tool is provided for estimating purposes only and is not a guarantee of what your actual mortgage payments will be.  Please contact a Mortgage Specialist in your area for an accurate quote.</small></p>

						";

			$output .= "</form>";

			return $output;

		}

		

		function Scripts(){

			global $post;


			$output .= "<script type='text/javascript'>



function stripAlphaChars(pstrSource) 

{ 

var m_strOut = new String(pstrSource); 

    m_strOut = m_strOut.replace(/[^0-9.]/g, ''); 



    return m_strOut; 

}

function addCommas(nStr){

	nStr += '';

	x = nStr.split('.');

	x1 = x[0];

	x2 = x.length > 1 ? '.' + x[1] : '';

	var rgx = /(\d+)(\d{3})/;

	while (rgx.test(x1)) {

		x1 = x1.replace(rgx, '$1' + ',' + '$2');

	}

	return x1 + x2;

}

jQuery(document).ready(function($){

	

	function MortCalc(){

		var P = stripAlphaChars($('#mortgage_amount').attr('value'));

;

		var i = stripAlphaChars($('#interest_rate').attr('value'));

		var n = stripAlphaChars($('#term').attr('value'));



		var pif = Math.pow(Math.pow((1+((i/100)/2)),2),(1/12))-1; //Periodic Interest Factor (monthly)

		

		var ear = Math.pow((1+pif),12)-1; //Effective Annual Rate 

		var ear2 = Math.round(ear*Math.pow(10,4))/Math.pow(10,4); //(Round to 4 decimals)

		

		var m2a = n*12;//Months to Ammortization

		

		var ppm = Math.round((P*pif)/(1-Math.pow((1+pif),(-m2a)))); //Peroidic Payment (monthly)

	

		if( ppm ){

			ppm = addCommas(ppm.toFixed(2));

			$('#pmt').val(ppm);

		}	

	}

	

	$('input').change(function(){

		MortCalc();

	}).change();

	

	MortCalc();

});

			

			</script>";

			echo $output;

		

	}

		

		

	}

endif;



if( class_exists('MortCalc') )

	$MortCalc = new MortCalc();