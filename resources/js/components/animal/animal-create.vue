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
          <h5 class="modal-title" id="exampleModalLabel">Animal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm" id="create_form">
            <div class="form-group">
              <label>Name</label>
              <input
                type="text"
                placeholder="Name"
                class="form-control"
                id="animal_name"
                v-model="animal.name"
                required
              />
            </div>
            <div class="form-group">
              <label>Type</label>
              <input
                type="text"
                placeholder="Type"
                class="form-control"
                id="animal_type"
                v-model="animal.type"
                required
              />
            </div>
            <div class="form-group">
              <label>Breed</label>
              <input
                type="text"
                placeholder="Breed"
                class="form-control"
                id="animal_breed"
                v-model="animal.breed"
                required
              />
            </div>
            <div class="form-group">
              <label>Size</label>
              <input
                type="text"
                placeholder="Size"
                class="form-control"
                id="animal_size"
                v-model="animal.size"
                required
              />
            </div>
            <div class="form-group">
              <label>Color</label>
              <input
                type="text"
                placeholder="Color"
                class="form-control"
                id="animal_color"
                v-model="animal.color"
                required
              />
            </div>
            <div class="form-group">
              <label>Age</label>
              <input
                type="number"
                placeholder="Age"
                class="form-control"
                id="animal_age"
                v-model="animal.age"
                required
              />
            </div>
            <div class="form-group">
              <label>Gender</label>
              <select class="form-control" id="animal_gender" v-model="animal.gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label>Is sterilised</label>
              <select
                class="form-control"
                id="animal_is_sterilised"
                v-model="animal.is_sterilised"
                required
              >
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            </div>
            <div class="form-group">
              <label>Cage</label>
              <select class="form-control" id="animal_cage_id" v-model="animal.cage_id" required>
                <option v-for="cage in cages" :key="cage.id" :value="cage.id">{{ cage.id }}</option>
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
      animal: {
        id: 0,
        name: "",
        type: "",
        breed: "",
        size: "",
        color: "",
        age: "",
        gender: "",
        is_sterilised: 0,
        cage_id: 0
      },
      cages: []
    };
  },
  mounted() {
    this.$http({
      url: `cages`,
      method: "GET"
    }).then(
      res => {
        this.cages = res.data.cages;
      },
      () => {
        this.has_error = true;
      }
    );
  },
  methods: {
    saveForm() {
      var app = this;
      var animal = app.animal;
      this.$http({
        url: `animals`,
        method: "POST",
        data: animal
      }).then(
        res => {
          app.animal.id = res.data.id;
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