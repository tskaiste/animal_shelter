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
          <h5 class="modal-title" id="exampleModalLabel">Client</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form v-on:submit.prevent="saveForm">
            <div class="form-group">
              <label>First Name</label>
              <input
                type="text"
                placeholder="First Name"
                class="form-control"
                v-model="client.first_name"
                required
              />
            </div>
            <div class="form-group">
              <label>Last name</label>
              <input
                type="text"
                placeholder="Last name"
                class="form-control"
                id="client_last_name"
                v-model="client.last_name"
                required
              />
            </div>
            <div class="form-group">
              <label>Age</label>
              <input
                type="number"
                placeholder="Age"
                class="form-control"
                id="client_age"
                v-model="client.age"
                required
              />
            </div>
            <div class="form-group">
              <label>Email</label>
              <input
                type="email"
                placeholder="Email"
                class="form-control"
                id="client_email"
                v-model="client.email"
                required
              />
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input
                type="phone"
                placeholder="Phone"
                class="form-control"
                id="client_phone"
                v-model="client.phone"
                required
              />
            </div>
            <div class="form-group">
              <label>Activity level</label>
              <input
                type="text"
                placeholder="Activity level"
                class="form-control"
                id="client_activity_level"
                v-model="client.activity_level"
                required
              />
            </div>
            <div class="form-group">
              <label>Home type</label>
              <input
                type="text"
                placeholder="Home type"
                class="form-control"
                id="client_home_type"
                v-model="client.home_type"
                required
              />
            </div>
            <div class="form-group">
              <label>Has yard</label>
              <input
                type="text"
                placeholder="Has yard"
                class="form-control"
                id="client_has_yard"
                v-model="client.has_yard"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="client_shelter_id" v-model="client.shelter_id" required>
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
      clientId: 0,
      client: {
        first_name: "",
        last_name: "",
        age: "",
        email: "",
        phone: "",
        activity_level: "",
        home_type: "",
        has_yard: "",
        shelter_id: ""
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
      this.clientId = data.id;
      this.client.first_name = data.first_name;
      this.client.last_name = data.last_name;
      this.client.age = data.age;
      this.client.phone = data.phone;
      this.client.email = data.email;
      this.client.activity_level = data.activity_level;
      this.client.home_type = data.home_type;
      this.client.has_yard = data.has_yard;
      this.client.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var client = app.client;
      this.$http({
        url: `clients/` + app.clientId,
        method: "PUT",
        data: client
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