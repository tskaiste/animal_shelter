<template>
  <div>
    <div class="header-flex">
      <h3>Employee list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(employee, index) in employees" :key="employee.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">Full name</div>
          <div class="list-item-value">{{ employee.first_name }} {{employee.last_name}}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Age</div>
          <div class="list-item-value">{{ employee.age }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Email</div>
          <div class="list-item-value">{{ employee.email }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Phone</div>
          <div class="list-item-value">{{ employee.phone }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Bank account number</div>
          <div class="list-item-value">{{ employee.bank_account_number }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">shelter_id</div>
          <div class="list-item-value">{{ employee.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(employee)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(employee)">
              <img src="../../../img/delete.svg" />
            </span>
          </div>
        </div>
      </div>
    </div>
    <employee-create ref="create_modal"></employee-create>
    <employee-edit ref="edit_modal"></employee-edit>
  </div>
</template>

<script>
import employeeCreate from "./employee-create.vue";
import employeeEdit from "./employee-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      employees: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "employee-create": employeeCreate,
    "employee-edit": employeeEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.employees.push(data.employee);
    });
    this.$root.$on("updateList", data => {
      var id = this.employees.findIndex(x => x.id === data.employeeId);
      this.$set(this.employees, id, data.employee);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `employees`,
        method: "GET"
      }).then(
        res => {
          this.employees = res.data.employees;
        },
        () => {
          this.has_error = true;
        }
      );
    },
    add() {
      $("#create_modal").modal("show");
    },
    edit(item) {
      this.selectedItem = item;
      this.$root.$emit("updateInfo", this.selectedItem);
      $("#edit_modal").modal("show");
    },
    remove(item) {
      this.$http({
        url: `users/` + item.id,
        method: "DELETE"
      }).then(
        () => {
        },
        () => {
          this.has_error = true;
        }
      );
      this.$http({
        url: `employees/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.employees.splice(this.employees.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>