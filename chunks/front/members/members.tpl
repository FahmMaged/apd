[[+head]] [[+header]]

<section class="l12 s12 m12 col no_padding page_name">
  <div class="l12 s12 m12 col inner_headline center">
    <h1>[[+headerTitle]]</h1>
  </div>
  <img src="[[+mainImage]]" />
</section>
<!-- ==============================================    End Body     =============================================== -->
<section class="inner_body instructors">
  <div class="rows">
    <div class="filter">
      <div class="s12 l5 m5 col input-field ">
        <select id="cityID">
          <option value="" disabled selected>[[+country]]</option>
          [[+countriesTPL]]
        </select>
      </div>

      <div class="s12 l5 m5 col input-field ">
        <select id="locationID">
          <option value="0" disabled selected>[[+city]] </option>
          [[+locationsTPL]]
        </select>
      </div>

      <div class="s12 l2 m2 col input-field ">
        <a
          class="waves-effect waves-light btn filterBtn"
          onclick="fnGetMembers(1)"
          >[[+search]]</a
        >
      </div>
    </div>
    <div class="l12 col no_padding" id="contentContainer"></div>

    <div class="s12 center  col" id="pagination"></div>
  </div>
</section>

[[+footer]] [[+scripts]]
