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
          <h5 class="modal-title" id="exampleModalLabel">Employee</h5>
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
                v-model="employee.first_name"
                required
              />
            </div>
            <div class="form-group">
              <label>Last name</label>
              <input
                type="text"
                placeholder="Last name"
                class="form-control"
                id="employee_last_name"
                v-model="employee.last_name"
                required
              />
            </div>
            <div class="form-group">
              <label>Age</label>
              <input
                type="number"
                placeholder="Age"
                class="form-control"
                id="employee_age"
                v-model="employee.age"
                required
              />
            </div>
            <div class="form-group">
              <label>Email</label>
              <input
                type="email"
                placeholder="Email"
                class="form-control"
                id="employee_email"
                v-model="employee.email"
                required
              />
            </div>
            <div class="form-group">
              <label>Phone</label>
              <input
                type="phone"
                placeholder="Phone"
                class="form-control"
                id="employee_phone"
                v-model="employee.phone"
                required
              />
            </div>
            <div class="form-group">
              <label>Bank account number</label>
              <input
                type="text"
                placeholder="Bank account number"
                class="form-control"
                id="employee_bank_account_number"
                v-model="employee.bank_account_number"
                required
              />
            </div>
            <div class="form-group">
              <label>Shelter</label>
              <select class="form-control" id="employee_shelter_id" v-model="employee.shelter_id" required>
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
      employeeId: 0,
      employee: {
        id: 0,
        first_name: "",
        last_name: "",
        age: "",
        email: "",
        phone: "",
        bank_account_number: "",
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
      this.employeeId = data.id;
      this.employee.first_name = data.first_name;
      this.employee.last_name = data.last_name;
      this.employee.age = data.age;
      this.employee.phone = data.phone;
      this.employee.email = data.email;
      this.employee.bank_account_number = data.bank_account_number;
      this.employee.shelter_id = data.shelter_id;
    });
  },
  methods: {
    saveForm() {
      var app = this;
      var employee = app.employee;
      this.$http({
        url: `employees/` + app.employeeId,
        method: "PUT",
        data: employee
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