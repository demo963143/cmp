<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>laundroklean</title>
	<style>
		.bill_section{
			padding-top: 5px;
		}
		
		.bill_section .content_area .logo{
			width:110px;
			margin: 0 auto;
		}
		.bill_section .content_area .logo img{
			width:100%;
			height:100%;
			object-fit: cover;
		}

		.bill_section .content_area .text_area{
			padding-top: 10px;
		} 

		.bill_section .content_area .text_area .txt{
			margin-bottom: 5px;
		}
		.bill_section .content_area .text_area .txt p{
			margin: 0;
			font-size: 15px;
			color: #000;
		}

		.bill_section .content_area .text_area .txt .date_time{
			font-size: 11px;
		}
		.bill_section .content_area .text_area .txt h5{
			color: #000;
			padding: 0;
			margin: 0;
			font-size: 16px;
			font-weight: 600;
		}
		.bill_section .content_area .text_area .qr_code{
			width:100%;
			height:60px;
		}
		.bill_section .content_area .text_area .qr_code img{
			height: 100%;
			width: 100%;
			object-fit: fill;
		}
		
		.bill_section .content_area .text_area .name{
			border-top:1px solid #333;
			border-bottom: 1px solid #333;
			padding-top: 5px;
			padding-bottom: 5px;
			margin-top: 10px;
			margin-bottom: 10px;
		}
		
		.bill_section .content_area .text_area .description p{
			font-size: 13px;
			color:#000;
			margin: 0;
			line-height: 16px;
		}
		
		.bill_section .content_area .text_area .img_area{
			border: 1px solid #333;
			padding: 2px;
			margin-bottom: 10px;
		}
		.bill_section .content_area .text_area .img_area .img_inner{
			display:flex;
			flex-wrap: wrap;
			gap:2px;
		}

		.bill_section .content_area .text_area .img_area .img_inner img{
			width: 24%;
			border: 1px dotted #000;
		}
		.bill_section .content_area .text_area .img_area .img_text p{
			font-size: 12px;
			line-height: 18px;
			font-weight: 600;
			color: #000;
			/* padding: 5px 0; */
			text-align: center;
			margin: 0;
		}
		.bill_section .content_area .text_area .barcode_img{
			width:100%;
			height:70px;
		}
		.bill_section .content_area .text_area .barcode_img img{
			height: 100%;
			width:100%;
			object-fit: fill;
		}

		
		.bill_section .content_area .text_area .footer .footer_title p{
			font-size: 26px;
			font-weight: 700;
			text-align: center;
			color: #000;
			margin: 0;
			line-height: 32px;
		}
		.bill_section .content_area .text_area .footer .footer_text{
			border: 1px solid #000;
			text-align: center;
			border-radius: 20px;
		}
		.bill_section .content_area .text_area .footer .footer_text{
			display:flex;
			align-items: center;
			justify-content: center;
		}
		.bill_section .content_area .text_area .footer .footer_text img{
			width:25px;
		}
		.bill_section .content_area .text_area .footer .footer_text p{
			font-size:16px;
			color:#000;
			font-weight: 600;
			margin: 0;
		}
		
		.bill_section .content_area .text_area{
		    margin-bottom:15px;
		}
    
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .ticket {
                width: 50%; /* Two QR codes per row */
                float: left;
                text-align: center;
                padding: 10px;
                box-sizing: border-box;
            }
            @page {
                size: A4;
                margin: 0; /* Remove default margins */
            }
        }

	</style>
  </head>
  
  <body>
      <button id="printButton" onclick="startPrinting()">Print BarCode</button>

    <section class="bill_section" style="">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-4 mx-auto" style="margin: 0 auto;">
				    <?php foreach ($sale_items as $item): 
                        $items = $item->qt;
                        for($i=1;$i<=$items;$i++):
                    ?>
					<div class="content_area ticket" style="border: 1px solid;padding:1px; width:250px;  text-align:center; margin:0 auto;">
						<div class="logo" style="height:0px; width:100%;">
							<!--<img src="<?=base_url()?>assets/images/black_logoy.png" alt="..." />-->
							<!--<img style="height:100%; width:100%; object-fit:contain;" src="<?= base_url('files/img/' . settings()->logo) ?>" alt="Company Logo" />-->
						</div>
						<div class="text_area">
							<div class="row">
								<div class="col-sm-8">
									<div class="txt">
									        <p style="margin-bottom:0px; font-size:16px; font-weight:600;">Order ID-<?=$sale->invoice_id?></p>
									        	<p style="margin:0; padding:0;"><b><?=$customer->firstname.' '.$customer->lastname?></b></p>
									    	<!--<div style="padding-bottom:0px; font-weight:600;" class="date_time"><?=date('d-M-Y')?></div>-->
									</div>
								</div>
							
							</div>

						

							<div class="img_area">
								<div class="img_inner" style="margin-top:0px; padding:0px;  width:96%; margin: 0 auto;"> 
								 <!--service name-->
								<?php
                                    $secondary_icons = json_decode($item->secondary_icons);
                                    if ($secondary_icons !== null) {
                                        $names_array = [];
                                        foreach ($secondary_icons as $icon_name) {
                                            $service = $this->db->where('icon', $icon_name)->get('services')->row();
                                            if ($service) {
                                                $names_array[] = $service->name; 
                                            } 
                                        }
                                        $names_string = implode(", ", $names_array);
                                    } else {
                                       $names_string = '';
                                    }
                                ?>
								<!--end service name-->      
								</div>
								<div class="img_text">
									<p style=" font-size:18px;font-weight:500;  padding:0; margin:0;"><?=$item->name?><br><?=$names_string?></p>
								</div>
							</div>
							
						
							 <p style="margin-bottom:0px; margin-top:0px;font-size:16px; font-weight:600;">Qty</p>
							 
							<div class="footer">
								<div class="footer_title">
								<p style="margin-bottom:0px;margin-top:0px; font-size:20px;"><?=$i?>/<?=$items?></p>
								</div>
							</div>
							
							  <div class="description" style="padding-top:0px;">
								<!--<p style="margin:0; padding:0;">Date of Delivery</p>-->
								<!--<p style="margin:0; padding:0;"><b><?=date('d.M.Y',strtotime($sale->delivery_date))?></b></p>-->
								<p style="margin:0; padding:0;"><b><?= date('d.M.Y') ?></b></p>
							</div>
							
						</div>
					</div>
					
					<?php endfor; endforeach; ?>
					
				</div>
			</div>
		</div>
	</section>
	
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
   
    
    <script>
    
      
        function startPrinting() {
                const tickets = document.querySelectorAll('.content_area.ticket');
                let index = 0;
            
                function printNextTicket() {
                    if (index < tickets.length) {
                        const ticket = tickets[index];
            
                        const printWindow = window.open('', '_blank');
                        
                        printWindow.document.open();
                        printWindow.document.write(`
                            <html>
                            <head>
                                <title>Print Barcode</title>
                                <style>
                                    body { font-family: Arial, sans-serif; text-align: center; }
                                    .content_area { width: 250px; margin: 0px; }
                                    .barcode_img img { width: 80%; height: auto; } /* Ensure barcode images load correctly */
                                </style>
                                <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"> <!-- Add your CSS file -->
                            </head>
                            <body>
                                ${ticket.outerHTML}  
                            </body>
                            </html>
                        `);
                        printWindow.document.close();
                        printWindow.focus();
            
                        // 500ms Wait Time to Ensure Images Load
                        setTimeout(() => {
                            printWindow.print();
                            printWindow.close();
            
                            index++;
                            setTimeout(printNextTicket, 500);
                        }, 500); 
                    } else {
                        alert("All Barcodes have been printed.");
                        window.location.href = "https://laundroklean.meshink.xyz/software/pos";
                    }
                }
            
                printNextTicket();
            }

       
        
        
    </script>
    
    
    
    
    
    
    
    
     
  </body>
  
</html>
