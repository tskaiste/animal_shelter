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
          <h5 class="modal-title" id="exampleModalLabel">Shelter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm">
            <div class="form-group">
              <label for="shelter_address">Address</label>
              <input
                type="text"
                placeholder="Address"
                class="form-control"
                id="shelter_address"
                v-model="shelter.address"
                required
              />
            </div>
            <div class="form-group">
              <label for="shelter_area">Area</label>
              <input
                type="number"
                placeholder="Area"
                class="form-control"
                id="shelter_area"
                v-model="shelter.area"
                required
              />
            </div>
            <div class="form-group">
              <label for="shelter_email">Email</label>
              <input
                type="email"
                placeholder="Email"
                class="form-control"
                id="shelter_email"
                v-model="shelter.email"
                required
              />
            </div>
            <div class="form-group">
              <label for="shelter_phone">Phone</label>
              <input
                type="phone"
                placeholder="Phone"
                class="form-control"
                id="shelter_phone"
                v-model="shelter.phone"
                required
              />
            </div>
            <div class="form-group">
              <label for="shelter_bank_account_number">Bank account number</label>
              <input
                type="text"
                placeholder="Bank account number"
                class="form-control"
                id="shelter_bank_account_number"
                v-model="shelter.bank_account_number"
                required
              />
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
      shelterId: 0,
      shelter: {
        address: '',
        area: 0,
        phone: '',
        email: '',
        bank_account_number: ''
      }
    };
  },
  mounted() {
    this.$root.$on("updateInfo", data => {
      this.shelterId = data.id;
      this.shelter.address = data.address;
      this.shelter.area = data.area;
      this.shelter.phone = data.phone;
      this.shelter.email = data.email;
      this.shelter.bank_account_number = data.bank_account_number;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var shelter = app.shelter;
      this.$http({
        url: `shelters/` + app.shelterId,
        method: "PUT",
        data: shelter
      }).then(
        res => {
          this.$root.$emit('updateList', app);
          $('#edit_modal').modal('hide');
        },
        () => {
          console.log("err");
        }
      );
    }
  }
};
</script>