<input type="hidden" id="currPage" name="currPage" value="1" />
<input type="hidden" id="currRolesPage" name="currRolesPage" value="1" />

<input type="hidden" id="addAdminFlag" value="1" />
<input type="hidden" id="editAdminFlag" value="1" />
<input type="hidden" id="deleteAdminFlag" value="1" />

<!-- Fixed Action Button Start -->
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;" id="addAlertBtnCnt">
    <a class="btn-floating btn-large amber darken-4">
        <i class="large material-icons">add</i>
    </a>
    <ul>
        <li>
            <a href="#addAdminModal" id="addAdminBtn" class="btn-floating green btn-large tooltipped modal-trigger" data-position="left" data-delay="50" data-tooltip="Add Admin User">
                <i class="material-icons">supervisor_account</i>
            </a>
        </li>
    </ul>
</div>
<!-- Fixed Action Button End -->

<!-- Main Content Container -->
<div class="row">
    <div class="large-12 columns">
        <h1 class="main-title">Admin Users</h1>
        <p class="subtitle-text inline-block">Manage Admin Users </p>

        <!-- Filters -->
        <div class="">
            <div class="filters columns">

                <div class="col s12">
                    <!-- Search by Name/Email Filter -->
                    <div class="col s3">
                        <input id="userSearch" type="text" placeholder="Search by Name or Email">
                    </div>
                    <div class="col s3 mt20">
                        <div class="switch">
                            <label style="display: inline-block !important;">
                                Inactive
                                <input type="checkbox" id="statusFilter" checked>
                                <span class="lever"></span>
                                Active
                            </label>
                        </div>
                    </div>

                    <!-- Change View Switch -->
                    <div class="col s3 right mt20">
                        <div class="switch">
                            <label style="display: inline-block !important;">
                                Grid View
                                <input type="checkbox" id="view-switch">
                                <span class="lever"></span>
                                List View
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="adminsList">
            <!-- To be filled out by an AJAX request -->
        </div>

        <div class="row mt20" >
            <div class="small-4 small-centered columns center">
                <a id="loadMoreBtn" class="btn blue-grey darken-2 waves-effect waves-light">Load More</a>
            </div>
        </div>
    </div>
</div>
<!-- Main Content Container -->

<!-- Add Admin User Modal Structure Start -->
<div id="addAdminModal" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Add Admin User</h4>
        <div class="row">
            <form class="col s12" id="addAdminUserForm">
                <input type="hidden" name="operation" value="create">

                <div class="row">
                    <div class="input-field col s4">
                        <input id="admin-firstname" name="firstName" type="text" class="validate">
                        <label for="admin-firstname">Admin First Name *</label>
                    </div>

                    <div class="input-field col s4">
                        <input id="admin-lastName" name="lastName" type="text" class="validate">
                        <label for="admin-lastName">Admin Last Name *</label>
                    </div>

                    <div class="input-field col s4">
                        <input id="admin-email" name="email" type="email" class="validate">
                        <label for="admin-email">Admin Email Address *</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="admin-password" name="password" type="password" class="validate">
                        <label for="admin-password">Admin Password *</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="admin-confirmPassword" name="confirmPassword" type="password" class="validate">
                        <label for="admin-confirmPassword">Confirm Admin Password *</label>
                    </div>

                    <div class="col s6">
                        <p>Admin Status</p>
                        <!-- Switch -->
                        <div class="switch">
                            <label>
                                Inactive
                                <input type="checkbox" name="isActive" checked>
                                <span class="lever"></span>
                                Active
                            </label>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a id="submitAddAdminUserFormBtn" class="modal-action modal-close waves-effect waves-light btn blue darken-2">Add Admin User</a>
    </div>
</div>
<!-- Add Admin User Modal Structure End -->

<!-- Edit Admin User Modal Structure -->
<div id="editAdminModal" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Edit Admin User</h4>
        <div class="row">
            <form class="col s12" id="editAdminUserForm">
                <input type="hidden" name="operation" value="edit">
                <input type="hidden" name="userID" value="">
                <div class="row">
                    <div class="input-field col s4">
                        <input id="edit-admin-firstname" name="firstName" type="text" class="validate">
                        <label for="edit-admin-firstname">Admin First Name *</label>
                    </div>

                    <div class="input-field col s4">
                        <input id="edit-admin-lastName" name="lastName" type="text" class="validate">
                        <label for="edit-admin-lastName">Admin Last Name *</label>
                    </div>

                    <div class="input-field col s4">
                        <input id="edit-admin-email" name="email" type="email" class="validate">
                        <label for="edit-admin-email">Admin Email Address *</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="edit-admin-password" name="password" type="password">
                        <label for="edit-admin-password">Admin Password</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="edit-admin-confirmPassword" name="confirmPassword" type="password">
                        <label for="edit-admin-confirmPassword">Confirm Admin Password</label>
                    </div>

                    <div class="col s6">
                        <p>Admin Status</p>
                        <!-- Switch -->
                        <div class="switch">
                            <label>
                                Inactive
                                <input type="checkbox" id="editIsActive" name="isActive" checked>
                                <span class="lever"></span>
                                Active
                            </label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a id="submitEditAdminUserFormBtn" class="modal-action modal-close waves-effect waves-light btn blue darken-2">Edit Admin User</a>
    </div>
</div>
<!-- Edit Admin User Modal Ends -->

