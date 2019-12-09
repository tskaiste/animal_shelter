<template>
  <div>
    <div class="header-flex">
      <h3>Donation list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(donation, index) in donations" :key="donation.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">ID</div>
          <div class="list-item-value">{{ donation.id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Date</div>
          <div class="list-item-value">{{ donation.date }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Sum</div>
          <div class="list-item-value">{{ donation.sum }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Purpose</div>
          <div class="list-item-value">{{ donation.purpose }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Sender</div>
          <div class="list-item-value">{{ donation.sender }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Shelter</div>
          <div class="list-item-value">{{ donation.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(donation)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(donation)">
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
    <donation-create ref="create_modal"></donation-create>
    <donation-edit ref="edit_modal"></donation-edit>
  </div>
</template>

<script>
import donationCreate from "./donation-create.vue";
import donationEdit from "./donation-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      donations: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "donation-create": donationCreate,
    "donation-edit": donationEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.donations.push(data.donation);
    });
    this.$root.$on("updateList", data => {
      var id = this.donations.findIndex(x => x.id === data.donationId);
      this.$set(this.donations, id, data.donation);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `donations`,
        method: "GET"
      }).then(
        res => {
          this.donations = res.data.donations;
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
        url: `donations/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.donations.splice(this.donations.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>