<!-- Fixed Action Button Start -->

<div
  class="fixed-action-btn"
  style="bottom: 45px; right: 24px;"
  id="addAlertBtnCnt"
>
  <ul>
    <li>
      <a
        class="btn-floating btn-large blue tooltipped modal-trigger popupforms"
        data-position="left"
        data-delay="50"
        data-tooltip="Add Article"
        href="#addModal"
        id="addItem"
      >
        <i class="material-icons">language</i>
      </a>
    </li>
  </ul>
</div>
<!-- Fixed Action Button End -->
<div class="row">
  <div class="large-12 columns">
    <h1 class="main-title">Language Tool</h1>
    <p class="subtitle-text">Manage the Language Files on Your Website.</p>
    <div class="large-12 columns nopadding">
      <div class="filters columns">
        <div class="input-field col s6">
          <select id="langFile" class="icons">
            <option value="0" disabled selected>Choose File</option>
            <option value="about.json">About</option>
            <option value="news.json">Aricles</option>
            <!-- <option value="awareness.json">Awareness</option> -->
            <!-- <option value="books.json">Books</option> -->
            <option value="contactUs.json">Contact Us</option>
            <option value="events.json">Events</option>
            <option value="main.json">General</option>
            <option value="home.json">Home Page</option>
            <option value="headForms.json">Head Form</option>
            <!-- <option value="media.json">Media</option> -->
            <option value="members.json">Members</option>

            <!-- <option value="ourWork.json">Our Work</option> -->
            <!-- <option value="questions.json">Questions</option> -->
            <option value="videos.json">Videos</option>
          </select>
          <label>Choose File</label>
        </div>
      </div>
    </div>

    <div
      class="col s12 mb10 manageAll [[+deleteFlag]]"
      id="controls"
      style="display: none;"
    >
      <p class="inline-block">
        <input
          type="checkbox"
          class="filled-in"
          id="checkAll"
          onchange="checkAll(this)"
        />
        <label for="checkAll">Select/ Deselect all items</label>
      </p>
      <a
        class="waves-effect waves-light red darken-1 right btn "
        onclick="fnDeleteSelected()"
      >
        <i class="material-icons left">delete</i>Delete Selected
      </a>
    </div>

    <div id="contentContainer">
      <!-- To be filled out by an AJAX call -->
      <table>
        <thead>
          <tr>
            <td>Field</td>
            <td>English</td>
            <td>Arabic</td>
            <td>Edit</td>
          </tr>
        </thead>
        <tbody jput="file" jput-jsondata="[]">
          <tr>
            <td width="400">{{ index }}</td>
            <td width="400">{{ json.en }}</td>
            <td width="400">{{ json.ar }}</td>
            <!-- <td><a href="#" onclick="edit('{{index}}')">Edit</a></td> -->
            <td>
              <div class="relative">
                <a
                  id="openEditFile"
                  onclick="fnOpenEdit('{{ index }}')"
                  class="btn-floating btn-small waves-effect waves-light blue edit-btn [[+editFlag]]"
                  ><i class="material-icons">edit</i></a
                >
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
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
    <h4>Edit Language File</h4>
    <div class="row">
      <form id="editGL" class="col s12">
        <input type="hidden" name="operation" value="edit" />
        <input type="hidden" id="itemID" name="currID" value="" />
        <div class="row">
          <div class="input-field col s12">
            <input id="field" name="field" type="text" disabled />
            <label for="field">Field</label>
          </div>
          <div class="input-field col s12">
            <input id="english" name="english" type="text" />
            <label for="field">English</label>
          </div>
          <div class="input-field col s12">
            <input id="arabic" name="field" type="text" />
            <label for="arabic">Arabic</label>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="waves-effect waves-light btn blue darken-2" id="btnEdit"
      >Save</a
    >
  </div>
</div>
