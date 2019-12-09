<template>
  <div class="container">
    <div class="card card-default">
      <div class="card-body">
        <billList></billList>
      </div>
    </div>
  </div>
</template>

<script>
  import billList from '../../components/bill/bill-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      billList
    }
  }
</script>