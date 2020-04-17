[[+head]] [[+header]]

<!-- ==============================================    End Body     =============================================== -->
<section class="l12 s12 m12 col no_padding page_name">
  <div class="l12 s12 m12 col inner_headline center">
    <h1>[[+headerTitle]]</h1>
    <!-- <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">الرئيسية</a>
        <a href="#!" class="breadcrumb"> الفاعليات </a>
      </div>
    </div> -->
  </div>
  <img src="[[+mainImage]]" />
</section>
<!-- ==============================================    End Body     =============================================== -->
<section class="inner_body eventsPage">
  <div class="rows">
    <div class="l12 s12 m12 col no_padding">
      <div class="disclaimer"> 
        <p> يمكنك اضافة الفاعليات </p>
        <a href="#" data-target="modal22" class="waves-effect waves-light btn about_btn">
           اضف فاعلية +
          </a>
      </div>
    </div>
    <div class="l12 col no_padding" id="contentContainer"></div>

    <div class="s12 center  col" id="pagination"></div>
  </div>
</section>
                    
                      <!-- Modal Structure -->
                    <div id="modal22" class="modal">
                        <div class="modal-content">
                            <form class="col s12" id="newEvent">
                                <div class="row">
                                    <div class="input-field col l12 m12 s12">
                                      <input id="name" name="name" type="text" class="validate">
                                      <label for="name">Event Title</label>
                                    </div>
                                </div>
                                <div class="row">
            <div class="file-field input-field">
              <div class="btn">
                <span>Upload</span>
                <input type="file" name="image">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Event Image">
              </div>
            </div>
          </div>
                                <div class="row">
                                    <div class="input-field col l12 m12 s12">
                                      <input id="Location" name="name" type="text" class="validate">
                                      <label for="Location">Event Location </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col l6 m12 s12">
                                    <input id="Date" name="email" type="Date" class="validate">
                                    </div>
                                    <div class="input-field col l6 m12 s12">
                                    <input id="Time" name="Event Time "  type="text" class="validate">
                                    <label for="Time">Event Time </label>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="input-field col s12">
                                    <textarea id="textarea1" name="Event Details "  class="materialize-textarea"></textarea>
                                    <label for="textarea1"> Event Details </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                    <button id="btnSend" class="btn left redBtn"> Submit  </button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>

<!-- ==============================================================================================================- -->

[[+footer]] [[+scripts]]
