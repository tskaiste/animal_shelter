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
          <h5 class="modal-title" id="exampleModalLabel">Cage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm">
            <div class="form-group">
              <label for="cage_address">Area</label>
              <input
                type="number"
                placeholder="Area"
                class="form-control"
                id="cage_area"
                v-model="cage.area"
                required
              />
            </div>
            <div class="form-group">
              <label for="cage_area">No. of spaces</label>
              <input
                type="number"
                placeholder="No. of spaces"
                class="form-control"
                id="cage_spaces_number"
                v-model="cage.spaces_number"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="cage_shelter_id" v-model="cage.shelter_id" required>
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
      cageId: 0,
      cage: {
        area: 0,
        spaces_number: 0,
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
      this.cageId = data.id;
      this.cage.area = data.area;
      this.cage.spaces_number = data.spaces_number;
      this.cage.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var cage = app.cage;
      this.$http({
        url: `cages/` + app.cageId,
        method: "PUT",
        data: cage
      }).then(
        res => {
          app.cage.id = app.cageId;
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