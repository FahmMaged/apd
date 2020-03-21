<!-- User Widget Start -->
<div class="col s12 m4 singleUser">
    <div class="card-panel blue darken-1 user-widget card hoverable">
        <div class="white-text">
            <p class="userText"><i class="material-icons">account_box</i> [[+userFullName]]</p>
            <p class="userText"><i class="material-icons">email</i> [[+userEmail]]</p>
            <a class="btn-floating red darken-2 waves-light waves-effect deleteUsr delete-btn" onclick="fnDelete([[+userID]]);">
                <i class="material-icons">delete</i>
            </a>
            [[+editAdminUserBtn]]
            <!-- <a class="modal-trigger btn-floating orange darken-2 right waves-light waves-effect" onclick="fnEdit([[+userID]])">
                <i class="material-icons">border_color</i>
            </a> -->
            [[+userStatus]]
        </div>
    </div>
</div>
<!-- User Widget End -->

<input type="hidden" name="totalPages" class="totalpages" value="[[+totalPages]]">
