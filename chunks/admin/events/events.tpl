<input type="hidden" id="currPage" name="currPage" value="1" />
<input type="hidden" id="status" name="status" value="[[+status]]" />
<!-- Fixed Action Button Start -->
<div
  class="fixed-action-btn"
  style="bottom: 45px; right: 24px;"
  id="addAlertBtnCnt"
>
  <a class="btn-floating btn-large amber darken-4">
    <i class="large material-icons">add</i>
  </a>
  <ul>
    <li>
      <a
        class="btn-floating btn-large blue tooltipped modal-trigger popupforms"
        data-position="left"
        data-delay="50"
        data-tooltip="Add Event"
        id="addNews"
      >
        <i class="material-icons">announcement</i>
      </a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">
      Events
    </h1>
    <p class="subtitle-text">
      Manage Events Items.
    </p>

    <div id="contentContainer">
      <!-- To be filled out by an AJAX call -->
    </div>
  </div>
  <div class="row mt20">
    <div class="small-4 small-centered columns center">
      <a
        id="loadMore"
        style="display:none;"
        class="btn blue-grey darken-2 waves-effect waves-light"
        >load More</a
      >
    </div>
  </div>
</div>
<!-- Add News Modal Structure -->
<div id="addNewsModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Add Event
    </h4>
    <div class="row">
      <form id="addGLI" class="col s12">
        <input type="hidden" name="operation" value="add" />

        <div id="addTabs" class="col s12 mb30">
          <ul class="tabs">
            <li class="tab col s3"><a href="#TabEN">English Data</a></li>
            <li class="tab col s3">
              <a class="active" href="#TabAR">Arabic Data</a>
            </li>
          </ul>
        </div>
        <div id="TabEN" class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input name="title_en" type="text" class="validate" />
              <label for="dir-title_en">English Title*</label>
            </div>

            <label for="dir-description_en">English Description</label>
            <div class="input-field col s12">
              <textarea name="description_en"></textarea>
            </div>

            <div class="input-field col s12">
              <input name="alias_en" type="text" />
              <label for="dir-alias_en">English Alias</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input name="location_en" type="text" class="validate" />
              <label for="dir-location_en">English Location*</label>
            </div>

            <div class="input-field col s6">
              <input name="time_en" type="text" class="validate" />
              <label for="dir-time_en">English Time*</label>
            </div>
          </div>
        </div>

        <div id="TabAR" class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input name="title_ar" type="text" class="validate" />
              <label for="dir-title_ar">Arabic Title*</label>
            </div>

            <label for="dir-description_ar">Arabic Description</label>
            <div class="input-field col s12">
              <textarea name="description_ar"></textarea>
            </div>

            <div class="input-field col s12">
              <input name="alias_ar" id="alias_ar" type="text" />
              <label for="dir-alias_ar">Arabic Alias</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input name="location_ar" type="text" class="validate" />
              <label for="dir-location_ar">Arabic Location*</label>
            </div>

            <div class="input-field col s6">
              <input name="time_ar" type="text" class="validate" />
              <label for="dir-time_ar">Arabic Time*</label>
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <!-- <p>
            <input type="checkbox" class="filled-in" id="inHome" />
            <label for="inHome">In Home</label>
          </p> -->
          <p>
            <input type="checkbox" class="filled-in" id="forMembers" />
            <label for="forMembers">For Members</label>
          </p>
          <p>
            <input type="checkbox" class="filled-in" id="isActive" />
            <label for="isActive">Is Active</label>
          </p>
        </div>

        <div class="input-field col s12" id="hide">
          <h5>Select Category</h5>
          <select id="categoryID" name="category" class="[[+class]]">
            <option value="0" disabled selected>Select Category</option>
            [[+options]]
          </select>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input type="date" class="datepicker" name="publish_date" />
            <label for="dir-publish_date">
              Publish Date
            </label>
          </div>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Image
            </span>
            <input name="picture" type="file" />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text" />
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input name="sort" type="number" />
            <label for="dir-sort">
              Sort
            </label>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a
      href="#"
      class="waves-effect waves-light btn blue darken-2"
      id="btnNewsAdd"
      >Save</a
    >
  </div>
</div>
<!-- Add News End -->

<a
  data-activates="editNewsModal"
  class="popupforms waves-effect waves-light btn modal-trigger"
  href="#"
  id="openEditBtn"
  style="display:none;"
  >Modal</a
>
<!-- Edit News Modal Structure -->
<div id="editNewsModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Event
    </h4>
    <div class="row">
      <form id="editGLI" class="col s12">
        <input type="hidden" name="operation" value="edit" />
        <input type="hidden" id="itemID" name="itemID" value="" />

        <div id="addTabsEdit" class="col s12 mb30">
          <ul class="tabs">
            <li class="tab col s3"><a href="#TabENEdit">English Data</a></li>
            <li class="tab col s3">
              <a class="active" href="#TabAREdit">Arabic Data</a>
            </li>
          </ul>
        </div>
        <div id="TabENEdit" class="row">
          <div class="input-field col s12">
            <input id="edit_title_en" name="edit_title_en" type="text" />
            <label for="dir-edit_title_en">
              English Title
            </label>
          </div>
          <div class="input-field col s12">
            <textarea
              id="edit_description_en"
              name="edit_description_en"
            ></textarea>
            <label for="dir-edit_description_en">
              English Description
            </label>
          </div>
          <div class="input-field col s12">
            <input name="edit_alias_en" id="edit_alias_en" type="text" />
            <label for="dir-edit_alias_en">English Alias</label>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input
                name="edit_location_en"
                id="edit_location_en"
                type="text"
                class="validate"
              />
              <label for="dir-edit_location_en">English Location*</label>
            </div>

            <div class="input-field col s6">
              <input
                name="edit_time_en"
                id="edit_time_en"
                type="text"
                class="validate"
              />
              <label for="dir-edit_time_en">English Time*</label>
            </div>
          </div>
        </div>

        <div id="TabAREdit" class="row">
          <div class="input-field col s12">
            <input id="edit_title_ar" name="edit_title_ar" type="text" />
            <label for="dir-edit_title_ar">
              Arabic Title
            </label>
          </div>
          <div class="input-field col s12">
            <textarea
              id="edit_description_ar"
              name="edit_description_ar"
            ></textarea>
            <label for="dir-edit_description_ar">
              Arabic Description
            </label>
          </div>
          <div class="input-field col s12">
            <input name="edit_alias_ar" id="edit_alias_ar" type="text" />
            <label for="dir-edit_alias_ar">Arabic Alias</label>
          </div>

          <div class="row">
            <div class="input-field col s6">
              <input
                name="edit_location_ar"
                id="edit_location_ar"
                type="text"
                class="validate"
              />
              <label for="dir-edit_location_ar">Arabic Location*</label>
            </div>

            <div class="input-field col s6">
              <input
                name="edit_time_ar"
                id="edit_time_ar"
                type="text"
                class="validate"
              />
              <label for="dir-edit_time_ar">Arabic Time*</label>
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <!-- <p>
            <input type="checkbox" class="filled-in" id="edit_inHome" />
            <label for="edit_inHome">In Home</label>
          </p> -->
          <p>
            <input type="checkbox" class="filled-in" id="edit_forMembers" />
            <label for="edit_forMembers">For Members</label>
          </p>
          <p>
            <input type="checkbox" class="filled-in" id="edit_isActive" />
            <label for="edit_isActive">Is Active</label>
          </p>
        </div>

        <div class="input-field col s12" id="editHide">
          <h5>Select Category</h5>
          <select id="editCategoryID" name="edit_category" class="[[+class]]">
            <option value="0" selected>Select Category</option>
            [[+options]]
          </select>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input
              type="date"
              class="datepicker"
              name="edit_publish_date"
              id="edit_publish_date"
            />
            <label for="dir-edit_publish_date">
              Publish Date
            </label>
          </div>
        </div>
        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Image
            </span>
            <input name="picture" type="file" />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text" />
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="edit_sort" name="edit_sort" type="number" />
            <label for="dir-edit_sort">
              Sort
            </label>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a
      href="#"
      class="waves-effect waves-light btn blue darken-2"
      id="btnNewsEdit"
      >Save</a
    >
  </div>
</div>
<!-- Edit News End -->

<!-- Edit Page Content Modal Structure -->
<div id="editPageModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Page Content
    </h4>
    <div class="row">
      <form id="editPage" class="col s12">
        <input type="hidden" name="operation" value="editPage" />
        <div class="input-field col s12">
          <input name="edit_hTitle" id="edit_hTitle" type="text" />
          <label for="dir-edit_hTitle">Head Title</label>
        </div>

        <div class="input-field col s12">
          <input name="title" id="page_title" type="text" />
          <label for="dir-title">Title</label>
        </div>

        <div class="input-field col s12">
          <textarea
            name="description"
            type="text"
            id="page_description"
          ></textarea>
          <label for="dir-description">Description</label>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Head Image
            </span>
            <input name="picture" type="file" />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- End Arabic Fields -->

  <div class="modal-footer">
    <a
      href="#"
      class="waves-effect waves-light btn blue darken-2"
      id="btnEditPage"
      >Save</a
    >
  </div>
</div>

<!-- Upload News Modal Structure -->
<div id="uploadNewsModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Upload News File
    </h4>
    <div class="row">
      <form id="uploadGLI" class="col s12">
        <input type="hidden" name="operation" value="upload" />

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Upload File*
            </span>
            <input name="newsFile" type="file" class="validate" />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a
      href="#"
      class="waves-effect waves-light btn blue darken-2"
      id="btnNewsUpload"
      >Save</a
    >
  </div>
</div>
<!-- Upload News End -->
