<!-- Head + header-->
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>APD Admin Panel</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/materialize.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/clockpicker.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <!-- <link type="text/css" rel="stylesheet" href="../css/lightgallery/lightgallery.css" /> -->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="css/jquery-ui.min.css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
    <link rel="icon" href="../favicon.ico" type="image/x-icon" />
    <script src="js/vendor/jquery.min.js"></script>

    <!--DataTable-->
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"
    />
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="css/sweetalert2.css" />
    <!--froala-->
    <!-- Include external CSS.
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css"> -->

    <!-- Include Editor style. 
  <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css" rel="stylesheet"
    type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet"
    type="text/css" />-->

    <script src="js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
      tinymce.init({
        selector: "textarea",

        // ===========================================
        // INCLUDE THE PLUGIN
        // ===========================================

        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table contextmenu paste jbimages"
        ],

        // ===========================================
        // PUT PLUGIN'S BUTTON on the toolbar
        // ===========================================

        toolbar:
          "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",

        // ===========================================
        // SET RELATIVE_URLS to FALSE (This is required for images to display properly)
        // ===========================================

        relative_urls: false
      });
    </script>
  </head>

  <body>
    <div id="loadingContainer" class="loader-container">
      <div class="loader">
        <img src="img/tail-spin.svg" />
      </div>
    </div>
  </body>
</html>
