<template>
  <div>
    <div class="header-flex">
      <h3>Shelter list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(shelter, index) in shelters" :key="shelter.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">Address</div>
          <div class="list-item-value">{{ shelter.address }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Area</div>
          <div class="list-item-value">{{ shelter.area }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Email</div>
          <div class="list-item-value">{{ shelter.email }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Phone</div>
          <div class="list-item-value">{{ shelter.phone }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Bank account number</div>
          <div class="list-item-value">{{ shelter.bank_account_number }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(shelter)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(shelter)">
              <img src="../../../img/delete.svg" />
            </span>
          </div>
        </div>
      </div>
    </div>
    <shelter-create ref="create_modal"></shelter-create>
    <shelter-edit ref="edit_modal"></shelter-edit>
  </div>
</template>

<script>
import shelterCreate from "./shelter-create.vue";
import shelterEdit from "./shelter-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      shelters: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "shelter-create": shelterCreate,
    "shelter-edit": shelterEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.shelters.push(data.shelter);
    });
    this.$root.$on("updateList", data => {
      var id = this.shelters.findIndex(x => x.id === data.shelterId);
      this.$set(this.shelters, id, data.shelter);
    });
  },
  methods: {
    get() {
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
        url: `shelters/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.shelters.splice(this.shelters.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>