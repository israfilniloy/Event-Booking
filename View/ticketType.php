<?php
session_start();
if (!isset($_SESSION['CustomerLoginstatus']) || $_SESSION['CustomerLoginstatus'] !== true) {
  header('location: login.php');
  exit();
} else {
  $EventID = $_SESSION["EventID"];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Types</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="stylesheet" href="../Asset/CSS/ticketType.css" />
  </head>
  <body>
    <div class="container">
      <button class="back-btn" onclick="goBack()">
        <i class="fas fa-arrow-left"></i>
      </button>
      <h1>Ticket Types</h1>
      <div class="tabs">
        <div class="tab active" onclick="showTab('grid')">Ticket Tier Grid</div>
        <div class="tab" onclick="showTab('comparison')">
          Package Comparison
        </div>
        <div class="tab" onclick="showTab('upsell')">Upsell Prompts</div>
      </div>

      <div id="grid" class="tab-content active">
        <h2>Ticket Tier Grid</h2>
        <div class="ticket-grid">
          <div class="ticket-card">
            <h3>Standard</h3>
            <div class="price">$99</div>
            <ul>
              <li>General Admission</li>
              <li>Access to Main Sessions</li>
              <li>Event Materials</li>
            </ul>
            <br />
            <button><a href="./setseclation.php">Select Standard</a></button>
          </div>
          <div class="ticket-card">
            <h3>VIP</h3>
            <div class="price">$249</div>
            <ul>
              <li>Priority Seating</li>
              <li>Access to VIP Lounge</li>
              <li>Exclusive Workshops</li>
              <li>Event Materials</li>
            </ul>
            <button><a href="./setseclation.php">Select VIP</a></button>
          </div>
          <div class="ticket-card">
            <h3>Group (5+)</h3>
            <div class="price">$79 each</div>
            <ul>
              <li>General Admission</li>
              <li>Access to Main Sessions</li>
              <li>Group Discount</li>
              <li>Event Materials</li>
            </ul>
            <button><a href="./setseclation.php">Select Group</a></button>
          </div>
        </div>
      </div>

      <div id="comparison" class="tab-content">
        <h2>Package Comparison</h2>
        <table>
          <thead>
            <tr>
              <th>Feature</th>
              <th>Standard ($99)</th>
              <th>VIP ($249)</th>
              <th>Group ($79 each)</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>General Admission</td>
              <td>✔</td>
              <td>✔</td>
              <td>✔</td>
            </tr>
            <tr>
              <td>Access to Main Sessions</td>
              <td>✔</td>
              <td>✔</td>
              <td>✔</td>
            </tr>
            <tr>
              <td>Event Materials</td>
              <td>✔</td>
              <td>✔</td>
              <td>✔</td>
            </tr>
            <tr>
              <td>Priority Seating</td>
              <td>-</td>
              <td>✔</td>
              <td>-</td>
            </tr>
            <tr>
              <td>VIP Lounge Access</td>
              <td>-</td>
              <td>✔</td>
              <td>-</td>
            </tr>
            <tr>
              <td>Exclusive Workshops</td>
              <td>-</td>
              <td>✔</td>
              <td>-</td>
            </tr>
            <tr>
              <td>Group Discount (5+)</td>
              <td>-</td>
              <td>-</td>
              <td>✔</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div id="upsell" class="tab-content">
        <h2>Upsell Prompts</h2>
        <div class="upsell-form">
          <div class="input-group">
            <label for="ticketType">Select Ticket Type</label>
            <select id="ticketType">
              <option value="">Choose Ticket Type</option>
              <option value="standard">Standard</option>
              <option value="vip">VIP</option>
              <option value="group">Group</option>
            </select>
          </div>
          <div class="input-group">
            <label for="upgrades">Add Upgrades</label>
            <select id="upgrades">
              <option value="">Select Upgrade</option>
              <option value="meet-greet">Meet & Greet ($50)</option>
              <option value="dinner">Gala Dinner ($75)</option>
              <option value="workshop">Additional Workshop ($30)</option>
            </select>
          </div>
          <div class="input-group">
            <label for="quantity">Quantity</label>
            <input
              type="number"
              id="quantity"
              min="1"
              value="1"
              placeholder="Enter quantity"
            />
          </div>
          <button>Add to Cart</button>
        </div>
      </div>
    </div>
    <script src="../Asset/js/ticketType.js"></script>
  </body>
</html>
