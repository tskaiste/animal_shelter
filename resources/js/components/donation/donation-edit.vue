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
              <label for="donation_address">Date</label>
              <input
                type="date"
                class="form-control"
                id="donation_date"
                v-model="donation.date"
                required
              />
            </div>
            <div class="form-group">
              <label for="donation_area">Sum</label>
              <input
                type="number"
                placeholder="Sum"
                class="form-control"
                id="donation_sum"
                v-model="donation.sum"
                required
              />
            </div>
              <div class="form-group">
              <label for="donation_area">Purpose</label>
              <input
                type="text"
                placeholder="Purpose"
                class="form-control"
                id="donation_purpose"
                v-model="donation.purpose"
                required
              />
            </div>
              <div class="form-group">
              <label for="donation_area">Sender</label>
              <input
                type="text"
                placeholder="Sender"
                class="form-control"
                id="donation_sender"
                v-model="donation.sender"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="donation_shelter_id" v-model="donation.shelter_id" required>
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
      donationId: 0,
      donation: {
        date: "",
        sum: 0,
        purpose: "",
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
      this.donationId = data.id;
      this.donation.date = data.date;
      this.donation.sum = data.sum;
      this.donation.purpose = data.purpose;
      this.donation.sender = data.sender;
      this.donation.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var donation = app.donation;
      this.$http({
        url: `donations/` + app.donationId,
        method: "PUT",
        data: donation
      }).then(
        res => {
          app.donation.id = app.donationId;
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