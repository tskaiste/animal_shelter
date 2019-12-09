<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="edit_modal"
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
          <form v-on:submit.prevent="saveForm">
            <div class="form-group">
              <label for="bill_address">Date</label>
              <input
                type="date"
                class="form-control"
                id="bill_date"
                v-model="bill.date"
                required
              />
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
      billId: 0,
      bill: {
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
    this.$root.$on("updateInfo", data => {
      this.billId = data.id;
      this.bill.date = data.date;
      this.bill.sum = data.sum;
      this.bill.type = data.type;
      this.bill.sender = data.sender;
      this.bill.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var bill = app.bill;
      this.$http({
        url: `bills/` + app.billId,
        method: "PUT",
        data: bill
      }).then(
        res => {
          app.bill.id = app.billId;
          this.$root.$emit("updateList", app);
          $("#edit_modal").modal("hide");
        },
        () => {
          console.log("err");
        }
      );
    }
  }
};
</script>