<template>
  <div>
    <div class="header-flex">
      <h3>Resource list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(resource, index) in resources" :key="resource.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">Name</div>
          <div class="list-item-value">{{ resource.name }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Type</div>
          <div class="list-item-value">{{ resource.type }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Amount</div>
          <div class="list-item-value">{{ resource.amount }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Shelter</div>
          <div class="list-item-value">{{ resource.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(resource)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(resource)">
              <img src="../../../img/delete.svg" />
            </span>
          </div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title"></div>
          <div class="list-item-value"></div>
        </div>
      </div>
    </div>
    <resource-create ref="create_modal"></resource-create>
    <resource-edit ref="edit_modal"></resource-edit>
  </div>
</template>

<script>
import resourceCreate from "./resource-create.vue";
import resourceEdit from "./resource-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      resources: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "resource-create": resourceCreate,
    "resource-edit": resourceEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.resources.push(data.resource);
    });
    this.$root.$on("updateList", data => {
      var id = this.resources.findIndex(x => x.id === data.resourceId);
      this.$set(this.resources, id, data.resource);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `resources`,
        method: "GET"
      }).then(
        res => {
          this.resources = res.data.resources;
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
        url: `resources/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.resources.splice(this.resources.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>