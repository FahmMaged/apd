[[+head]]
[[+header]]
<!-- HEADER --> 
<section class="headerInner" style="background-image: url('[[+mainImage]]')">
    <div class="overlay">
        <div class="titles">
            <h3>[[+headerTitle]]
            </h3>
        </div>
    </div>
</section>
    <!-- HEADER-END -->
    <section class="media">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolioFilter clearfix">
                        <a href="#" id="all" data-filter="*" class="current">[[+all]]</a>
                        <a href="#"  data-filter=".mediaImages">[[+images]]</a>
                        <a href="#"  data-filter=".mediaVideos">[[+videos]]</a>
                    </div>
                </div>
                <div class="portfolioContainer" id="contentContainer" style="direction:ltr;">
                    <!-- To be filled with AJAX call -->
                </div>
                <div id="pagination">
        	
                </div>
                
            </div>
        </div>
    </section>
[[+footer]]
<script src='scripts/jquery.min.2.2.2.js'></script>
<script src="scripts/lity.js"></script>
[[+scripts]]
