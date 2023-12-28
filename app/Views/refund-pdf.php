<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title></title>
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
        <td colspan="6" style="background-color: #0000FF; color: #0000FF">&nbsp</td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2"><h1>REFUND INVOICE</h1></td>
        <td colspan="3" rowspan="4" style="align-items: right; text-align:right"><img src="<?= $logo ?>" style="width: 150px"></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 11px;">Smart Wholesale</td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 11px;">464 NE 219th Ave</td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 11px;">Gresham, OR 97030</td>
        <td colspan="2"></td>
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
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>      
      <tr>
        <td colspan="6" style="background-color: #cccccc; color: #cccccc">&nbsp</td>             
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
        <td colspan="3" style="font-size: 11px;"><?= $user['name'] ?></td>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="3" style="font-size: 11px;"><?= $user['email'] ?></td>
        <td colspan="2"></td>
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
    <?php 
      $totalUnit = 0;
      $totalCost = 0;
    ?>
    <table class="desc"> 
      <thead>
        <tr style="background-color: #0000FF;">
            <th><span style="color: white">ASIN</span></th>
            <th><span style="color: white">ITEM DESCRIPTION</span></th>
            <th><span style="color: white">QTY</span></th>
            <th><span style="color: white">SHIPPING COST</span></th>          
        </tr>
      </thead>
      <tbody>
          <?php foreach($refundData as $row) : ?>
          <tr>
            <td class="text-center"><?= $row->asin ?></td>
            <td><?= $row->title ?></td>
            <td class="text-center"><?= $row->qty_returned ?></td>
            <td class="text-center">$<?= number_format($row->shipping_cost, 2) ?></td>
          </tr>
          <?php 
              $totalUnit = $totalUnit + $row->qty_returned;
              $totalCost = (is_null($row->shipping_cost) ? 0 : $row->shipping_cost) + $totalCost;
            ?>
          <?php endforeach ?>          
        </tr>
        <tr style="background-color: blue; color: white; ">           
          <td style="border-color: blue;"></td> 
          <td class="text-center" style="border-color: blue;">TOTAL</td>
          <td class="text-center" style="border-color: blue;"><?= $totalUnit ?></td>        
          <td class="text-center" style="border-color: blue;">$<?= number_format($totalCost, 2) ?></td>        
        </tr>
        
      </tbody>
    </table>
  </div>
</body>
</html>