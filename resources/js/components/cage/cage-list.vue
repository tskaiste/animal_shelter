<template>
  <div>
    <div class="header-flex">
      <h3>Cage list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(cage, index) in cages" :key="cage.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">ID</div>
          <div class="list-item-value">{{ cage.id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Area</div>
          <div class="list-item-value">{{ cage.area }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">No. of spaces</div>
          <div class="list-item-value">{{ cage.spaces_number }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Shelter</div>
          <div class="list-item-value">{{ cage.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(cage)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(cage)">
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
    <cage-create ref="create_modal"></cage-create>
    <cage-edit ref="edit_modal"></cage-edit>
  </div>
</template>

<script>
import cageCreate from "./cage-create.vue";
import cageEdit from "./cage-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      cages: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "cage-create": cageCreate,
    "cage-edit": cageEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.cages.push(data.cage);
    });
    this.$root.$on("updateList", data => {
      var id = this.cages.findIndex(x => x.id === data.cageId);
      this.$set(this.cages, id, data.cage);
    });
  },
  methods: {
    get() {
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
        url: `cages/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.cages.splice(this.cages.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>