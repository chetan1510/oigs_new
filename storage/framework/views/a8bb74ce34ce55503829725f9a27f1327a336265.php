<html>
<head>
	<title>Large Reort</title>
  <?php $version = "1.0.2"; ?>
	<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/fonts.css')); ?>">
        
	<style>

		body {margin: 0;}
		@media  print {
			#print {
				display: none;
			}
		}

		@page  { size: 210mm 297mm landscape;}
		.box{
			position: relative;
			display: inline-block; 
		}
		.box .text{
			line-height: 41px;
			position: absolute;
			z-index: 999;
			left: 20px;
			top: 23%;
			width: 100%;
		}
		.heading{
			text-align: left;
			color: black !important;
			-webkit-print-color-adjust: exact;
		}

		.headings{
			text-align: left;
			color: #151592 !important;
			-webkit-print-color-adjust: exact;

		}
		.containers{
			padding-left: 50px;
			padding-right: 50px;
		}

		@media  print{@page  {size: landscape}}
		. text-center{
			text-align: center;
			font-weight: 900;
		}

		table tr{
			line-height: 200%;
		}
		
	</style>
</head>

<body style="background-color:#FFFFFF">
		<div class="containers">
			<div class="row box">
				<img src="<?php echo e(url('/uploads/Front/L1.jpg')); ?>" class="img-responsive" style=" height: 208mm; width: 100%; margin: 0; padding: 0;" >
				<div class=" text">
					<table width="100%">
						<tbody>
							<tr>
								<td width="55%">
									<table width="100%">
										<tbody>
											<tr>
												<th class="heading">Report No. </th>
												<th class="headings">210907G8</th>
											</tr>

											<tr>
												<th class="heading">Weight</th>
												<th class="headings">9.75&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cts</th>
											</tr>

											<tr>
												<th class="heading">Measurement</th>
												<th class="headings">13.36 x 11.03 x 7.68 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; MM</th>
											</tr>

											<tr>
												<th class="heading">Color</th>
												<th class="headings">Yellow</th>
											</tr>

											<tr>
												<th class="heading">Shape & Cut</th>
												<th class="headings">Oval Mix</th>
											</tr>

											<tr>
												<th class="heading">Optic Character</th>
												<th class="headings">Uniaxial/-</th>
											</tr>

											<tr>
												<th class="heading">Axial Fig</th>
												<th class="headings">DR</th>
											</tr>

											<tr>
												<th class="heading">Refractive Index</th>
												<th class="headings">1.76-1.77</th>
											</tr>

											<tr>
												<th class="heading">Birefringence</th>
												<th class="headings"> 0.008 - 0.009</th>
											</tr>

											<tr>
												<th class="heading">Specific Gravity</th>
												<th class="headings">4.0</th>
											</tr>

											<tr>
												<th class="heading">Hardness (Mohs Scale)</th>
												<th class="headings">9</th>
											</tr>

											<tr>
												<th class="heading">Crystal System</th>
												<th class="headings">Trigonal</th>
											</tr>

											<tr>
												<th class="heading">Species</th>
												<th class="headings">Corundum</th>
											</tr>     										
										</tbody>
									</table>
								</td>
								<td width="45%">
									<table width="100%">
										<tbody>

											<tr>
												<th class=" text-center">07-Sep-2021</th>
												<th></th>
											</tr>

											<tr>
												<th width="50%" class="text-center">
													<img style=" width: 100px;border-style: solid;border-width: 5px;height: 120px;width: 120px;border-color: black;" src="product/gems/8.JPG" >
												</th>

												<th width="50%"><img src='images/63d92c281f1ac.png' class='qr'>
													1
												</th>
											</tr>

											<tr>
												<th class="text-center">Aslomal Vijay Kumar</th>
											</tr>

											<tr>
												<th class="heading">Micro. obs.</th>
												<th class="headings">Finger Prints Observed</th>
											</tr>

											<tr>
												<th class="heading">Comments</th>
												<th class="headings">Ceylonese Yellow Sapphire (Pukhraaj)</th>
											</tr>

											<tr>
												<th class="heading">OIGS Quality Index</th>
												<th class="headings">Very Good</th>
											</tr>

											<tr>
												<th class="headings" colspan="2" style="font-size: 16px;font-weight: bold;  padding-top: 45px;">Natural Yellow Sapphire
												</th>
												<th></th>
											</tr>

										</tbody>
									</table>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
</body>
</html>
<?php /**PATH /Applications/MAMP/htdocs/oigs_new/resources/views/gems/large.blade.php ENDPATH**/ ?>