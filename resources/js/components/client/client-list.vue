<template>
  <div>
    <div class="header-flex">
      <h3>Client list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(client, index) in clients" :key="client.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">Full name</div>
          <div class="list-item-value">{{ client.first_name }} {{client.last_name}}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Age</div>
          <div class="list-item-value">{{ client.age }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Email</div>
          <div class="list-item-value">{{ client.email }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Phone</div>
          <div class="list-item-value">{{ client.phone }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Activity level</div>
          <div class="list-item-value">{{ client.activity_level }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Home type</div>
          <div class="list-item-value">{{ client.home_type }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Has yard</div>
          <div class="list-item-value">{{ client.has_yard }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">shelter_id</div>
          <div class="list-item-value">{{ client.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(client)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(client)">
              <img src="../../../img/delete.svg" />
            </span>
          </div>
        </div>
      </div>
    </div>
    <client-edit ref="edit_modal"></client-edit>
  </div>
</template>

<script>
import clientEdit from "./client-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      clients: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "client-edit": clientEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.clients.push(data.client);
    });
    this.$root.$on("updateList", data => {
      var id = this.clients.findIndex(x => x.id === data.clientId);
      this.$set(this.clients, id, data.client);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `clients`,
        method: "GET"
      }).then(
        res => {
          this.clients = res.data.clients;
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
        url: `clients/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.clients.splice(this.clients.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>