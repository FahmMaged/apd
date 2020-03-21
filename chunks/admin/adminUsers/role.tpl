<!-- Record Row Start-->
<div class="row singleRole">
    <div class="col s9">
        <div class="cat-name">
            <i class="material-icons blue-icon left" style="line-height: 48px;">supervisor_account</i>
            <a class="left" id="cat-01" onclick="fnOpenRoleEdit([[+roleID]]);">[[+roleName]]</a>
        </div>
    </div>
    <div class="col s3">
        <a class="btn red darken-2 waves-effect waves-light nomargin" onclick="fnDeleteRole([[+roleID]]);"><i class="material-icons">delete_forever</i></a>
    </div>
</div>
<input type="hidden" class="totalRolesPages" name="totalRolesPages" value="[[+totalRolesPages]]" />
<!-- Record Row End -->
<div class="divider"></div>