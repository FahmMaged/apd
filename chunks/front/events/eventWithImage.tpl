<div class="l4 m4 s12 col animated   fadeInRight">
  <div class="news_box">
    <a href="eventsDetails.php?id=[[+id]]&alias=[[+alias]]"
      ><div class="news_img" style="background-image: url('[[+image]]');"></div
    ></a>
    <div class="clearfix"></div>
    <div class="l2 m2 s3 col date">
      <h3>[[+day]]</h3>
      <span> [[+month]]/[[+year]]</span>
    </div>
    <div class="l10 m10 s9 col details">
      <a href="eventsDetails.php?id=[[+id]]&alias=[[+alias]]">
        <h3>[[+title]]</h3>
      </a>

      <div style="float: left; width: 100%;">
        <div class="s6 col eventsIcon">
          <i class="fa fa-clock-o"></i>
          [[+time]]
        </div>
        <div class="s6 col eventsIcon">
          <i class="fa fa-map-marker"></i>
          [[+location]]
        </div>
      </div>
      [[+description]]
    </div>
  </div>
</div>
