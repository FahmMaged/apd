<input type="hidden" id="currPage" name="currPage" value="1" />
<!-- Fixed Action Button Start -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;" id="addAlertBtnCnt">
  <a class="btn-floating btn-large amber darken-4 [[+addFlag]]">
    <i class="large material-icons">add</i>
  </a>
  <ul>
    <li>
      <a class="btn-floating btn-large blue tooltipped modal-trigger popupforms" data-position="left" data-delay="50"
        data-tooltip="Add New Item" id="addItem">
        <i class="material-icons">announcement</i>
      </a>
    </li>
  </ul>
</div>
<!-- Fixed Action Button End -->
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">
      Awareness Items
    </h1>
    <p class="subtitle-text">
      Manage Awareness Items on your website.
    </p>


    <div id="contentContainer">
      <!-- To be filled out by an AJAX call -->
    </div>

  </div>
  <div class="row mt20">
    <div class="small-4 small-centered columns center">
      <a href="#" id="loadMore" style="display:none;" class="btn blue-grey darken-2 waves-effect waves-light">load More</a>
    </div>
  </div>
</div>
<!-- Add Item Modal Structure -->
<div id="addModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Add New Item
    </h4>
    <div class="row">
      <form id="addGL" class="col s12">
        <input type="hidden" name="operation" value="add" />
        [[+select]]
        <div id="addTabs" class="col s12 mb30">
          <ul class="tabs">
            <li class="tab col s3"><a href="#TabEN">English Data</a></li>
            <li class="tab col s3"><a class="active" href="#TabAR">Arabic Data</a></li>
          </ul>
        </div>
        <div id="TabEN" class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input name="title_en" type="text" class="validate">
              <label for="dir-title_en">English Item*</label>
            </div>

            <label for="dir-description_en">English Answer</label>
            <div class="input-field col s12">
              <textarea name="description_en"></textarea>
            </div>
          </div>
        </div>

        <div id="TabAR" class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input name="title_ar" type="text" class="validate">
              <label for="dir-title_ar">Arabic Item*</label>
            </div>

            <label for="dir-description_ar">Arabic Answer</label>
            <div class="input-field col s12">
              <textarea name="description_ar"></textarea>
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <input name="sort" type="number">
          <label for="dir-sort">Sort</label>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Image*
            </span>
            <input name="picture" type="file" class="validate">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text">
          </div>
        </div>

      </form>
    </div>
  </div>
  <!-- End Arabic Fields -->

  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnAdd">Save</a>
  </div>
</div>

<!-- Add Item End -->
<a data-activates="editModal" class="popupforms waves-effect waves-light btn modal-trigger" href="#" id="openEditBtn"
  style="display:none;">Modal</a>
<!-- Edit ItemModal Structure -->
<div id="editModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Item Items
    </h4>
    <div class="row">
      <form id="editGL" class="col s12">
        <input type="hidden" name="operation" value="edit" />
        <input type="hidden" id="itemID" name="itemID" value="" />
        [[+editSelect]]
        <div id="addTabsEdit" class="col s12 mb30">
          <ul class="tabs">
            <li class="tab col s3"><a href="#TabENEdit">English Data</a></li>
            <li class="tab col s3"><a class="active" href="#TabAREdit">Arabic Data</a></li>
          </ul>
        </div>
        <div id="TabENEdit" class="row">
          <div class="input-field col s12">
            <input id="edit_title_en" name="edit_title_en" type="text">
            <label for="dir-edit_title_en">
              English Item
            </label>
          </div>
          <div class="input-field col s12">
            <textarea id="edit_description_en" name="edit_description_en"></textarea>
            <label for="dir-edit_description_en">
              English Answer
            </label>
          </div>
        </div>

        <div id="TabAREdit" class="row">
          <div class="input-field col s12">
            <input id="edit_title_ar" name="edit_title_ar" type="text">
            <label for="dir-edit_title_ar">
              Arabic Item
            </label>
          </div>
          <div class="input-field col s12">
            <textarea id="edit_description_ar" name="edit_description_ar"></textarea>
            <label for="dir-edit_description_ar">
              Arabic Answer
            </label>
          </div>
        </div>

        <div class="input-field col s12">
          <input name="edit_sort" id="editSort" type="number">
          <label for="dir-edit_sort">Sort</label>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Image
            </span>
            <input name="edit_picture" type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text">
          </div>
        </div>

      </form>

    </div>
    <div class="modal-footer">
      <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnEdit">Save</a>
    </div>
  </div>
</div>
<!-- Edit Item End -->

<!-- Upload Photos Start -->
<div id="uploadModal" class="modal bottom-sheet" style="overflow-y: auto;max-height: 100%;">
  <div class="modal-content">
    <h4>Upload Files</h4>
    <div class="row">
      <div id="fine-uploader-manual-trigger"></div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnCloseUploads">Close</a>
  </div>
</div>
<!-- Upload Photos End -->

<!-- view  Photos Start -->
<div id="viewModal" class="modal bottom-sheet" style="overflow-y: auto;max-height: 100%;">
  <div class="modal-content">
    <h4>View Files</h4>
    <div class="row files">
        
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="closeFileModal">Close</a>
  </div>
</div>
<!-- View Photos End -->