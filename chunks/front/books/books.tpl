[[+head]] [[+header]]

<section class="headerInner" style="background-image: url('[[+mainImage]]')">
  <div class="overlay">
    <div class="titles">
      <h3>[[+headerTitle]]</h3>
    </div>
  </div>
</section>
<!-- HEADER-END -->
<section class="books">
  <div class="container">
    <div class="row" id="contentContainer"></div>
    <div id="pagination"></div>
  </div>
</section>

<section class="sendQuestions">
  <form id="addGLI">
    <div class="container">
      <div class="row">
        <h2>[[+borrow]]</h2>
        <input type="hidden" name="operation" value="sendBooksMail" />
        <div class="col s12 m6 l6">
          <input
            placeholder="[[+lastName]]*"
            name="family_name"
            type="text"
            class="validate"
          />
        </div>
        <div class="col s12 m6 l6">
          <input
            placeholder="[[+firstName]]*"
            name="first_name"
            type="text"
            class="validate"
          />
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6 l6">
          <input
            placeholder="[[+email]]*"
            name="email"
            type="text"
            class="validate"
          />
        </div>
        <div class="col s12 m6 l6">
          <input
            placeholder="[[+phoneNumber]]*"
            name="phone"
            type="text"
            class="validate"
          />
        </div>
      </div>
      <div class="row">
        <div class="col s12 m6 l12">
          <textarea name="message" placeholder="[[+message]]*"></textarea>
        </div>
        <a id="btnSend">[[+send]]</a>
      </div>
    </div>
  </form>
</section>

[[+footer]] [[+scripts]]
