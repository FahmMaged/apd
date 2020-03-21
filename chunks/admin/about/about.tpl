<div class="row">
    <div class="large-12 columns">
        <h1 class="main-title">
            About
        </h1>
        <p class="subtitle-text">
            Manage About page on your website.
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
              <input id="first_edit_title_en" name="first_edit_title_en" type="text">
              <label for="dir-first_edit_title_en">
                  First English Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="first_edit_description_en" name="first_edit_description_en"></textarea>
              <label for="dir-first_edit_description_en">
                   First English Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="second_edit_title_en" name="second_edit_title_en" type="text">
              <label for="dir-second_edit_title_en">
                  Second English Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="second_edit_description_en" name="second_edit_description_en"></textarea>
              <label for="dir-second_edit_description_en">
                   Second English Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="third_edit_title_en" name="third_edit_title_en" type="text">
              <label for="dir-third_edit_title_en">
                  Third English Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="third_edit_description_en" name="third_edit_description_en"></textarea>
              <label for="dir-third_edit_description_en">
                   Third English Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="fourth_edit_title_en" name="fourth_edit_title_en" type="text">
              <label for="dir-fourth_edit_title_en">
                  Fourth English Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="fourth_edit_description_en" name="fourth_edit_description_en"></textarea>
              <label for="dir-fourth_edit_description_en">
                   Fourth English Description
              </label>
            </div>
          </div>

          <div id="TabAREdit" class="row">
            <div class="input-field col s12">
              <input id="first_edit_title_ar" name="first_edit_title_ar" type="text">
              <label for="dir-first_edit_title_ar">
                  First Arabic Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="first_edit_description_ar" name="first_edit_description_ar"></textarea>
              <label for="dir-first_edit_description_ar">
                   First Arabic Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="second_edit_title_ar" name="second_edit_title_ar" type="text">
              <label for="dir-second_edit_title_ar">
                  Second Arabic Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="second_edit_description_ar" name="second_edit_description_ar"></textarea>
              <label for="dir-second_edit_description_ar">
                   Second Arabic Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="third_edit_title_ar" name="third_edit_title_ar" type="text">
              <label for="dir-third_edit_title_ar">
                  Third Arabic Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="third_edit_description_ar" name="third_edit_description_ar"></textarea>
              <label for="dir-third_edit_description_ar">
                   Third Arabic Description
              </label>
            </div>

            <div class="input-field col s12">
              <input id="fourth_edit_title_ar" name="fourth_edit_title_ar" type="text">
              <label for="dir-fourth_edit_title_ar">
                  Fourth Arabic Title
              </label>
            </div>
            <div class="input-field col s12">
              <textarea id="fourth_edit_description_ar" name="fourth_edit_description_ar"></textarea>
              <label for="dir-fourth_edit_description_ar">
                   Fourth Arabic Description
              </label>
            </div>
          </div>

          <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              First Image
            </span>
            <input name="firstPicture" type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text">
          </div>
        </div>

        <div class="file-field input-field col s12">
          <div class="btn blue darken-2">
            <span>
              Second Image
            </span>
            <input name="secondPicture" type="file">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path" type="text">
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