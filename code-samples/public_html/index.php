<!doctype html>
<html lang="en">

<head>
<?php include(ROOTPATH . '/views/public/head.php'); ?>
<script type="text/javascript" src="/share/home.js"></script>
</head>

<body ng-app="Public">
<?php include(ROOTPATH . '/views/public/nav.php'); ?>

<div class="container" ng-controller="Home">
  <br><br>

  <div ng-if="featured_items.length">
    <h2 class="text-center">Featured Items</h2>

    <div class="row text-center">

      <div ng-repeat="item in featured_items">
        <div class="featured-item">
          <h3>{{item.description}}</h3>
          <p><img class="thumb thumb-lg" ng-src="/share/inventory_images/{{item.product_id}}"></p>
          <p><a class="btn btn-danger" href="/diamonds">View details »</a></p>
        </div>
      </div>

      <br><br>

    </div>
  </div>

  <!-- Jumbotron -->
  <div class="well text-center col-lg-8 col-lg-offset-2">
    <h1>Wholesale Diamonds</h1>
    <p class="lead">Give us a call!</p>
    <p><a class="btn btn-lg btn-primary" ng-href="tel:{{phonenumber}}"><span class="glyphicon glyphicon-earphone"></span> {{phonenumber}}</a></p>
  </div>

</div>
<?php include(ROOTPATH . '/views/public/foot.php'); ?>
</body>
</html>