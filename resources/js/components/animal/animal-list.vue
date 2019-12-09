<template>
  <div>
    <div class="header-flex">
      <h3>Animal list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(animal, index) in animals" :key="animal.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">Name</div>
          <div class="list-item-value">{{ animal.name }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Type</div>
          <div class="list-item-value">{{ animal.type }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Breed</div>
          <div class="list-item-value">{{ animal.breed }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Size</div>
          <div class="list-item-value">{{ animal.size }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Color</div>
          <div class="list-item-value">{{ animal.color }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Age</div>
          <div class="list-item-value">{{ animal.age }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Gender</div>
          <div class="list-item-value">{{ animal.gender }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Sterilised</div>
          <div class="list-item-value">{{ animal.is_sterilised }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Cage</div>
          <div class="list-item-value">{{ animal.cage_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(animal)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(animal)">
              <img src="../../../img/delete.svg" />
            </span>
          </div>
        </div>
      </div>
    </div>
    <animal-create ref="create_modal"></animal-create>
    <animal-edit ref="edit_modal"></animal-edit>
  </div>
</template>

<script>
import animalCreate from "./animal-create.vue";
import animalEdit from "./animal-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      animals: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "animal-create": animalCreate,
    "animal-edit": animalEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.animals.push(data.animal);
    });
    this.$root.$on("updateList", data => {
      var id = this.animals.findIndex(x => x.id === data.animalId);
      this.$set(this.animals, id, data.animal);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `animals`,
        method: "GET"
      }).then(
        res => {
          this.animals = res.data.animals;
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
        url: `animals/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.animals.splice(this.animals.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>