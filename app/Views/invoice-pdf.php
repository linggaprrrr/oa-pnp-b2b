<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Receipt Smart Wholesale</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    table.desc {
      border: 1px solid; font-size: 9px;
    }

    table.desc th {
      border: 1px solid; font-size: 9px;
    }

    table.desc td {
      border: 1px solid; font-size: 9px;
    }

    table.desc {
      width: 100%;
      border-collapse: collapse;
    }

    .text-center {
      text-align: center;
    }

    table.data {
      width: 100%;
    }
    table.data td {
      font-size: 9px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="container mt-5">
    <h2></h2>
    <table class="data"> 
      
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="4"><img src="<?= $img ?>" style="width: 150px"></td>      
      </tr>
     
      <tr>
        <td colspan="2">Invoice No: <?= $invoice_no ?></td>     
        <td></td>  
        <td colspan="2"><h1>INVOICE</h1></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2" style="background-color: #cccccc;">BILL TO</td>     
        <td></td>  
        <td colspan="2" style="background-color: #cccccc;">DATE</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
   
      <tr>
        <td style="vertical-align: top;"><?= ucfirst($client) ?></td>
        <td style="vertical-align: top;"></td>
        <td></td>
        <td style="vertical-align: top;"><?= $date ?></td>
        <td style="text-align: right; vertical-align:top"></td> 
      </tr>
      
      
      
      
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <br>
    <table class="desc"> 
      <thead>
        <tr style="background-color: #0000FF;">
          <th><span style="color: white">Transaction Details</span></th>
          <th><span style="color: white">Descriptions</span></th>
          <th><span style="color: white">Qty</span></th>
          <th><span style="color: white">Unit</span></th>
          <th><span style="color: white">Price</span></th>
          <th><span style="color: white">Total Charged</span></th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td rowspan="3" style="text-align: center;">
                Prep Pricing
            </td>
            <td >
                Standard Unit Processing
            </td>
            <td class=" preview-unit" style="text-align: center;">
                <?= $data['unit'] ?>
            </td>
            <td >
                Items
            </td>
            <td class=" preview-unit-price" style="text-align: right;">
                $<?= $data['unit_price'] ?>
            </td>
            <td class=" preview-unit-charge" style="text-align: right;">
                $<?= ($data['unit'] * $data['unit_price']) ?>
            </td>
        </tr>
        <tr>     
            <td >
                Bundling/Multipacks/Kitting
            </td>
            <td class=" preview-bundling" style="text-align: center;">
              <?= $data['bundling'] ?>
            </td>
            <td >
                Bundle
            </td>
            <td class=" preview-bundling-price" style="text-align: right;">
            $<?= $data['bundling_price'] ?>
            </td>
            <td class=" preview-bundling-charge" style="text-align: right;">
            $<?= ($data['bundling'] * $data['bundling_price']) ?>
            </td>                                                                                               
        </tr>
        <tr>
            <td >
                New Boxes and Materials	
            </td>
            <td class=" preview-material-qty" style="text-align: center;" >
              <?= $data['material_qty'] ?>
            </td>
            <td class=" preview-material">
              <?= $data['material'] ?>
            </td>
            <td class=" preview-material-price" style="text-align: right;">
            $<?= $data['material_price'] ?>
            </td>
            <td class=" preview-material-charge" style="text-align: right;">
            $<?= ($data['material_qty'] * $data['material_price']) ?>
            </td>                                                                                                                                           
        </tr>
        <tr>
            <td style="text-align: center;">
                Storage
            </td>
            <td >
                Storage	
            </td>
            <td class=" preview-storage" style="text-align: center;">
              <?= $data['storage'] ?>
            </td>
            <td >
                Days
            </td>
            <td class=" preview-storage-price" style="text-align: right;">
            $<?= $data['storage_price'] ?>
            </td>
            <td class=" preview-storage-charge" style="text-align: right;">
            $<?= ($data['storage'] * $data['storage_price']) ?>
            </td>
        </tr>
        <tr>
            <td rowspan="3" style="text-align: center;">
                Wholesale		
            </td>
            <td >
                Receiving Pallets
            </td>
            <td class=" preview-receiving" style="text-align: center;">
                <?= $data['receiving_pallet'] ?>
            </td>
            <td >
                Pallets
            </td>
            <td class=" preview-receiving-price" style="text-align: right;">
            $<?= $data['receiving_pallet_price'] ?>
            </td>
            <td class=" preview-receiving-charge" style="text-align: right;">
            $<?= ($data['receiving_pallet'] * $data['receiving_pallet_price']) ?>
            </td>
        </tr>
        <tr>     
            <td >
                Unloading
            </td>
            <td class=" preview-unloading-qty" style="text-align: center;">
              <?= $data['unloading_qty'] ?>
            </td>
            <td class=" preview-unloading">
                <?= $data['unloading'] ?>
            </td>
            <td class=" preview-unloading-price" style="text-align: right;">
            $<?= $data['unloading_price'] ?>
            </td>
            <td class=" preview-unloading-charge" style="text-align: right;">
            $<?= ($data['unloading_qty'] * $data['unloading_price']) ?>
            </td>                                                                                               
        </tr>
        <tr>
            <td >
                Pallets	
            </td>
            <td class=" preview-pallet-qty" style="text-align: center;">
              <?= $data['pallet_qty'] ?>
            </td>
            <td class=" preview-pallet">
              <?= $data['pallet'] ?>
            </td>
            <td class=" preview-pallet-price" style="text-align: right;">
            $<?= $data['pallet_price'] ?>
            </td>
            <td class=" preview-pallet-charge" style="text-align: right;">
            $<?= ($data['pallet_qty'] * $data['pallet_price']) ?>
            </td>                                                                                                                                           
        </tr>
        <tr>
            <td class="" style="text-align: center;">
                Return
            </td>
            <td class="">
                Standard Unit Processing		
            </td>
            <td class=" preview-return" style="text-align: center;">
                <?= $data['return'] ?>
            </td>
            <td class=" ">
                Items
            </td>
            <td class=" preview-return-price" style="text-align: right;">
            $<?= $data['return_price'] ?>
            </td>
            <td class=" preview-return-charge" style="text-align: right;">
            $<?= ($data['return'] * $data['return_price']) ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: center;">
                Additional Charges		
            </td>
            <td class=" preview-add">
                <?= $data['additional'] ?>
            </td>
            <td class=" preview-add-qty" style="text-align: center;">
              <?= (empty($data['additional_qty']) ? '-' : $data['additional_qty']) ?>  
                </td>
            <td >
                Items
            </td>
            <td class=" preview-add-price" style="text-align: right;">
            $<?= (empty($data['additional_price']) ? '-' : $data['additional_price']) ?>
            </td>
            <td class=" preview-add-charge" style="text-align: right;">
            $<?= (empty($data['additional_price']) || empty($data['additional_qty'])) ? '-' : ($data['additional_qty'] * $data['additional_price']) ?>
            </td>                                                                                                                                           
        </tr>
        <tr>
            <td colspan="5" class="" style="text-align: center; font-weight: bold;">
                Total	
            </td>
            
            <td class=" preview-total" style="text-align: right; font-weight: bold;">
                $<?= number_format($data['total_amount'], 2) ?>
            </td>                                                                                                                                           
        </tr>        
    </tbody>
    </table>
    <p>We apperciate your association.</p>
  </div>
  <div>
    <table class="desc">
      <thead>
        <th style="width: 5%;">No.</th>
        <th style="width: 15%;">UPC</th>
        <th>Item Description</th>
        <th style="width: 7%;">Qty</th>
      </thead>
      <tbody>
        <?php $no = 1; $totalQty = 0;?>
        <?php foreach ($items->getResultObject() as $item) : ?>
          <?php if ($item->qty > 0) : ?>
            <tr>
              <td style="text-align: center;"><?= $no++ ?></td>
              <td><?= $item->asin ?></td>
              <td><?= $item->title ?></td>
              <td style="text-align: center;"><?= $item->qty ?></td>
            </tr>
            <?php $totalQty = $totalQty + $item->qty ?>
          <?php endif ?>
        <?php endforeach ?>
        <tr>
            <td colspan="3" class="" style="text-align: center; font-weight: bold;">
                Total	
            </td>
            
            <td class=" preview-total" style="text-align: center; font-weight: bold;">
                <?= $totalQty ?>
            </td>                                                                                                                                           
        </tr>    
      </tbody>
    </table>
  </div>
</body>
</html>