<div class="row">
    <div class="large-12 columns">
        <h1 class="main-title">
            Home
        </h1>
        <p class="subtitle-text">
            Manage Home page on your website.
        </p>

    </div>
</div>

<a data-activates="editModal" class="popupforms waves-effect waves-light btn modal-trigger" href="#" id="openEditBtn" style="display:none;">Modal</a>
<!-- Edit ItemModal Structure -->
<div class="modal-content">
    <div class="row">
        <form id="editGL" class="col s12">
            <input type="hidden" name="operation" value="edit" />
            <input type="hidden" id="itemID" name="currID" value="1" />

          <div id="addTabsEdit" class="col s12 mb30">
              <ul class="tabs">
                  <li class="tab col s3"><a  href="#TabENEdit">English Data</a></li>
                  <li class="tab col s3"><a class="active" href="#TabAREdit">Arabic Data</a></li>
              </ul>
          </div>
          <div id="TabENEdit" class="row">
            <div class="input-field col s12">
              <input id="edit_title_en" name="edit_title_en" type="text">
              <label for="dir-edit_title_en">
                 Video English Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="edit_description_en" name="edit_description_en"></textarea>
              <label for="dir-edit_description_en">
                  Video English Description
              </label>
            </div>
          </div>

          <div id="TabAREdit" class="row">
            <div class="input-field col s12">
              <input id="edit_title_ar" name="edit_title_ar" type="text">
              <label for="dir-edit_title_ar">
                 Video Arabic Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="edit_description_ar" name="edit_description_ar"></textarea>
              <label for="dir-edit_description_ar">
                  Video Arabic Description
              </label>
            </div>
          </div>

          <div class="input-field col s12">
            <input name="edit_link" id="edit_link" type="text">
            <label for="dir-edit_link">Link</label>
          </div>

          <div class="input-field col s12">
            <input name="edit_views" id="edit_views" type="text">
            <label for="dir-edit_views">Number Of Views</label>
          </div>

        </form>
    </div>
</div>
<div class="main-button">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnSave">Save</a>
</div>
<!-- </div> -->
<!-- Edit Item End -->