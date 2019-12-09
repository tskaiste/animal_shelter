<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="create_modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm" id="create_form">
            <div class="form-group">
              <label for="bill_address">Date</label>
              <input type="date" class="form-control" id="bill_date" v-model="bill.date" required />
            </div>
            <div class="form-group">
              <label for="bill_area">Sum</label>
              <input
                type="number"
                placeholder="Sum"
                class="form-control"
                id="bill_sum"
                v-model="bill.sum"
                required
              />
            </div>
            <div class="form-group">
              <label for="bill_area">Type</label>
              <input
                type="text"
                placeholder="Type"
                class="form-control"
                id="bill_type"
                v-model="bill.type"
                required
              />
            </div>
            <div class="form-group">
              <label for="bill_area">Sender</label>
              <input
                type="text"
                placeholder="Sender"
                class="form-control"
                id="bill_sender"
                v-model="bill.sender"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="bill_shelter_id" v-model="bill.shelter_id" required>
                <option
                  v-for="shelter in shelters"
                  :key="shelter.id"
                  :value="shelter.id"
                >{{ shelter.address }}</option>
              </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      bill: {
        id: 0,
        date: "",
        sum: 0,
        type: "",
        sender: "",
        shelter_id: 0
      },
      shelters: []
    };
  },
  mounted() {
    this.$http({
      url: `shelters`,
      method: "GET"
    }).then(
      res => {
        this.shelters = res.data.shelters;
      },
      () => {
        this.has_error = true;
      }
    );
  },
  methods: {
    saveForm() {
      var app = this;
      var bill = app.bill;
      this.$http({
        url: `bills`,
        method: "POST",
        data: bill
      }).then(
        res => {
          app.bill.id = res.data.id;
          this.$root.$emit("addToList", app);
          document.getElementById("create_form").reset();
          $("#create_modal").modal("hide");
        },
        () => {
          console.log("err");
        }
      );
    }
  }
};
</script>