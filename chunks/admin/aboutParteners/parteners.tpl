<input type="hidden" id="currPage" name="currPage" value="1" />
<!-- Fixed Action Button Start -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;" id="addAlertBtnCnt">
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
</div>
<!-- Fixed Action Button End -->
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">
       About Parteners
    </h1>
    <p class="subtitle-text">
      Manage About Parteners on your website.
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

            <input type="hidden" name="operation" value="addPartener" />

        <div class="input-field col s12">
          <input name="title_en" type="text">
          <label for="dir-title_en">Title</label>
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
<a data-activates="editModal" class="popupforms waves-effect waves-light btn modal-trigger" href="#" id="openEditBtn" style="display:none;">Modal</a>
<!-- Edit ItemModal Structure -->
<div id="editModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Slider Items
    </h4>
    <div class="row">
      <form id="editGL" class="col s12">
        <input type="hidden" name="operation" value="editPartener" />
        <input type="hidden" id="itemID" name="itemID" value="" />

        <div class="input-field col s12">
          <input name="edit_title_en" id="edit_title_en" type="text">
          <label for="dir-edit_title_en">Title</label>
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
<!-- Edit Item End -->