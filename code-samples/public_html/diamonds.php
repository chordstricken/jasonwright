<?php
/**
 * This file is responsible for displaying the /diamonds page html
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 21, 2014
 * @copyright Scottsdale Diamonds, Inc
 */
?>
<!doctype html>
<html lang="en">

<head>
<?php include(ROOTPATH . '/views/public/head.php'); ?>
<script type="text/javascript" src="/share/diamonds.js"></script>
</head>

<body ng-app="Public">
<?php include(ROOTPATH . '/views/public/nav.php'); ?>

<div class="container" ng-controller="Diamonds">

    <div id="diamond-filter-options" class="container">

        <br>

        <div class="row">
            <div class="filter-search input-group input-group-lg col-md-10">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search"></span>
                </span>
                <input type="text" class="form-control" name="search" placeholder="Search by Color, Clarity, and/or Fluorescence" ng-model="query.search_text" ng-keypress="load_table()">
            </div>

            <a href="#" class="col-md-2" ng-click="filter.toggle()">
                <h4>Advanced</h4>
            </a>
        </div>

        <br>

        <div id="filter-advanced" style="display: none;">

            <div class="row">

                <br>

                <!-- Color -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Color</h4>

                    <div class="btn-group btn-radio-group">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.D}" ng-click="query.color.D = query.color.D ? undefined : 'D'; load_table();">D</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.E}" ng-click="query.color.E = query.color.E ? undefined : 'E'; load_table();">E</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.F}" ng-click="query.color.F = query.color.F ? undefined : 'F'; load_table();">F</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.G}" ng-click="query.color.G = query.color.G ? undefined : 'G'; load_table();">G</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.H}" ng-click="query.color.H = query.color.H ? undefined : 'H'; load_table();">H</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.I}" ng-click="query.color.I = query.color.I ? undefined : 'I'; load_table();">I</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.J}" ng-click="query.color.J = query.color.J ? undefined : 'J'; load_table();">J</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.K}" ng-click="query.color.K = query.color.K ? undefined : 'K'; load_table();">K</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.L}" ng-click="query.color.L = query.color.L ? undefined : 'L'; load_table();">L</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.M}" ng-click="query.color.M = query.color.M ? undefined : 'M'; load_table();">M</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.color.N}" ng-click="query.color.N = query.color.N ? undefined : 'N'; load_table();">N</button>
                    </div>

                </div>

                <!-- Carat -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Carat</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control text-center" name="carat_min" ng-model="query.carat.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control text-center" name="carat_max" ng-model="query.carat.max" ng-keyup="load_table()" placeholder="Max">
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Shape -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Shape</h4>

                    <div class="btn-group btn-radio-group" name="shape">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Asscher']}" ng-click="query.shape['Asscher'] = query.shape['Asscher'] ? undefined : 'Asscher'; load_table();">Asscher</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Cushion']}" ng-click="query.shape['Cushion'] = query.shape['Cushion'] ? undefined : 'Cushion'; load_table();">Cushion</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Emerald']}" ng-click="query.shape['Emerald'] = query.shape['Emerald'] ? undefined : 'Emerald'; load_table();">Emerald</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Euro Cut']}" ng-click="query.shape['Euro Cut'] = query.shape['Euro Cut'] ? undefined : 'Euro Cut'; load_table();">Euro Cut</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Heart']}" ng-click="query.shape['Heart'] = query.shape['Heart'] ? undefined : 'Heart'; load_table();">Heart</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Marquise']}" ng-click="query.shape['Marquise'] = query.shape['Marquise'] ? undefined : 'Marquise'; load_table();">Marquise</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Oval']}" ng-click="query.shape['Oval'] = query.shape['Oval'] ? undefined : 'Oval'; load_table();">Oval</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Pear']}" ng-click="query.shape['Pear'] = query.shape['Pear'] ? undefined : 'Pear'; load_table();">Pear</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Princess']}" ng-click="query.shape['Princess'] = query.shape['Princess'] ? undefined : 'Princess'; load_table();">Princess</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Radiant']}" ng-click="query.shape['Radiant'] = query.shape['Radiant'] ? undefined : 'Radiant'; load_table();">Radiant</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Round Brilliant']}" ng-click="query.shape['Round Brilliant'] = query.shape['Round Brilliant'] ? undefined : 'Round Brilliant'; load_table();">Round Brilliant</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.shape['Trilliant']}" ng-click="query.shape['Trilliant'] = query.shape['Trilliant'] ? undefined : 'Trilliant'; load_table();">Trilliant</button>
                    </div>

                </div>

                <!-- Length -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Length</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control text-center" ng-model="query.length.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control text-center" ng-model="query.length.max" ng-keyup="load_table()" placeholder="Max">
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Cut -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Cut</h4>

                    <div class="btn-group btn-radio-group" name="cut">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Ideal']}" ng-click="query.cut['Ideal'] = query.cut['Ideal'] ? undefined : 'Ideal'; load_table();">Ideal</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Excellent']}" ng-click="query.cut['Excellent'] = query.cut['Excellent'] ? undefined : 'Excellent'; load_table();">Excellent</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Very Good']}" ng-click="query.cut['Very Good'] = query.cut['Very Good'] ? undefined : 'Very Good'; load_table();">Very Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Good']}" ng-click="query.cut['Good'] = query.cut['Good'] ? undefined : 'Good'; load_table();">Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Fair']}" ng-click="query.cut['Fair'] = query.cut['Fair'] ? undefined : 'Fair'; load_table();">Fair</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['Poor']}" ng-click="query.cut['Poor'] = query.cut['Poor'] ? undefined : 'Poor'; load_table();">Poor</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.cut['None']}" ng-click="query.cut['None'] = query.cut['None'] ? undefined : 'None'; load_table();">None</button>
                    </div>
                </div>

                <!-- Width -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Width</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control text-center" ng-model="query.width.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control text-center" ng-model="query.width.max" ng-keyup="load_table()" placeholder="Max">
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Clarity -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Clarity</h4>
                    <div class="btn-group btn-radio-group" name="clarity">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.I1}" ng-click="query.clarity.I1 = query.clarity.I1 ? undefined : 'I1'; load_table();">I1</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.I2}" ng-click="query.clarity.I2 = query.clarity.I2 ? undefined : 'I2'; load_table();">I2</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.IF}" ng-click="query.clarity.IF = query.clarity.IF ? undefined : 'IF'; load_table();">IF</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.SI1}" ng-click="query.clarity.SI1 = query.clarity.SI1 ? undefined : 'SI1'; load_table();">SI1</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.SI2}" ng-click="query.clarity.SI2 = query.clarity.SI2 ? undefined : 'SI2'; load_table();">SI2</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.SI3}" ng-click="query.clarity.SI3 = query.clarity.SI3 ? undefined : 'SI3'; load_table();">SI3</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.VS1}" ng-click="query.clarity.VS1 = query.clarity.VS1 ? undefined : 'VS1'; load_table();">VS1</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.VS2}" ng-click="query.clarity.VS2 = query.clarity.VS2 ? undefined : 'VS2'; load_table();">VS2</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.VVS1}" ng-click="query.clarity.VVS1 = query.clarity.VVS1 ? undefined : 'VVS1'; load_table();">VVS1</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.clarity.VVS2}" ng-click="query.clarity.VVS2 = query.clarity.VVS2 ? undefined : 'VVS2'; load_table();">VVS2</button>
                    </div>
                </div>

                <!-- Table -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Table</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control text-center" ng-model="query.table.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control text-center" ng-model="query.table.max" ng-keyup="load_table()" placeholder="Max">
                    </div>

                </div>

            </div>

            <div class="row">

                <!-- Polish -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Polish</h4>
                    <div class="btn-group btn-radio-group" name="polish">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Ideal']}" ng-click="query.polish['Ideal'] = query.polish['Ideal'] ? undefined : 'Ideal'; load_table();">Ideal</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Excellent']}" ng-click="query.polish['Excellent'] = query.polish['Excellent'] ? undefined : 'Excellent'; load_table();">Excellent</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Very Good']}" ng-click="query.polish['Very Good'] = query.polish['Very Good'] ? undefined : 'Very Good'; load_table();">Very Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Good']}" ng-click="query.polish['Good'] = query.polish['Good'] ? undefined : 'Good'; load_table();">Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Fair']}" ng-click="query.polish['Fair'] = query.polish['Fair'] ? undefined : 'Fair'; load_table();">Fair</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['Poor']}" ng-click="query.polish['Poor'] = query.polish['Poor'] ? undefined : 'Poor'; load_table();">Poor</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.polish['None']}" ng-click="query.polish['None'] = query.polish['None'] ? undefined : 'None'; load_table();">None</button>
                    </div>

                </div>

                <!-- Depth -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Depth</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control text-center" ng-model="query.depth.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control text-center" ng-model="query.depth.max" ng-keyup="load_table()" placeholder="Max">
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Symmetry -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Symmetry</h4>
                    <div class="btn-group btn-radio-group" name="symmetry">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Ideal']}" ng-click="query.symmetry['Ideal'] = query.symmetry['Ideal'] ? undefined : 'Ideal'; load_table();">Ideal</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Excellent']}" ng-click="query.symmetry['Excellent'] = query.symmetry['Excellent'] ? undefined : 'Excellent'; load_table();">Excellent</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Very Good']}" ng-click="query.symmetry['Very Good'] = query.symmetry['Very Good'] ? undefined : 'Very Good'; load_table();">Very Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Good']}" ng-click="query.symmetry['Good'] = query.symmetry['Good'] ? undefined : 'Good'; load_table();">Good</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Fair']}" ng-click="query.symmetry['Fair'] = query.symmetry['Fair'] ? undefined : 'Fair'; load_table();">Fair</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['Poor']}" ng-click="query.symmetry['Poor'] = query.symmetry['Poor'] ? undefined : 'Poor'; load_table();">Poor</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.symmetry['None']}" ng-click="query.symmetry['None'] = query.symmetry['None'] ? undefined : 'None'; load_table();">None</button>
                    </div>
                </div>

                <!-- Price Per Carat -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Price Per Carat</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control input-sm text-center" ng-model="query.price_per_carat.min" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control input-sm text-center" ng-model="query.price_per_carat.max" placeholder="Max">
                    </div>
                </div>

            </div>

            <div class="row">

                <!-- Fluorescence -->
                <div class="col-md-7 text-left">
                    <h4 class="text-left">Fluorescence</h4>
                    <div class="btn-group btn-radio-group" name="fluorescence">
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.fluorescence.None}" ng-click="query.fluorescence.None = query.fluorescence.None ? undefined : 'None'; load_table();">None</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.fluorescence.Faint}" ng-click="query.fluorescence.Faint = query.fluorescence.Faint ? undefined : 'Faint'; load_table();">Faint</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.fluorescence.Medium}" ng-click="query.fluorescence.Medium = query.fluorescence.Medium ? undefined : 'Medium'; load_table();">Medium</button>
                        <button type="button" class="btn btn-default btn-sm" ng-class="{active: query.fluorescence.Strong}" ng-click="query.fluorescence.Strong = query.fluorescence.Strong ? undefined : 'Strong'; load_table();">Strong</button>
                    </div>
                </div>

                <!-- Net Price -->
                <div class="col-md-5 text-left">
                    <h4 class="text-left col-md-2">Net Price</h4>
                    <div class="input-group col-md-6" role="group">
                        <input type="text" class="form-control input-sm text-center" ng-model="query.net_price.min" ng-keyup="load_table()" placeholder="Min">
                        <span class="input-group-addon" style="border-right: none;">To</span>
                        <input type="text" class="form-control input-sm text-center" ng-model="query.net_price.max" ng-keyup="load_table()" placeholder="Max">
                    </div>
                </div>

            </div>

            <div class="row">
                <a href="#" class="text-right" ng-click="filter.toggle(false)">
                    <h4>
                        <span class="glyphicon glyphicon-chevron-up"></span> 
                        Hide Advanced
                    </h4>
                </a>
            </div>

        </div><!-- end .filter-advanced -->


    </div><!-- end #diamonnd-filter-options.container -->

    <div class="container">
        
        <div ng-repeat="item in items">
            <div class="list-group-item row" ng-if="item.index <= items_to_show">
                <div class="col-lg-2">
                    <a href="#">
                        <img class="thumb thumb-md" ng-src="{{item.image_path}}">
                    </a>
                </div>

                <div class="col-lg-10">
                    <h4 class="list-group-item-heading"> {{item.product_id}} </h4>
                    <p class="list-group-item-text">

                        <div class="col-md-2">
                          <div><span>Carat</span> <strong>{{item.carat}}</strong></div>
                          <div><span>Color</span> <strong>{{item.color}}</strong></div>
                          <div><span>Clarity</span> <strong>{{item.clarity}}</strong></div>
                          <div><span>Polish</span> <strong>{{item.polish}}</strong></div>
                        </div>

                        <div class="col-md-3">        
                          <div><span>Shape</span> <strong>{{item.shape}}</strong></div>
                          <div><span>Cut</span> <strong>{{item.cut}}</strong></div>
                          <div><span>Symmetry</span> <strong>{{item.symmetry}}</strong></div>
                          <div><span>Fluorescence</span> <strong>{{item.fluorescence}}</strong></div>
                        </div>

                        <div class="col-md-2">
                          <div><span>Table</span> <strong>{{item.table}}</strong></div>
                          <div><span>Depth</span> <strong>{{item.depth}}</strong></div>
                          <div><span>Length</span> <strong>{{item.length}}</strong></div>
                          <div><span>Width</span> <strong>{{item.width}}</strong></div>
                        </div>

                        <div class="col-md-3">
                          <div> <span>Price Per Carat</span> <strong>{{item.price_per_carat}}</strong></div>
                          <div> <span>Net Price</span> <strong>{{item.net_price}}</strong></div>
                        </div>

                        <div class="col-md-2">
                          <div ng-if="item.cert_path">
                            <a ng-href="item.cert_path" target="_blank">
                                <span class="glyphicon glyphicon-download-alt"></span>
                                Download Cert
                            </a>
                          </div>
                          <div ng-if="item.comment.length">
                            <a href="#" title="{{item.comment}}">
                                <span class="glyphicon glyphicon-comment"></span>
                                Comment
                            </a>
                          </div>
                        </div>

                    </p>
                </div><!-- end col-lg-10 -->
            </div><!-- end .row -->
        </div>

        <br>

        <div class="row" ng-if="items_to_show < items.length">
            <hr class="col-md-4" />
            <h4 class="col-md-3 text-center">
                <a href="#" ng-click="show_more()">Show More</a>
                <div><small ng-bind="'(Showing '+items_to_show+' of '+items.length+' Diamonds)'"></small></div>
            </h4>
            <hr class="col-md-4" />
        </div>

        <div ng-if="show_loader" class="text-center">
            <br><br>
            <img src="/share/loader.gif">
        </div>

        <div ng-if="!show_loader && !items.length">
            <br><br>
            <div class="well text-center col-md-8 col-md-offset-2">
                <h3>We're sorry</h3>
                <p>We couldn't find any diamonds matching your request! Please check back later or give us a call.</p>
            </div>
        </div>

    </div><!-- end .container -->

</div>
<?php include(ROOTPATH . '/views/public/foot.php'); ?>
</body>
</html>