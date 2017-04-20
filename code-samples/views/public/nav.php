<?php
/**
 * Global navigation header for public html
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since November 18, 2014
 */
?>
    <div class="container" ng-controller="Nav">
      <div class="masthead">
        <header class="row">
          <div class="col-md-8 company-logo">
            <h1>
              <img src="/images/SDI.jpg">
              <span class="text-primary">Scottsdale Diamonds Inc.</span>
            </h1>
          </div>

          <div class="col-md-4 call-us">

            <h3>
              <small>Call Us!</small>
              <br>
              <span class="text-danger glyphicon glyphicon-earphone"></span> 
              <a ng-href="tel:{{phonenumber}}">{{phonenumber}}</a>
            </h3>

          </div>

        </header>

        <nav class="collapse navbar-collapse navbar-ex1-collapse">

          <ul class="nav nav-justified">
            <li ng-class="{'active': page == '/'}"><a href="/">Home</a></li>
            <li ng-class="{'active': page == '/diamonds'}"><a href="/diamonds">Diamonds</a></li>
            <li ng-class="{'active': page == '/about'}"><a href="/about">About</a></li>
          </ul>

        </nav><!-- collapse -->
      </div><!-- end masthead -->
    </div><!-- end container -->