<?php
if (!defined('ABSPATH')) exit;

// Asegurar que DomPDF reciba contenido limpio
$post = get_post($post_id);
$client_id = get_post_meta($post_id, '_upm_invoice_client_id', true);
$project_id = get_post_meta($post_id, '_upm_invoice_project_id', true);

$client = get_user_by('ID', $client_id);
$project = $project_id ? get_post($project_id) : null;

$amount = (float) get_post_meta($post_id, '_upm_invoice_amount', true);
$status = get_post_meta($post_id, '_upm_invoice_status', true);
$invoice_code = get_post_meta($post_id, '_upm_invoice_code', true);

$date = get_the_date('Y-m-d', $post);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Factura <?= esc_html($invoice_code) ?></title>
  <style>
    body {
      font-family: sans-serif;
      font-size: 14px;
      color: #333;
      padding: 40px;
    }
    h1, h2 {
      margin: 0 0 10px;
    }
    .header, .footer {
      text-align: center;
      margin-bottom: 30px;
    }
    .invoice-details {
      margin-bottom: 20px;
    }
    .invoice-details th {
      text-align: left;
      padding-right: 10px;
    }
    .box {
      border: 1px solid #ccc;
      padding: 20px;
      margin-top: 10px;
    }
    .total {
      font-size: 18px;
      font-weight: bold;
      margin-top: 20px;
    }
    .status {
      padding: 6px 12px;
      display: inline-block;
      border-radius: 4px;
      font-size: 13px;
      background: <?= $status === 'pagada' ? '#d1fae5' : '#fef9c3' ?>;
      color: <?= $status === 'pagada' ? '#065f46' : '#92400e' ?>;
    }
  </style>
</head>
<body>
  <div class="header">
    <h1>Factura</h1>
    <p><strong>Código:</strong> <?= esc_html($invoice_code) ?></p>
  </div>

  <table class="invoice-details">
    <tr>
      <th>Cliente:</th>
      <td><?= esc_html($client->display_name) ?> (<?= esc_html($client->user_email) ?>)</td>
    </tr>
    <?php if ($project): ?>
    <tr>
      <th>Proyecto:</th>
      <td><?= esc_html($project->post_title) ?></td>
    </tr>
    <?php endif; ?>
    <tr>
      <th>Fecha:</th>
      <td><?= esc_html($date) ?></td>
    </tr>
    <tr>
      <th>Estado:</th>
      <td><span class="status"><?= ucfirst($status) ?></span></td>
    </tr>
  </table>

  <div class="box">
    <p><strong>Descripción:</strong></p>
    <p><?= nl2br(esc_html($post->post_content)) ?: 'Pago correspondiente a servicio contratado.' ?></p>
  </div>

  <p class="total">Total a pagar: $<?= number_format($amount, 2) ?> USD</p>

  <div class="footer">
    <p>Gracias por confiar en Unreal Solutions</p>
  </div>
</body>
</html>
