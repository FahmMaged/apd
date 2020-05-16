 <!-- alert widget -->
<div class="col s12 m2 singleArticle">
  <div class="card medium priv-card hoverable" style="height: 250px;">
    <div class="card-image articleImage" style="min-height:45%;">

      <a id="openEditArticle" onclick="fnOpenEdit([[+currID]]);" class="btn-floating btn-large waves-effect waves-light blue float-edit edit-btn [[+editFlag]]"><i class="material-icons">edit</i></a>

      <a id="deletePrivilegeBtn [[+deleteFlag]]" onclick="fnDel([[+currID]]);"
        class="btn-floating btn-large waves-effect waves-light red float-edit delete-btn [[+deleteFlag]]" style="bottom: 80px; right: 20px;"><i class="material-icons ">delete</i></a>

      <img class="articleImage" src="../[[+image]]">
      <!-- <span class="card-title">Program Title</span> -->
    </div>
    <div class="card-content articleContent">
      <a><h5>[[+name_en]]</h5></a>
      <p>[[+description_en]]</p>
    </div>
  </div>
</div>
<input type="hidden" class="totalpages" name="totalpages" value="[[+totalPages]]" />
<!-- alert widget -->