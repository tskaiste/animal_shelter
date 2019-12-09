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
          <h5 class="modal-title" id="exampleModalLabel">Cage</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm" id="create_form">
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
                <option v-for="cage in shelters" :key="cage.id" :value="cage.id">{{ cage.address }}</option>
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
      cage: {
        id: 0,
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
  },
  methods: {
    saveForm() {
      var app = this;
      var cage = app.cage;
      this.$http({
        url: `cages`,
        method: "POST",
        data: cage
      }).then(
        res => {
          app.cage.id = res.data.id;
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