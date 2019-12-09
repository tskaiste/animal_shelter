<template>
  <div>
    <div class="header-flex">
      <h3>Bill list</h3>
      <button class="btn btn-primary" @click="add">Add</button>
    </div>
    <div class="alert alert-danger" v-if="has_error">
      <p>Error.</p>
    </div>
    <div class="list-container">
      <div class="list-item" v-for="(bill, index) in bills" :key="bill.id" :id="index">
        <div class="list-item-content">
          <div class="list-item-title">ID</div>
          <div class="list-item-value">{{ bill.id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Date</div>
          <div class="list-item-value">{{ bill.date }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Sum</div>
          <div class="list-item-value">{{ bill.sum }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Type</div>
          <div class="list-item-value">{{ bill.type }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Sender</div>
          <div class="list-item-value">{{ bill.sender }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Shelter</div>
          <div class="list-item-value">{{ bill.shelter_id }}</div>
        </div>
        <div class="list-item-content">
          <div class="list-item-title">Actions</div>
          <div class="list-item-value actions">
            <span class="edit-btn" @click="edit(bill)">
              <img src="../../../img/edit.svg" />
            </span>
            <span class="delete-btn" @click="remove(bill)">
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
    <bill-create ref="create_modal"></bill-create>
    <bill-edit ref="edit_modal"></bill-edit>
  </div>
</template>

<script>
import billCreate from "./bill-create.vue";
import billEdit from "./bill-edit.vue";
export default {
  data() {
    return {
      has_error: false,
      bills: null,
      showModal: false,
      selectedItem: {}
    };
  },
  components: {
    "bill-create": billCreate,
    "bill-edit": billEdit
  },
  mounted() {
    this.get();
    this.$root.$on("addToList", data => {
      this.bills.push(data.bill);
    });
    this.$root.$on("updateList", data => {
      var id = this.bills.findIndex(x => x.id === data.billId);
      this.$set(this.bills, id, data.bill);
    });
  },
  methods: {
    get() {
      this.$http({
        url: `bills`,
        method: "GET"
      }).then(
        res => {
          this.bills = res.data.bills;
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
        url: `bills/` + item.id,
        method: "DELETE"
      }).then(
        res => {
          this.bills.splice(this.bills.indexOf(item), 1);
        },
        () => {
          this.has_error = true;
        }
      );
    }
  }
};
</script>