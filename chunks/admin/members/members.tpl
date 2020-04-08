<input type="hidden" id="currPage" name="currPage" value="1" />
<!-- Fixed Action Button Start -->
<!-- <div class="fixed-action-btn" style="bottom: 45px; right: 24px;" id="addAlertBtnCnt">
  <a class="btn-floating btn-large amber darken-4 [[+addFlag]]">
  <i class="large material-icons">add</i>
  </a>
  <ul>
    <li>
      <a class="btn-floating btn-large blue tooltipped modal-trigger popupforms" data-position="left" data-delay="50" data-tooltip="Add New Item"  id="addItem">
      <i class="material-icons">announcement</i>
      </a>
    </li>
  </ul>
</div> -->
<!-- Fixed Action Button End -->
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">
      Members
    </h1>
    <p class="subtitle-text">
      Manage Members on your website.
    </p>

    <div id="contentContainer">
      <!-- To be filled out by an AJAX call -->
    </div>
  </div>
  <div class="row mt20">
    <div class="small-4 small-centered columns center">
      <a
        href="#"
        id="loadMore"
        style="display:none;"
        class="btn blue-grey darken-2 waves-effect waves-light"
        >load More</a
      >
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
              <label for="dir-title_en">English Name*</label>
            </div>

            <div class="input-field col s12">
              <input name="job_title_en" type="text" class="validate" />
              <label for="dir-job_title_en">English Job Title*</label>
            </div>

            <label for="dir-description_en">English Description</label>
            <div class="input-field col s12">
              <textarea name="description_en"></textarea>
            </div>
          </div>
        </div>

        <div id="TabAR" class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input name="title_ar" type="text" class="validate" />
              <label for="dir-title_ar">Arabic Name*</label>
            </div>

            <div class="input-field col s12">
              <input name="job_title_ar" type="text" class="validate" />
              <label for="dir-job_title_ar">Arabic Job Title*</label>
            </div>

            <label for="dir-description_ar">Arabic Description</label>
            <div class="input-field col s12">
              <textarea name="description_ar"></textarea>
            </div>
          </div>
        </div>

        <div class="input-field col s12">
          <input name="sort" type="number" />
          <label for="dir-sort">Sort</label>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Image
            </span>
            <input name="picture" type="file" class="validate" />
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
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnAdd"
      >Save</a
    >
  </div>
</div>

<!-- Add Item End -->
<a
  data-activates="editModal"
  class="popupforms waves-effect waves-light btn modal-trigger"
  href="#"
  id="openEditBtn"
  style="display:none;"
  >Modal</a
>
<!-- Edit ItemModal Structure -->
<div id="editModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Members
    </h4>

    <div class="row">
      <form id="editGL">
        <input type="hidden" name="operation" value="edit"/>
        <input type="hidden" id="itemID" name="itemID" value="" />
      <div class="col s6">
        <p>Member Status</p>
        <!-- Switch -->
        <div class="switch">
          <label>
            Inactive
            <input type="checkbox" id="editIsActive" name="isActive" checked />
            <span class="lever"></span>
            Active
          </label>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="input-field col l6 m12 s12">
        <input id="first_name" name="first_name" type="text" class="validate" />
        <label for="first_name"> First Name </label>
      </div>
      <div class="input-field col l6 m12 s12">
        <input id="last_name" name="last_name" type="text" class="validate" />
        <label for="last_name"> Last Name </label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col l6 m12 s12">
        <input id="email" name="email" type="text" class="validate" />
        <label for="email"> Email </label>
      </div>
      <div class="input-field col l6 m12 s12">
        <input id="phone" name="phone" type="text" class="validate" />
        <label for="phone"> Phone Number</label>
      </div>
    </div>

    <img class="articleImage" src="../[[+image]]" />

    <div class="row">
      <div class="input-field col l6 m12 s12">
        <input id="password" name="password" type="password" class="validate" />
        <label for="password">كلمة المرور</label>
      </div>
      <div class="input-field col l6 m12 s12">
        <input
          id="confirmPassword"
          name="confirmPassword"
          type="password"
          class="validate"
        />
        <label for="confirmPassword"> تاكيد كلمة المرور </label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col l6 m12 s12">
        <input id="city" name="city" type="text" class="validate" />
        <label for="city"> Countery </label>
      </div>
      <div class="input-field col l6 m12 s12">
        <input id="location" name="location" type="text" class="validate" />
        <label for="location"> City </label>
      </div>
    </div>

    <div class="row">
      <label for="bio">Bio</label>
      <div class="input-field col s12">
        <textarea id="bio" name="bio" class="materialize-textarea"></textarea>
      </div>
    </div>
  </form>
    <div class="modal-footer">
      <a
        href="#"
        class="waves-effect waves-light btn blue darken-2"
        id="btnEdit"
        >Save</a
      >
    </div>
  </div>
  <!-- Edit Item End -->
</div>
