<input type="hidden" id="editHomeFlag" value="1" />
<div class="row">
    <div class="large-12 columns">
        <h1 class="main-title">
            Main Pages Meta Tags
        </h1>
        <p class="subtitle-text">
            Manage Main Pages Meta Tags on your website.
        </p>

    </div>
</div>

<a data-activates="editModal" class="popupforms waves-effect waves-light btn modal-trigger" href="#" id="openEditBtn" style="display:none;">Modal</a>
<!-- Edit ItemModal Structure -->
<div class="modal-content">
    <div class="row">
        <form id="editGL" class="col s12">
            <input type="hidden" name="operation" value="edit" />
            <input type="hidden" id="itemID" name="currID" value="" />
            <div id="addTabsEdit" class="col s12 mb30">
              <ul class="tabs">
                  <li class="tab col s3"><a  href="#TabENEdit">English Data</a></li>
                  <li class="tab col s3"><a class="active" href="#TabAREdit">Arabic Data</a></li>
              </ul>
            </div>
        <div id="TabENEdit" class="row">
            <h3 class="main-title">
                About Page
            </h3>
            <div class="input-field col s12">
                <input id="AboutTitle" name="AboutTitle" type="text" class="validate">
                <label for="dir-title">
                    About English Meta Title *
                </label>
            </div>
            <label for="dir-AboutDescription">
                About English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="AboutDescription" name="AboutDescription" class="validate"></textarea>
            </div>

            <!-- Home -->
            <h3 class="main-title">
                Home Page
            </h3>
            <div class="input-field col s12">
                <input id="HomeTitle" name="HomeTitle" type="text" class="validate">
                <label for="dir-title">
                    Home English Meta Title *
                </label>
            </div>
            <label for="dir-HomeDescription">
                Home English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="HomeDescription" name="HomeDescription" class="validate"></textarea>
            </div>

            <!-- Facilities -->
            <h3 class="main-title">
                Facilities Page
            </h3>
            <div class="input-field col s12">
                <input id="FacilitiesTitle" name="FacilitiesTitle" type="text" class="validate">
                <label for="dir-title">
                    Facilities English Meta Title *
                </label>
            </div>
            <label for="dir-FacilitiesDescription">
                Facilities English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="FacilitiesDescription" name="FacilitiesDescription" class="validate"></textarea>
            </div>

            <!-- News -->
            <h3 class="main-title">
                News Page
            </h3>
            <div class="input-field col s12">
                <input id="NewsTitle" name="NewsTitle" type="text" class="validate">
                <label for="dir-title">
                    News English Meta Title *
                </label>
            </div>
            <label for="dir-NewsDescription">
                News English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="NewsDescription" name="NewsDescription" class="validate"></textarea>
            </div>

            <!-- Gallery -->
            <h3 class="main-title">
                Gallery Page
            </h3>
            <div class="input-field col s12">
                <input id="GalleryTitle" name="GalleryTitle" type="text" class="validate">
                <label for="dir-title">
                    Gallery English Meta Title *
                </label>
            </div>
            <label for="dir-GalleryDescription">
                Gallery English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="GalleryDescription" name="GalleryDescription" class="validate"></textarea>
            </div>

            <!-- Contact -->
            <h3 class="main-title">
                Contact Page
            </h3>
            <div class="input-field col s12">
                <input id="ContactTitle" name="ContactTitle" type="text" class="validate">
                <label for="dir-title">
                    Contact English Meta Title *
                </label>
            </div>
            <label for="dir-ContactDescription">
                Contact English Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="ContactDescription" name="ContactDescription" class="validate"></textarea>
            </div>
        </div>

        <div id="TabAREdit" class="row">
            <h3 class="main-title">
                About Page
            </h3>
            <div class="input-field col s12">
                <input id="AboutTitle_ar" name="AboutTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    About Arabic Meta Title *
                </label>
            </div>
            <label for="dir-AboutDescription_ar">
                About Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="AboutDescription_ar" name="AboutDescription_ar" class="validate"></textarea>
            </div>

            <!-- Home -->
            <h3 class="main-title">
                Home Page
            </h3>
            <div class="input-field col s12">
                <input id="HomeTitle_ar" name="HomeTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    Home Arabic Meta Title *
                </label>
            </div>
            <label for="dir-HomeDescription_ar">
                Home Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="HomeDescription_ar" name="HomeDescription_ar" class="validate"></textarea>
            </div>

            <!-- Facilities -->
            <h3 class="main-title">
                Facilities Page
            </h3>
            <div class="input-field col s12">
                <input id="FacilitiesTitle_ar" name="FacilitiesTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    Facilities Arabic Meta Title *
                </label>
            </div>
            <label for="dir-FacilitiesDescription_ar">
                Facilities Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="FacilitiesDescription_ar" name="FacilitiesDescription_ar" class="validate"></textarea>
            </div>

            <!-- News -->
            <h3 class="main-title">
                News Page
            </h3>
            <div class="input-field col s12">
                <input id="NewsTitle_ar" name="NewsTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    News Arabic Meta Title *
                </label>
            </div>
            <label for="dir-NewsDescription_ar">
                News Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="NewsDescription_ar" name="NewsDescription_ar" class="validate"></textarea>
            </div>

            <!-- Gallery -->
            <h3 class="main-title">
                Gallery Page
            </h3>
            <div class="input-field col s12">
                <input id="GalleryTitle_ar" name="GalleryTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    Gallery Arabic Meta Title *
                </label>
            </div>
            <label for="dir-GalleryDescription_ar">
                Gallery Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="GalleryDescription_ar" name="GalleryDescription_ar" class="validate"></textarea>
            </div>

            <!-- Contact -->
            <h3 class="main-title">
                Contact Page
            </h3>
            <div class="input-field col s12">
                <input id="ContactTitle_ar" name="ContactTitle_ar" type="text" class="validate">
                <label for="dir-title">
                    Contact Arabic Meta Title *
                </label>
            </div>
            <label for="dir-ContactDescription_ar">
                Contact Arabic Meta Description *
            </label>
            <div class="input-field col s12">
              <textarea id="ContactDescription_ar" name="ContactDescription_ar" class="validate"></textarea>
            </div>
        </div>

        </form>
    </div>
</div>
<div class="main-button">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnSave">Save</a>
</div>
<!-- </div> -->
<!-- Edit Item End -->