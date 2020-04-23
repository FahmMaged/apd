<style type="text/css">
  tr.border_bottom td {
    border-bottom: 1pt solid #edecec;
  }
</style>
<tr class="record-row border_bottom">
  <!-- <td>[[+firstName]]</td>
              <td>[[+lastName]]</td>
              <td>[[+phone]]</td> -->
  <td>[[+email]]</td>
  <!-- <td>[[+message]]</td> -->
  <td>
    <button class="btn bule-btn" onClick="fnDel([[+ID]])">
      <i class="material-icons">delete</i>
    </button>
  </td>
</tr>
<input
  type="hidden"
  name="totalPages"
  class="totalpages"
  value="[[+totalPages]]"
/>
