 <!-- alert widget -->
<!-- <div class="col s12 m4 singleArticle">
  <div class="card medium priv-card hoverable">
    <div class="card-image articleImage" style="min-height:45%;">

      <a id="openEditArticle" onclick="fnOpenEdit([[+currID]]);" class="btn-floating btn-large waves-effect waves-light blue float-edit edit-btn [[+editFlag]]"><i class="material-icons">edit</i></a>

      <a id="deletePrivilegeBtn [[+deleteFlag]]" onclick="fnDel([[+currID]]);"
        class="btn-floating btn-large waves-effect waves-light red float-edit delete-btn [[+deleteFlag]]" style="bottom: 80px; right: 20px;"><i class="material-icons ">delete</i></a>

    </div>
    <div class="card-content articleContent">
      <a><h5>[[+name_en]]</h5></a>
    </div>
  </div>
</div>
<input type="hidden" class="totalpages" name="totalpages" value="[[+totalPages]]" /> -->
<!-- alert widget -->

<tr>
    <td width="400">[[+name_en]]</td>
    <td width="400">[[+name_ar]]</td>
    <td>
        <div class="relative">
            <a onclick="fnOpenEdit([[+currID]]);" class="btn-floating btn-small waves-effect waves-light blue edit-btn "><i class="material-icons">edit</i></a>
            <a onclick="fnDel([[+currID]]);" class="btn-floating btn-small waves-effect waves-light red edit-btn "><i class="material-icons">delete</i></a>
        </div>
    </td>
</tr>
<input type="hidden" class="totalpages" name="totalpages" value="[[+totalPages]]" />