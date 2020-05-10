<input type="hidden" id="currPage" name="currPage" value="1" />

<!-- Fixed Action Button Start -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;" id="addAlertBtnCnt">
  <a class="btn-floating btn-large amber darken-4">
  <i class="large material-icons">add</i>
  </a>
  <ul>
    <li>
      <a class="btn-floating btn-large blue tooltipped modal-trigger popupforms" data-position="left" data-delay="50" data-tooltip="Add Category"  id="addCategory">
      <i class="material-icons">announcement</i>
      </a>
    </li>
  </ul>
</div>
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">
       Member Categories
    </h1>
    <p class="subtitle-text">
      Manage Member Categories Items.
    </p>

    <div id="contentContainer">
      <!-- To be filled out by an AJAX call -->
      <table>
        <thead>
          <tr>
            <td>English Category</td>
            <td>Arabic Category</td>
            <td>Sort</td>
            <td>Actions</td>
          </tr>

          <tbody id="contentContainerc">
            
          </tbody>
        </thead>
      </table>
    </div>

  </div>
  <!--<div class="row mt20">
    <div class="small-4 small-centered columns center">
      <a id="loadMore" style="display:none;" class="btn blue-grey darken-2 waves-effect waves-light">load More</a>
    </div>
  </div>-->
</div>
<!-- Add News Modal Structure -->
<div id="addCategoryModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Add Category
    </h4>
    <div class="row">
      <form id="addGLI" class="col s12">
        <input type="hidden" name="operation" value="add" />
        
              <div class="row">
                <div class="input-field col s12">
                  <input name="Title_en" type="text" class="validate">
                  <label for="dir-Title_en">English Category*</label>
                </div>

                <div class="input-field col s12">
                  <input name="Title_ar" type="text" class="validate">
                  <label for="dir-Title_ar">Arabic Category*</label>
                </div>

                <div class="input-field col s12">
                  <input name="sort" type="number">
                  <label for="dir-sort">Sort</label>
                </div>
              </div>
                
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnCategoryAdd">Save</a>
  </div>
</div>
<!-- Add News End -->


<a data-activates="editCategoryModal" class="popupforms waves-effect waves-light btn modal-trigger" href="#" id="openEditBtn" style="display:none;">Modal</a>
<!-- Edit News Modal Structure -->
<div id="editCategoryModal" class="modal bottom-sheet" style="max-height: 80%;">
  <div class="modal-content">
    <h4>
      Edit Category
    </h4>
    <div class="row">
      <form id="editGLI" class="col s12">
        <input type="hidden" name="operation" value="edit" />
        <input type="hidden" id="itemID" name="itemID" value="" />
        

          <div class="row">
            <div class="input-field col s12">
              <input id="edit_Title_en" name="edit_Title_en" type="text">
              <label for="dir-edit_Title_en">
                 English Category
              </label>
            </div>

            <div class="input-field col s12">
              <input id="edit_Title_ar" name="edit_Title_ar" type="text">
              <label for="dir-edit_Title_ar">
                 Arabic Category
              </label>
            </div>
            
            <div class="input-field col s12">
              <input name="edit_sort" id="edit_sort" type="number">
              <label for="dir-edit_sort">Sort</label>
            </div>
          </div>

      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnCategoryEdit">Save</a>
  </div>
</div>
<!-- Edit News End -->