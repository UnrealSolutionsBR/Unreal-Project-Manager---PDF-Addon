<?php
if (!defined('ABSPATH')) exit;

$project = get_post($post_id);
$client_id = get_post_meta($post_id, '_upm_client_id', true);
$client = get_user_by('ID', $client_id);

// Campos del proyecto
$start_date = get_post_meta($post_id, '_upm_start_date', true);
$due_date = get_post_meta($post_id, '_upm_due_date', true);
$amount = get_post_meta($post_id, '_upm_project_amount', true);
$objectives = get_post_meta($post_id, '_upm_objectives', true);
$scope = get_post_meta($post_id, '_upm_scope', true);
$tech = get_post_meta($post_id, '_upm_tech_requirements', true);
$project_type = get_post_meta($post_id, '_upm_project_type', true);
$contract_id = strtoupper('C_' . $post_id . '_' . date('Ymd'));
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Contrato <?= esc_html($contract_id) ?></title>
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
    .section {
      margin-bottom: 30px;
    }
    .section-title {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 10px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 4px;
    }
    ul {
      padding-left: 20px;
    }
    .footer {
      text-align: center;
      margin-top: 60px;
      font-size: 13px;
      color: #666;
    }
    .meta {
      margin-bottom: 20px;
    }
    .meta th {
      text-align: left;
      padding-right: 10px;
    }
  </style>
</head>
<body>

  <h1>Contrato de Servicio</h1>
  <p><strong>Código:</strong> <?= esc_html($contract_id) ?></p>

  <div class="meta">
    <table>
      <tr>
        <th>Cliente:</th>
        <td><?= esc_html($client->display_name) ?> (<?= esc_html($client->user_email) ?>)</td>
      </tr>
      <tr>
        <th>Proyecto:</th>
        <td><?= esc_html($project->post_title) ?></td>
      </tr>
      <tr>
        <th>Servicio:</th>
        <td><?= esc_html($project_type) ?></td>
      </tr>
      <tr>
        <th>Fecha de inicio:</th>
        <td><?= esc_html($start_date) ?></td>
      </tr>
      <tr>
        <th>Fecha de entrega:</th>
        <td><?= esc_html($due_date) ?></td>
      </tr>
      <tr>
        <th>Monto acordado:</th>
        <td>$<?= number_format((float) $amount, 2) ?> USD</td>
      </tr>
    </table>
  </div>

  <div class="section">
    <div class="section-title">Objetivos del Proyecto</div>
    <ul>
      <?php foreach (explode("\n", $objectives) as $line): ?>
        <?php if (trim($line)) echo '<li>' . esc_html(trim($line)) . '</li>'; ?>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="section">
    <div class="section-title">Alcance del Servicio</div>
    <ul>
      <?php foreach (explode("\n", $scope) as $line): ?>
        <?php if (trim($line)) echo '<li>' . esc_html(trim($line)) . '</li>'; ?>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="section">
    <div class="section-title">Requisitos Técnicos</div>
    <ul>
      <?php foreach (explode("\n", $tech) as $line): ?>
        <?php if (trim($line)) echo '<li>' . esc_html(trim($line)) . '</li>'; ?>
      <?php endforeach; ?>
    </ul>
  </div>

  <div class="footer">
    Este contrato fue generado automáticamente por Unreal Solutions.<br>
    Para más información visite <strong>unrealsolutions.com.br</strong>
  </div>

</body>
</html>
