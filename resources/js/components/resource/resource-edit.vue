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
          <h5 class="modal-title" id="exampleModalLabel">Resource</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm">
            <div class="form-group">
              <label>Name</label>
              <input
                type="text"
                placeholder="Name"
                class="form-control"
                id="resource_name"
                v-model="resource.name"
                required
              />
            </div>
            <div class="form-group">
              <label>Type</label>
              <input
                type="text"
                placeholder="Type"
                class="form-control"
                id="resource_type"
                v-model="resource.type"
                required
              />
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input
                type="number"
                placeholder="Amount"
                class="form-control"
                id="resource_amount"
                v-model="resource.amount"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="resource_shelter_id" v-model="resource.shelter_id" required>
                <option v-for="shelter in shelters" :key="shelter.id" :value="shelter.id">{{ shelter.address }}</option>
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
      resourceId: 0,
      resource: {
        name: "",
        type: "",
        amount: "",
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
      this.resourceId = data.id;
      this.resource.name = data.name;
      this.resource.type = data.type;
      this.resource.amount = data.amount;
      this.resource.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var resource = app.resource;
      this.$http({
        url: `resources/` + app.resourceId,
        method: "PUT",
        data: resource
      }).then(
        res => {
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