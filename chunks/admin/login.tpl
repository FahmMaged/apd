<!-- login Template -->
[[+head]]
<div>
  <form id="login">
    <div class="back">
      <div class="right-container">
        <div class="large-6 columns large-centered pt80">
          <div class="large-12 columns">
            <div class="company-logo">
              <img class="center-block mb30" src="img/logo.png" />
            </div>
            <h4 class="mb30 center">Login to APD Admin Panel</h4>
          </div>

          <input type="hidden" name="operation" value="login" />

          <div class="large-12 columns">
            <input
              type="text"
              id="email"
              name="email"
              placeholder="Email Address"
              class="required login-input mb30"
            />
          </div>

          <div class="large-12 columns">
            <input
              type="password"
              id="password"
              name="password"
              placeholder="Password"
              class="required login-input mb30"
            />
          </div>

          <div class="large-12 columns">
            <button id="submit" class="btn blue darken-2">Login</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

[[+footer]]

<script>
  $(document).ready(function() {
    $("#login").submit(function(event) {
      event.preventDefault();

      if (
        $("#email").val() == "" ||
        $("#email").val() == undefined ||
        $("#email").val() == null
      ) {
        swal({
          title: "Required Field is Missing",
          text: "Email addess is a required field",
          type: "error",
          confirmButtonText: "close"
        });
        return;
      }

      if (
        $("#password").val() == "" ||
        $("#password").val() == undefined ||
        $("#password").val() == null
      ) {
        swal({
          title: "Required Field is Missing",
          text: "Password is a required field",
          type: "error",
          confirmButtonText: "close"
        });
        return;
      }

      $("#loadingContainer").show();

      $.ajax({
        url: "../handlers/AdminUsersHandler.php",
        type: "POST",
        data: {
          email: $("#email").val(),
          password: $("#password").val(),
          operation: "login"
        },
        cache: false,
        success: function(data) {
          data = $.parseJSON(data);

          if (data.res == 1) {
            window.location = "index.php";
          } else {
            swal({
              title: "Invalid mail or password",
              text: data.message,
              type: "error",
              confirmButtonText: "Close"
            });
            $("#loadingContainer").hide();
          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          console.log(xhr.statusText);
          console.log(xhr.responseText);
          console.log(xhr.status);
          swal({
            title: "Something went wrong",
            text: xhr.responseText,
            type: "error",
            confirmButtonText: "close"
          });
          $("#loadingContainer").hide();
        }
      });
    });
  });
</script>
